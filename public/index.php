<?php
error_reporting(-1);

use project\core\Router;

$query = rtrim($_SERVER['QUERY_STRING'], '/');

define('WWW', __DIR__);
define('CORE', dirname(__DIR__).'/project/core');
define('ROOT', dirname(__DIR__));
define('APP', dirname(__DIR__).'/app');
define('CONF', dirname(__DIR__).'/config');
define('LIB', dirname(__DIR__).'/project/lib');
define('LAYOUT', 'default');

$app_path = "http://{$_SERVER['HTTP_HOST']}{$_SERVER['PHP_SELF']}";
$app_path = preg_replace("#[^/]+$#", '', $app_path);
$app_path = str_replace('/public/', '', $app_path);
define("PATH", $app_path);
define("ADMIN", PATH.'/admin');

require __DIR__.'/../project/lib/functions.php';
require __DIR__. '/../vendor/autoload.php';

new \project\core\App();

Router::add('^$', ['controller' => 'Main', 'action' => 'index']);
Router::add('^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$');

Router::dispatch($query);

