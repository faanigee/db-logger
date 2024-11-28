<?php

namespace Faanigee\DbLogger\Console\Commands;

use Illuminate\Console\Command;
use Faanigee\DbLogger\Models\Log;
use Carbon\Carbon;

class CleanupLogsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dblogger:cleanup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clean up old logs based on retention policy';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $retentionDays = config('dblogger.retention_days', 30);

        if ($retentionDays <= 0) {
            $this->info('Log retention is set to keep logs indefinitely.');
            return;
        }

        $date = Carbon::now()->subDays($retentionDays);
        $count = Log::where('created_at', '<', $date)->delete();

        $this->info("Successfully deleted {$count} old log(s).");
    }
}
