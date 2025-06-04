<?php

namespace App\Jobs;

use App\Models\Comment;
use App\Jobs\Traits\WithJobUuid;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class CommentsPerUserJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, WithJobUuid;

    /**
     * Execute the job.
     */
    public function handle()
    {
        try {
            $logFile = 'user_comment_counts.log';
            $outputFile = 'user_comment_counts.json';
            $exportsPath = storage_path('app/exports');
            $logsPath = storage_path('logs');
            
            // Nos aseguramos de que los directorios existan y tengan los permisos correctos (chmod)
            if (!file_exists($exportsPath)) {
                if (!mkdir($exportsPath, 0755, true) && !is_dir($exportsPath)) {
                    throw new \RuntimeException(sprintf('Directory "%s" was not created', $exportsPath));
                }
                chmod($exportsPath, 0755);
            }
            
            if (!file_exists($logsPath)) {
                if (!mkdir($logsPath, 0755, true) && !is_dir($logsPath)) {
                    throw new \RuntimeException(sprintf('Directory "%s" was not created', $logsPath));
                }
                chmod($logsPath, 0755);
            }
            
            // Obtener el recuento de comentarios por usuario a través de los posts
            $commentCounts = Comment::selectRaw('posts.user_id, COUNT(*) as count')
                ->join('posts', 'posts.id', '=', 'comments.post_id')
                ->groupBy('posts.user_id')
                ->get()
                ->pluck('count', 'user_id')
                ->toArray();
            
            // Guardar los resultados en un archivo JSON
            $jsonPath = "{$exportsPath}/{$outputFile}";
            file_put_contents($jsonPath, json_encode($commentCounts, JSON_PRETTY_PRINT));
            
            // Registrar los resultados en un log
            $logPath = "{$logsPath}/{$logFile}";
            $logContent = '';
            
            foreach ($commentCounts as $userId => $count) {
                $logLine = sprintf(
                    "[%s] - %s[%s]\nProcessed comment counts for user_id=%d: total=%d\n",
                    now()->toIso8601String(),
                    class_basename($this),
                    $this->getJobUuid(),
                    $userId,
                    $count
                );
                
                $logContent .= $logLine;
            }
            
            file_put_contents($logPath, $logContent, FILE_APPEND);
            
            return true;
            
        } catch (\Exception $e) {
            Log::error("Error en CommentsPerUserJob: " . $e->getMessage());
            Log::error($e->getTraceAsString());
            throw $e;
        }
    }
}
