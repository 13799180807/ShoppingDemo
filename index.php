<?php
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

