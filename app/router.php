<?php

$webRoot = __DIR__ . '/web';
$uri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
$file = $webRoot . $uri;

// Serve the file directly if it exists (static assets)
if ($uri !== '/' && file_exists($file) && !is_dir($file)) {
    return false;
}

// Set these so Yii doesn't break on routing
$_SERVER['SCRIPT_FILENAME'] = $webRoot . '/index.php';
$_SERVER['SCRIPT_NAME'] = '/index.php';

require $webRoot . '/index.php';