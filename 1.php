<?php
require 'application/Core/database/Connection.php';
require 'application/Config/config.php';
require 'application/Config/json.php';
require 'application/Core/database/DelectBuilder.php';
require 'application/Core/database/QueryBuilder.php';
require 'application/Dao/waresDao.php';
require 'application/Model/WaresModelAll.php';


/**
 * 分类查询显示
 */
$dao = new waresDaolmpl();
//$json=$dao->waresShowindex("sp_hot","5","上架");

//$json=$dao->waresShowImg("3");
//echo $json;

//$json=$dao->waresShowText("50");
//echo $json;

$json=$dao->waresShowDetails(3);
echo $json;



//$conn=Connection::conn();




//$sql= "SELECT * FROM shop_warestext WHERE sp_uid='3'";
//$result=$conn->query($sql);
//$rows=$result->fetch_all();
//mysqli_free_result($result);
//mysqli_close($conn);
//var_dump($rows);



//$a=waresShow("sp_hot","5","上架");
//var_dump($a);