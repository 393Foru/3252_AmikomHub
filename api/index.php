<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
putenv("VIEW_COMPILED_PATH=/tmp");
putenv("CACHE_DRIVER=array");
putenv("LOG_CHANNEL=stderr");
putenv("SESSION_DRIVER=cookie");
require __DIR__ . "/../public/index.php";
