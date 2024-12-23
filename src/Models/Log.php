<?php

namespace Faanigee\DbLogger\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Log extends Model
{
	/**
	 * The connection name for the model.
	 *
	 * @var string
	 */
	protected $connection;

	/**
	 * Create a new model instance.
	 *
	 * @param array $attributes
	 */
	public function __construct(array $attributes = [])
	{
		parent::__construct($attributes);
		$this->connection = config('dblogger.connection');
	}

	/**
	 * The indexes that should be created for the model.
	 *
	 * @var array
	 */
	protected $indexes = [
		'level',
		'ref_id',
		'ref_type',
		'created_at',
		'created_by',
		['level', 'created_at'],
		['ref_id', 'ref_type'],
	];

	use HasFactory;

	/**
	 * The connection name for the model.
	 *
	 * @var string
	 */
	protected $table = 'main-logs';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array<int, string>
	 */
	protected $fillable = [
		'level',
		'ref_id',
		'ref_type',
		'message',
		'context',
		'extra',
		'created_by',
		'ip_address',
		'user_agent',

		'request_method',
		'request_path',
		'request_headers',
		'request_body',
		'response_status',
		'response_time'
	];

	/**
	 * The attributes that should be cast.
	 *
	 * @var array<string, string>
	 */
	protected $casts = [
		'context' => 'array',
		'extra' => 'array',
		'request_headers' => 'array',
		'request_body' => 'array',

		'created_at' => 'datetime',
		'updated_at' => 'datetime',
	];

	/**
	 * Scope to filter logs by level.
	 */
	public function scopeLevel($query, string $level)
	{
		return $query->where('level', $level);
	}

	public function scopeRefId($query, string $ref_no)
	{
		return $query->where('ref_id', $ref_no);
	}

	public function user()
	{
		return $this->belongsTo(User::class, 'created_by');
	}

	/**
	 * Scope to filter logs by date range.
	 */
	public function scopeBetweenDates($query, string $startDate, string $endDate)
	{
		return $query->whereBetween('created_at', [$startDate, $endDate]);
	}

	public function setContextAttribute($value)
	{
		$this->attributes['context'] = is_array($value) ? json_encode($value) : $value;
	}

	public function setExtraAttribute($value)
	{
		$this->attributes['extra'] = is_array($value) ? json_encode($value) : $value;
	}

	public function setRequestHeadersAttribute($value)
	{
		$this->attributes['request_headers'] = is_array($value) ? json_encode($value) : $value;
	}

	public function setRequestBodyAttribute($value)
	{
		$this->attributes['request_body'] = is_array($value) ? json_encode($value) : $value;
	}

	protected $appends = ['user_name'];

	public function getUserNameAttribute()
	{
		return $this->user ? $this->user->name : '-';
	}
}
