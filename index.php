<?php
require_once __DIR__ . '/vendor/autoload.php';

// definig base URL dynamically
$scriptName = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));
define('BASE_URL', $scriptName === '/' ? '' : $scriptName);

Router::dispatch();