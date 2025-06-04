<?php

namespace App\Console\Commands\Cache;

use App\Services\CacheService;
use Illuminate\Console\Command;

class CacheClearCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cache:clear-all';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear all application cache';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        if (CacheService::clearAll()) {
            $this->info('Application cache cleared successfully!');
            return 0;
        }

        $this->error('Failed to clear application cache!');
        return 1;
    }
}
