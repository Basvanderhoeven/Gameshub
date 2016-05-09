<?php
define('ENVIRONMENT', 'development');

if (ENVIRONMENT == 'development' || ENVIRONMENT == 'dev') {
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
}
define('URL_PUBLIC_FOLDER', 'public');
define('URL_PROTOCOL', 'http://');
define('URL_DOMAIN', $_SERVER['HTTP_HOST']);
define('URL_SUB_FOLDER', str_replace(URL_PUBLIC_FOLDER, '', dirname($_SERVER['SCRIPT_NAME'])));
define('URL', URL_PROTOCOL . URL_DOMAIN . URL_SUB_FOLDER);
define('DB_TYPE', 'mysql');
if(URL_DOMAIN == 'gamehub.rvzee.nl'){
    define('DB_HOST', '127.0.0.1');
} else {
    define('DB_HOST', '86.93.38.158');
}
define('DB_NAME', 'gamehub');
define('DB_USER', 'bas');
define('DB_PASS', 'VDh03v3n');
define('DB_CHARSET', 'utf8');