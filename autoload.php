<?php
/**
 * autoload.php  08.08.21 21:49
 * Created for project pay54.ru API
 * www.econsultlab.ru
 * mail: info@econsultlab.ru
 * Released under the GNU General Public License
 * Copyright (c) 2021 Econsult Lab.
 */

define('PAY54_ROOT_PATH', dirname(__FILE__));

function pay54ruSdkLoadClass($className)
{
    //var_dump($className);
	if (strncmp('Pay54ru', $className, 7) === 0) {
        $path   = PAY54_ROOT_PATH;
        $length = 7;
    } else {
        return;
    }
    $path .= str_replace('\\', '/', substr($className, $length)) . '.php';

    if (file_exists($path)) {
        require $path;
    }
}

spl_autoload_register('pay54ruSdkLoadClass');
