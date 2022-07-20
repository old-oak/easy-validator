<?php
/**
 * The MIT License
 *
 * Copyright (c) 2021
 */

define('OLD_OAK_EASY_VALIDATOR_ROOT_PATH', dirname(__FILE__));
define('OLD_OAK_EASY_VALIDATOR_PSR_LOG_PATH', dirname(__FILE__).'/../vendor/psr/log/Psr/Log');

function oldOakEasyValidatorLoadClass($class_name)
{
    if (strncmp('OldOak\EasyValidator', $class_name, 20) === 0) {
        $path   = OLD_OAK_EASY_VALIDATOR_ROOT_PATH;
        $length = 20;
    } elseif (strncmp('Psr\Log', $class_name, 7) === 0) {
        $path   = OLD_OAK_EASY_VALIDATOR_PSR_LOG_PATH;
        $length = 7;
    } else {
        return;
    }

    $path .= ('/src' . str_replace('\\', '/', substr($class_name, $length)) . '.php');
    if (is_file($path)) {
        require $path;
    }
}

spl_autoload_register('oldOakEasyValidatorLoadClass');