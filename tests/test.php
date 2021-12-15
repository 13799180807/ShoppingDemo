<?php


use Application\Library\Connection;
use Application\Service\GoodsCategoryServiceImpl;

echo " 测试页面 <hr>";

//GoodsCategoryServiceImpl::deleteByGoodsCategoryId(6);
//$conn=Connection::conn();
//$row=GoodsDaoImpl::listGoodsCategoryId($conn,1);
//if (count($row)>0)
//{
//    foreach ($row as $value)
//    {
//        echo $value['goods_id']."<br/>";
//    }
//}
//
//$conn=Connection::conn();
//var_dump(listGoodsCategoryPagination($conn,1,1,8,));
// function listGoodsCategoryPagination($conn,int $categoryId,int $page,int $num,int $status=1) :array
//{
//
//    $page=($page-1)*$num;
//    $sql="SELECT * FROM tb_goods WHERE goods_category_id=? and goods_status=? ORDER BY created_at LIMIT ?,?";
//    $stmt = $conn->stmt_init();
//    $stmt->prepare($sql);
//    $stmt->bind_param(0,"i",$categoryId);
//    $stmt->bind_param(1,"i",$status);
//    $stmt->bind_param(2,"i",$page);
//    $stmt->bind_param(3,"i",$num);
//  //  $stmt->bind_param("iiii",$categoryId,$status,$page,$num);
////    $stmt->bind_param("iiii",$categoryId,$status,$page,$num);
//
//
//
//    $stmt->execute();
//    return Connection::releaseRes($stmt);
//
//}

//GoodsCategoryServiceImpl::deleteByGoodsCategoryId(5);
//
//
//echo "<hr>";
//echo "end";
//$da1 =;
//$row=$GLOBAL($da1);
////
//$conn=Connection::conn();

//$a=QueryBuilder::queryAll($conn,"demo");
//var_dump($a);

//var_dump($_GET);

//var_dump($_POST);
//echo "<br />";
//$arr=array();
//$arr['id']="elect into";
//$arr['he']="ele%2111110ct ;<>';into";
//$arr['llo']="&quot;//into";
//$arr['word']="elect\\to";
//var_dump($arr);
//$arr=\src\Application\Helper\FilterHelper::safeReplace($arr);
//
////$arr=FilterHelper::safeReplace($arr);
//
//echo "<br />";
//var_dump($arr);

  

