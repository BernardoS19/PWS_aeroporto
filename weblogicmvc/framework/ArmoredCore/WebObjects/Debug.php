<?php

namespace ArmoredCore\WebObjects;

use Tracy\ILogger;

/**
 * Created by SMendes
 * Date: 03-05-2021
 * @method static void barDump( $var, string $title = '', array $options = [] )
 * @method static void dump( $var, bool $return = false)
 * @method static float timer(string $name = '')
 * @method static void log(string $message, string $level = ILogger::INFO)
 * @method static void fireLog(string $message)
 */
class Debug extends \ArmoredCore\Facades\Facade
{
    protected static function getName()
    {
        return 'Debug';
    }
}