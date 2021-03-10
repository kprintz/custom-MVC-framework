<?php
spl_autoload_register(function($className) {
    try {
        $className = str_replace('\\', DIRECTORY_SEPARATOR, $className);
        if (!file_exists($className . '.php')) {
            throw new \Exception('Autoloading file did not exist');
        }
        include_once $className . '.php';
    } catch (\Exception $ex) {
        error_log($ex->getMessage() . $ex->getTraceAsString() . "\n", 3, 'var/error.log');
    }
});
