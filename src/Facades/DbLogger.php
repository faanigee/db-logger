<?php

namespace Faanigee\DbLogger\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \Packages\DbLogger\Models\Log emergency(string $message, array $context = [])
 * @method static \Packages\DbLogger\Models\Log alert(string $message, array $context = [])
 * @method static \Packages\DbLogger\Models\Log critical(string $message, array $context = [])
 * @method static \Packages\DbLogger\Models\Log error(string $message, array $context = [])
 * @method static \Packages\DbLogger\Models\Log warning(string $message, array $context = [])
 * @method static \Packages\DbLogger\Models\Log notice(string $message, array $context = [])
 * @method static \Packages\DbLogger\Models\Log info(string $message, array $context = [])
 * @method static \Packages\DbLogger\Models\Log debug(string $message, array $context = [])
 * @method static \Packages\DbLogger\Models\Log log(string $level, string $message, array $context = [], array $extra = [])
 */
class DbLogger extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'dblogger';
    }
}
