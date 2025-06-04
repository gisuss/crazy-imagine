<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class DownloadController extends Controller
{
    public function downloadUserCommentsJson()
    {
        $filePath = storage_path('app/exports/user_comment_counts.json');
        
        if (!file_exists($filePath)) {
            return back()->with('error', 'El archivo no existe.');
        }
        
        return response()->download($filePath, 'user_comment_counts.json', [
            'Content-Type' => 'application/json',
            'Content-Disposition' => 'attachment; filename="user_comment_counts.json"',
        ]);
    }
}
