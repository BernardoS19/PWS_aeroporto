<?php
use Pd\Diagnostics\CacheInfoPanel;
use Pd\Diagnostics\DatabaseInfoPanel;
use Tracy\Debugger;

// Cache
$cachePanel = new CacheInfoPanel($microtime);
Debugger::getBar()->addPanel($cachePanel);

// DB
$dbPanel = new DatabaseInfoPanel($dbp);
Debugger::getBar()->addPanel($dbPanel);

// Profiler
$profiler = new Netpromotion\Profiler\Adapter\TracyBarAdapter();
Debugger::getBar()->addPanel($profiler);

Debugger::$strictMode = true; // display all errors
