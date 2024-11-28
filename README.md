# DbLogger Package for Laravel

A Laravel package that enables logging to a separate database with a clean interface and built-in log viewer.

## Features

- Store logs in a separate database
- Configurable database connection
- Built-in log viewer with filtering capabilities
- Support for all standard log levels
- Log retention policy
- Capture additional context (IP, User Agent, User ID)

## Requirements

- PHP ^8.1
- Laravel ^10.0

## Installation

1. Add the package to your Laravel project:

```bash
composer faanigee/dblogger
```

2. Publish the configuration file:

```bash
php artisan vendor:publish --provider="Faanigee\DbLogger\DbLoggerServiceProvider" --tag="config"
```

3. Publish the views (optional):

```bash
php artisan vendor:publish --provider="Faanigee\DbLogger\DbLoggerServiceProvider" --tag="views"
```

4. Configure your environment variables:

```env
LOG_DB_CONNECTION=log_db
LOG_DB_HOST=127.0.0.1
LOG_DB_PORT=3306
LOG_DB_DATABASE=laravel_logs
LOG_DB_USERNAME=your_username
LOG_DB_PASSWORD=your_password
LOG_RETENTION_DAYS=30
LOG_LEVEL=debug
```

Add the logs database connection to `config/database.php`:

```database.php
'connections' => [
    // ... other connections

    'logs' => [
        'driver' => 'mysql',
        'host' => env('LOG_DB_HOST', '127.0.0.1'),
        'port' => env('LOG_DB_PORT', '3306'),
        'database' => env('LOG_DB_DATABASE', 'logs'),
        'username' => env('LOG_DB_USERNAME', 'forge'),
        'password' => env('LOG_DB_PASSWORD', ''),
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'strict' => true,
        'engine' => null,
    ],
],
```

````
5. Run the migrations:

```bash
php artisan migrate
````

## Usage

### Basic Logging

```php
use Packages\DbLogger\Facades\DbLogger;

// Log messages with different severity levels
DbLogger::info(1234555, 'Cash Payment', 'Cash Voucher Posted Successfully', [
    'user_id' => auth()?->id(),
    'user_name' => auth()?->name,
    'response_status' => 'Success',
]);
DbLogger::debug(1234555, 'Cash Payment', 'Failed: Cash Voucher Posting Failed, Exception Occured', [
    'user_id' => auth()?->id(),
    'user_name' => auth()?->name,
    'response_status' => 'Failed',
    'request_info' => $request->all(),
    'error' => $error->getMessage(),
    'trace' => $error->getTraceAsString(),
]);

// Log with additional context
DbLogger::info('Reference Id', 'Reference Type', 'Message', [
    'user_id' => 1,
    'action' => 'profile_updated'
]);

// Log with extra data
DbLogger::error('Reference Id', 'Reference Type', 'API Error', ['error_code' => 500], [
    'request_data' => $request->all(),
    'response' => $response->json()
]);
```

### Accessing the Log Viewer

The package comes with a built-in log viewer, just visit the following url:

Then visit `/db-logs` in your browser to view the logs.

### Customizing Views

If you've published the views, you can find them in `resources/views/vendor/dblogger/`. Modify them according to your needs.

### Configuration

The package configuration file (`config/dblogger.php`) allows you to:

- Configure the database connection
- Set log retention period
- Define minimum log level
- Customize pagination settings

### Cleanup Old Logs

To automatically clean up old logs based on the retention period, add the following to your `app/Console/Kernel.php`:

```php
protected function schedule(Schedule $schedule)
{
    $schedule->command('dblogger:cleanup')->daily();
}
```

## Contributing

Please see [CONTRIBUTING.md](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email irfanahmad@msn.com instead of using the issue tracker.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
