<?php
/***
 * Created by ANH To.
 * Date: 10/2/14
 * Time: 10:48
 */
/** This setup just work from OC 2.0.x */
require_once("lib/function.php");

// Configuration
if (file_exists('../../config.php')) {
    require_once('../../config.php');
}

// Startup
require_once(DIR_SYSTEM . 'startup.php');

if (is_dir(DIR_SYSTEM."storage/")) {
    $version = "2.1.x";
    define('VERSION', '2.1.0.1');
}else{
    $version = "2.0.x";
    define("VERSION", "2.0.1.0");
}

// Registry
$registry = new Registry();

// Loader
$loader = new Loader($registry);
$registry->set('load', $loader);

// Config
$config = new Config();
$registry->set('config', $config);

// Database
$db = new DB(DB_DRIVER, DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
$registry->set('db', $db);

// Store
if (isset($_SERVER['HTTPS']) && (($_SERVER['HTTPS'] == 'on') || ($_SERVER['HTTPS'] == '1'))) {
    $store_query = $db->query("SELECT * FROM " . DB_PREFIX . "store WHERE REPLACE(`ssl`, 'www.', '') = '" . $db->escape('https://' . str_replace('www.', '', $_SERVER['HTTP_HOST']) . rtrim(dirname($_SERVER['PHP_SELF']), '/.\\') . '/') . "'");
} else {
    $store_query = $db->query("SELECT * FROM " . DB_PREFIX . "store WHERE REPLACE(`url`, 'www.', '') = '" . $db->escape('http://' . str_replace('www.', '', $_SERVER['HTTP_HOST']) . rtrim(dirname($_SERVER['PHP_SELF']), '/.\\') . '/') . "'");
}

if ($store_query->num_rows) {
    $config->set('config_store_id', $store_query->row['store_id']);
} else {
    $config->set('config_store_id', 0);
}

// Language Detection
$languages = array();

$query = $db->query("SELECT * FROM `" . DB_PREFIX . "language` WHERE status = '1'");

foreach ($query->rows as $result) {
    $languages[$result['code']] = $result;
}

date_default_timezone_set("Asia/Saigon");

// Request
$request = new Request();
$registry->set('request', $request);

$enable_import_sample = true;

// check connected internet, ensure to install theme
$connected = @fopen("http://www.google.com:80/","r");

if (!$connected) {
    die("<span style='color:red'>Please ensure you have connected to internet.</span>");
}

require_once "post.php";
require_once "form.php";
