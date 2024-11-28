<?php

namespace Faanigee\DbLogger;

use Illuminate\Contracts\Foundation\Application;
use Faanigee\DbLogger\Models\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class DbLogger
{
	/**
	 * The application instance.
	 *
	 * @var \Illuminate\Contracts\Foundation\Application
	 */
	protected $app;

	/**
	 * Create a new DbLogger instance.
	 *
	 * @param  \Illuminate\Contracts\Foundation\Application  $app
	 * @return void
	 */
	public function __construct(Application $app)
	{
		$this->app = $app;
	}

	/**
	 * Log a message to the database.
	 *
	 * @param  string  $level
	 * @param  string  $message
	 * @param  array  $context
	 * @param  array  $extra
	 * @return \Faanigee\DbLogger\Models\Log
	 */
	public function log(string $level, $ref_id, string $ref_type, string $message, array $context = [], array $extra = []): Log
	{
		return Log::create([
			'level' => $level,
			'ref_id' => $ref_id ?? null,
			'ref_type' => $ref_type ?? null,
			'message' => $message,
			'context' => $context,
			'extra' => $extra,

			'request_method' => Request::method(),
			'request_path' => Request::path(),
			'request_headers' => Request::header(),
			'request_body' => Request::all(),
			'response_status' => $context['response_status'] ?? null,
			'response_time' => microtime(true) - LARAVEL_START ?? null,

			'created_by' => Auth::id() ?? null,
			'ip_address' => Request::ip(),
			'user_agent' => Request::userAgent(),
		]);
	}

	/**
	 * Log an emergency message to the database.
	 *
	 * @param  string  $message
	 * @param  array  $context
	 * @return \Faanigee\DbLogger\Models\Log
	 */
	public function emergency($ref_id, $ref_type, string $message, array $context = []): Log
	{
		return $this->log('emergency', $ref_id, $ref_type, $message, $context);
	}

	/**
	 * Log an alert message to the database.
	 *
	 * @param  string  $message
	 * @param  array  $context
	 * @return \Faanigee\DbLogger\Models\Log
	 */
	public function alert($ref_id, $ref_type, string $message, array $context = []): Log
	{
		return $this->log('alert', $ref_id, $ref_type, $message, $context);
	}

	/**
	 * Log a critical message to the database.
	 *
	 * @param  string  $message
	 * @param  array  $context
	 * @return \Faanigee\DbLogger\Models\Log
	 */
	public function critical($ref_id, $ref_type, string $message, array $context = []): Log
	{
		return $this->log('critical', $ref_id, $ref_type, $message, $context);
	}

	/**
	 * Log an error message to the database.
	 *
	 * @param  string  $message
	 * @param  array  $context
	 * @return \Faanigee\DbLogger\Models\Log
	 */
	public function error($ref_id, $ref_type, string $message, array $context = []): Log
	{
		return $this->log('error', $ref_id, $ref_type, $message, $context);
	}

	/**
	 * Log a warning message to the database.
	 *
	 * @param  string  $message
	 * @param  array  $context
	 * @return \Faanigee\DbLogger\Models\Log
	 */
	public function warning($ref_id, $ref_type, string $message, array $context = []): Log
	{
		return $this->log('warning', $ref_id, $ref_type, $message, $context);
	}

	/**
	 * Log a notice message to the database.
	 *
	 * @param  string  $message
	 * @param  array  $context
	 * @return \Faanigee\DbLogger\Models\Log
	 */
	public function notice($ref_id, $ref_type, string $message, array $context = []): Log
	{
		return $this->log('notice', $ref_id, $ref_type, $message, $context);
	}

	/**
	 * Log an info message to the database.
	 *
	 * @param  string  $message
	 * @param  array  $context
	 * @return \Faanigee\DbLogger\Models\Log
	 */
	public function info($ref_id, $ref_type, string $message, array $context = []): Log
	{
		return $this->log('info', $ref_id, $ref_type, $message, $context);
	}

	/**
	 * Log a debug message to the database.
	 *
	 * @param  string  $message
	 * @param  array  $context
	 * @return \Faanigee\DbLogger\Models\Log
	 */
	public function debug($ref_id, $ref_type, string $message, array $context = []): Log
	{
		return $this->log('debug', $ref_id, $ref_type, $message, $context);
	}
}
