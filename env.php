<?php
function loadEnv($file = '.env')
{
    $rootPath = dirname(__FILE__);
    $envPath = $rootPath . '/' . $file;

    if (!file_exists($envPath)) {
        throw new Exception("Arquivo .env não encontrado!");
    }

    $lines = file($envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) {
            continue;
        }
        list($key, $value) = explode('=', $line, 2);
        putenv("$key=$value");
    }
}
