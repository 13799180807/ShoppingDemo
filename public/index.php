<?php
//header("Access-Control-Allow-Credentials: true");
//header("Access-Control-Allow-Origin: *");
//header("Access-Control-Allow-Methods: GET,POST,OPTIONS,PUT,DELETE");
//header('Access-Control-Allow-Headers:x-requested-with,content-type,test-token,test-sessid');

/** 引用配置文件*/
define('APP_PATH',__DIR__.'/../');
//$composerData = json_decode(file_get_contents(APP_PATH."composer.json"),true);
define('APP_NAME','src/Application');
define('APPLICATION',APP_PATH.'src/');
define('DEBUG',false);
date_default_timezone_set("Asia/Shanghai");
/** 错误收集 */
if (DEBUG)
{
    error_reporting(-1);
    ini_set('display_errors',0);
    ini_set('log_errors',1);
    ini_set('error_log','../logs/sys_log');
}

/** 引入文件 */
include APP_PATH . 'core/Frame.php';

/** 自动载入 */
spl_autoload_register('\core\Frame::loader');

/** 启动框架 */
\core\Frame::run();










