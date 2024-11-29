# DbLogger Package for Laravel

A powerful and flexible database logging package for Laravel applications that supports batch logging, queued operations, and context enrichment.

## Features

- Simple integration with Laravel applications
- Database-backed persistent logging
- Support for all standard log levels
- Request context logging
- User tracking
- Batch logging support
- Asynchronous (queued) logging
- Context enrichment
- Configurable retention policies
- Log viewer interface

## Requirements

- PHP >= 8.1
- Laravel >= 10.0
- Database support (MySQL, PostgreSQL, etc.)
- Redis (optional, for queue support)

## Installation

1. Install the package via Composer:
```bash
composer require faanigee/dblogger
```

2. Publish the configuration file:
```bash
php artisan vendor:publish --provider="Faanigee\DbLogger\DbLoggerServiceProvider" --tag="config"

```
## Publish the views (optional):
```bash
php artisan vendor:publish --provider="Faanigee\DbLogger\DbLoggerServiceProvider" --tag="views"
```

## Enviroment Variables
```env
DB_LOGGER_CONNECTION=log_db
DB_LOGGER_HOST=mariadb
DB_LOGGER_PORT=3306
DB_LOGGER_DATABASE=accounts_logs
DB_LOGGER_USERNAME=root
DB_LOGGER_PASSWORD=
LOG_LEVEL=debug

DB_LOGGER_RETENTION_DAYS=30
DB_LOGGER_BATCH_SIZE=100
DB_LOGGER_BATCH_TIMEOUT=120
DB_LOGGER_QUEUE_NAME=db_logger
DB_LOGGER_QUEUE_CONNECTION=radis
DB_LOGGER_STYLE=light
```

## Add connection for database in config/database.php if Database connection error occured (Optional)

```php
'connections' => [
	'log_db' => [
		'driver' => 'mysql',
		'host' => env('LOG_DB_HOST', '127.0.0.1'),
		'port' => env('LOG_DB_PORT', '3306'),
		'database' => env('LOG_DB_DATABASE', 'logs_database'),
		'username' => env('LOG_DB_USERNAME', 'root'),
		'password' => env('LOG_DB_PASSWORD', ''),
		'charset' => 'utf8mb4',
		'collation' => 'utf8mb4_unicode_ci',
		'prefix' => '',
		'strict' => true,
		'engine' => null,
	],
],
```

3. Configure your database connection in `config/dblogger.php`:
```php
return [
	'queue' => [
		'enabled' => env('DB_LOGGER_QUEUE_ENABLED', false),
		'connection' => env('DB_LOGGER_QUEUE_CONNECTION', 'redis'),
		'queue' => env('DB_LOGGER_QUEUE_NAME', 'logs'),
	],
	'batch' => [
		'size' => env('DB_LOGGER_BATCH_SIZE', 100),
		'timeout' => env('DB_LOGGER_BATCH_TIMEOUT', 30),
	],
	'retention' => [
		'days' => env('DB_LOGGER_RETENTION_DAYS', 90),
		'levels' => [
			'emergency' => 365,
			'alert' => 180,
			'critical' => 180,
			'error' => 90,
			'warning' => 60,
			'notice' => 30,
			'info' => 30,
			'debug' => 15,
		],
	],
];
```

4. Run the migrations:
```bash
php artisan migrate
```

## Usage

### Basic Logging

```php
use Faanigee\DbLogger\Facades\DbLogger;

// Simple logging
DbLogger::info($ref_id, $ref_type, 'User logged in successfully');

// Logging with context
DbLogger::error($ref_id, $ref_type, 'Payment failed', ['amount' => 100, 'currency' => 'USD']);
```

### Batch Logging

```php
use Faanigee\DbLogger\Facades\DbLogger;

$entries = [
	[
		'level' => 'info',
		'ref_id' => 1,
		'ref_type' => 'user',
		'message' => 'User created',
		'context' => ['email' => 'user@example.com']
	],
	[
		'level' => 'info',
		'ref_id' => 1,
		'ref_type' => 'profile',
		'message' => 'Profile updated',
		'context' => ['fields' => ['name', 'avatar']]
	]
];

DbLogger::logBatch($entries);
```

### Asynchronous Logging

```php
use Faanigee\DbLogger\Facades\DbLogger;

// Log asynchronously using queues
DbLogger::logAsync('info', $ref_id, $ref_type, 'Processing started', ['job_id' => 123]);
```

### Enhanced Context Logging

```php
use Faanigee\DbLogger\Facades\DbLogger;

// Log with automatically enriched context
DbLogger::logWithContext($ref_id, $ref_type, 'Action performed', ['custom' => 'data']);
```

### Available Log Levels

- emergency
- alert
- critical
- error
- warning
- notice
- info
- debug

### Accessing the Log Viewer

The package comes with a built-in log viewer, just visit the following url:

- List view: `/db-logs`
- Detail view: `/db-logs/{id}`

### Configuration

You can customize the package behavior through the `config/dblogger.php` file:

- Configure the database connection
- Configure queue settings for async logging
- Set batch processing parameters
- Set log retention period
- Customize database connection
- Customize pagination settings


### Cleanup Old Logs

Run the cleanup command to remove old logs based on retention policy:

```bash
php artisan logs:cleanup
```

Or schedule it in your `App\Console\Kernel`:

```php
protected function schedule(Schedule $schedule)
{
	$schedule->command('dblogger:cleanup')->daily();
}
```


## Security

If you discover any security related issues, please email irfanahmad@msn.com instead of using the issue tracker.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
