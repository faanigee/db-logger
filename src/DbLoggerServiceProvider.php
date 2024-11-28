<?php

namespace Faanigee\DbLogger;

use Illuminate\Support\ServiceProvider;

class DbLoggerServiceProvider extends ServiceProvider
{
	/**
	 * The middleware aliases.
	 *
	 * @var array
	 */
	protected $middlewareAliases = [
		'log.requests' => \Faanigee\DbLogger\Http\Middleware\LogRequests::class,
	];
	/**
	 * Register services.
	 */
	public function register(): void
	{
		$this->mergeConfigFrom(__DIR__ . '/../config/dblogger.php', 'dblogger');

		$this->app->bind('dblogger', function ($app) {
			return new DbLogger($app);
		});
	}

	/**
	 * Bootstrap services.
	 */
	public function boot(): void
	{
		// Load package configurations
		$this->publishes([__DIR__ . '/../config/dblogger.php' => config_path('dblogger.php'),], 'config');

		// Load migrations
		$this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

		// Load views
		$this->loadViewsFrom(__DIR__ . '/../resources/views', 'dblogger');

		// Publish views
		// $this->publishes([
		//     __DIR__ . '/../resources/views' => resource_path('views/vendor/dblogger'),
		// ], 'views');


		$this->loadRoutesFrom(__DIR__ . '/../routes/web.php');

		\Blade::directive('formatJson', function ($expression) {
			return "<?php echo \Faanigee\DbLogger\Helpers\JsonFormatter::formatJsonForDisplay($expression); ?>";
		});
	}
}
