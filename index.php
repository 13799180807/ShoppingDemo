<?php
/**
 * 收集错误
 */
error_reporting(-1);
ini_set('display_errors',0);
ini_set('log_errors',1);
ini_set('error_log','logs/sys_log');
require 'application/Core/database/Connection.php';
require 'application/Config/config.php';
require 'application/Config/json.php';
require 'application/Core/database/DelectBuilder.php';
require 'application/Core/database/QueryBuilder.php';
require 'application/Dao/waresDao.php';
require 'application/Model/WaresModelAll.php';






$dao = new waresDaolmpl();
$json=$dao->waresShowDetails(3);
echo $json;




////路由配置
//
//$a=isset($_REQUEST['a'] ) ? $_REQUEST['a']:'';
//if (empty($a)){
//
//    //  include 'application/Views/home/index.view.php';
//    // header("application/Views/home/index.view.php");
//    // var_dump($a);
//   echo "index page";
//}else{
//
//   // var_dump($a);
//     include $a.".php";
//}

