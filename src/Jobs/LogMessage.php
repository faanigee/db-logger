<?php

namespace Faanigee\DbLogger\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Faanigee\DbLogger\DbLogger;

class LogMessage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $level;
    protected $ref_id;
    protected $ref_type;
    protected $message;
    protected $context;
    protected $extra;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(string $level, $ref_id, string $ref_type, string $message, array $context = [], array $extra = [])
    {
        $this->level = $level;
        $this->ref_id = $ref_id;
        $this->ref_type = $ref_type;
        $this->message = $message;
        $this->context = $context;
        $this->extra = $extra;
    }

    /**
     * Execute the job.
     *
     * @param  \Faanigee\DbLogger\DbLogger  $logger
     * @return void
     */
    public function handle(DbLogger $logger)
    {
        $logger->log(
            $this->level,
            $this->ref_id,
            $this->ref_type,
            $this->message,
            $this->context,
            $this->extra
        );
    }
}
