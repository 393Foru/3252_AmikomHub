<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
putenv("CACHE_DRIVER=array");
putenv("LOG_CHANNEL=stderr");
putenv("SESSION_DRIVER=cookie");
putenv("VIEW_COMPILED_PATH=/tmp");
putenv("APP_CONFIG_CACHE=/tmp/config.php");
putenv("APP_EVENTS_CACHE=/tmp/events.php");
putenv("APP_PACKAGES_CACHE=/tmp/packages.php");
putenv("APP_ROUTES_CACHE=/tmp/routes.php");
putenv("APP_SERVICES_CACHE=/tmp/services.php");
$_SERVER['HTTP_ACCEPT'] = 'application/json';

try {
    require __DIR__ . "/../public/index.php";
} catch (\Throwable $e) {
    echo "<h1>Original Error:</h1>";
    echo "<pre>";
    echo $e->getMessage() . "\n\n";
    echo $e->getTraceAsString();
    echo "</pre>";
}
