<?php

define('ROOT_DIR', __DIR__);
function autoload($className){
    $className = ltrim($className, '\\');
    $fileName = '';
    $namespace = '';
    if($lastNsPos = strrpos($className, '\\')){
        $namespace = substr($className, 0, $lastNsPos);
        $className = substr($className, $lastNsPos + 1);
        $fileName = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
    }
    $fileName .= $className . '.php';

    //echo $fileName;
    require ROOT_DIR . '/' . $fileName;
}

spl_autoload_register('autoload');

use model\testactions\TestAction;
use controller\MVCController;
use controller\UserSession;
use controller\HUtils;
use controller\db\Database;






error_reporting(E_ALL);
ini_set('log_errors','1');
ini_set('display_errors','1');

session_start();

$redis = new Redis();
$redis->connect('sc-redis','6379');
$redis->auth("password");
$redis->set('DB_CREATED', false);
echo $redis->get('DB_CREATED');
if(!$redis->get('DB_CREATED') || $redis->get('DB_CREATED') == ''){
    Database::createDBIfNotPresent();
    $redis->set('DB_CREATED', true);
}


//date_default_timezone_set('Europe/Amsterdam');

$mvcController = new MVCController();
$mvcController->executeModel();
if(!isset($_POST['testaction'])){
    include_once(ROOT_DIR."/view/content_pagetemplate.php");
}
//require_once('aaaadea');
//http_response_code(200);
TestAction::returnLogAsText();
?>