<?php
use Tracy\Debugger;

//setup debug environment
if ('WL_DEBUG_ENABLED') {
    //$handler = $GLOBALS['handler'];
    //$handler->turnOff();
    //unset($handler);
    //unset($GLOBALS['handler']);
    Debugger::$showBar = true;
    Debugger::enable(Debugger::DEVELOPMENT, WL_LOGS_BASE_DIR);
} else {
    Debugger::enable();
}


$newTime = microtime(true);
$microtime = [
    'System Boot and Page render' => $newTime - $GLOBALS['time']
];


// TODO refactor afterwards
if(isset($GLOBALS['cachedPage'])){

    echo $GLOBALS['cachedPage'];
    unset($GLOBALS['cachedPage']);
    exit (0);

}


