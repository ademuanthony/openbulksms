<?php

/**
 * Configuration
 *
 * For more info about constants please @see http://php.net/manual/en/function.define.php
 * If you want to know why we use "define" instead of "const" @see http://stackoverflow.com/q/2447791/1114320
 */

/**
 * Configuration for: Error reporting
 * Useful to show every little problem during development, but only show hard errors in production
 */
error_reporting(E_ALL);
ini_set("display_errors", 1);

/**
 * Configuration for: Project URL
 * Put your URL here, for local development "127.0.0.1" or "localhost" (plus sub-folder) is fine
 */

 
define('URL', 'http://www.shallomsms.com/');
define('APP_NAME', 'Shallom Bulk SMS');
define('API_URL', 'http://smssite.crusoex.com/');
define('API_USERNAME', 'Ab');
define('API_PASSWORD', '0000');



define('M_ID', '1426-15816');
define('PRICE_PER_UNIT', 1);
define('UNITS_PER_SMS', 1.65);




/**
 * Configuration for: Database
 * This is the place where you define your database credentials, database type etc.
 */
 ///*
define('DB_TYPE', 'mysql');
define('DB_HOST', 'MYSQL5008.Smarterasp.net');
define('DB_NAME', 'db_9a9b4e_shallom');
define('DB_USER', '9a9b4e_shallom');
define('DB_PASS', 'ojima123');
//*/

/*
define('DB_HOST', 'localhost');
define('DB_NAME', 'dehopesms');
define('DB_USER', 'root');
define('DB_PASS', '');
*/

//partial views
define('VIEW_HEADER', 'header');
define('VIEW_CONTENT', 'content');
define('VIEW_FOOTER', 'footer');
define('VIEW_SIDE_MENU', 'side_menu');

$partial_view = array();