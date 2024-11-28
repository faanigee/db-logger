<?php

namespace Faanigee\DbLogger\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use Carbon\Carbon;

class LogCleanupCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dblogger:cleanup {--days= : Number of days to keep logs}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clean up old logs based on retention policy';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $levels = Config::get('dblogger.retention.levels', []);
        $defaultDays = $this->option('days') ?? Config::get('dblogger.retention.days', 90);

        foreach ($levels as $level => $days) {
            $date = Carbon::now()->subDays($days);
            $count = DB::connection('log_db')
                ->table('main-logs')
                ->where('level', $level)
                ->where('created_at', '<', $date)
                ->delete();

            $this->info("Deleted {$count} {$level} logs older than {$days} days.");
        }

        // Clean up remaining logs using default retention period
        $date = Carbon::now()->subDays($defaultDays);
        $count = DB::connection('log_db')
            ->table('main-logs')
            ->whereNotIn('level', array_keys($levels))
            ->where('created_at', '<', $date)
            ->delete();

        $this->info("Deleted {$count} other logs older than {$defaultDays} days.");

        return 0;
    }
}
