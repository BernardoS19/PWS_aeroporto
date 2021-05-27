<?php
namespace ArmoredCore;

use Tracy\Debugger;
use Tracy\ILogger;

class DebugAdapter implements \ArmoredCore\Interfaces\ComponentRegisterInterface
{

    /**
     * @inheritDoc
     */
    public function registerRequirements()
    {
        // TODO: Implement registerRequirements() method.
    }

    public function setupRequirements($requiredParams)
    {
        // TODO: Implement setupRequirements() method.
    }

    public function barDump( $var, string $title = '', array $options = [] ){
        Debugger::barDump($var, $title, $options);
    }

    public function dump( $var, bool $return = false){
        Debugger::dump($var, $return);
    }

    public function timer(string $name = ''): float{
        return Debugger::timer($name);
    }

    public function log(string $message, string $level = ILogger::INFO){
        Debugger::log($message, $level);
    }

    public function fireLog(string $message){
        Debugger::fireLog($message);
    }
}