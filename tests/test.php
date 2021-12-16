<?php


use Application\Dao\GoodsCategoryDaoImpl;
use Application\Dao\GoodsDaoImpl;
use Application\Dao\GoodsIntroductionDaoImpl;
use Application\Dao\GoodsPictureDaoImpl;
use Application\Helper\FeedBack;
use Application\Library\Connection;
use Application\Library\CountBuilder;
use Application\Library\DeleteBuilder;
use Application\Library\QueryBuilder;
use Application\Service\GoodsCategoryServiceImpl;
use Application\Service\GoodsServiceImpl;

echo " 测试页面 <hr>";




//var_dump((new GoodsServiceImpl())->getByGoodsName("小"));
//var_dump((new GoodsServiceImpl())->getById(5));

//var_dump((new GoodsServiceImpl())->listField("goods_hot","1",1,5,));

//echo FeedBack::result(200,"123",$a);


//(new GoodsPictureDaoImpl())->deleteByGoodsId(30);
//var_dump((new GoodsPictureDaoImpl())->getGoodsId(30));

//(new GoodsIntroductionDaoImpl())->deleteByGoodsId(30);
//var_dump((new GoodsIntroductionDaoImpl())->getGoodsId(3));

//var_dump((new GoodsDaoImpl())->listGoodsCategoryId(1));

//var_dump((new GoodsDaoImpl())->getByGoodsName("%车%",2));
//var_dump(GoodsDaoImpl::listField("goods_hot","1",1,3));
//var_dump(GoodsDaoImpl::listField("created_at","1",1,7));
//var_dump(GoodsDaoImpl::getById(1,12));
//GoodsDaoImpl::deleteByGoodsCategoryId(6);


//GoodsCategoryDaoImpl::deleteByGoodsCategoryId(11);

//$a=GoodsCategoryDaoImpl::listGoodsCategoryName();

//var_dump(GoodsCategoryDaoImpl::listGoodsCategoryPagination(0,1,6));


//var_dump(GoodsCategoryDaoImpl::getGoodsCategoryId(1));
//$a=GoodsCategoryDaoImpl::countGoodsCategoryId(0,10);
//var_dump($a);


//$sql="SELECT * FROM tb_goods WHERE goods_category_id=? and goods_status=? ORDER BY created_at LIMIT ?,?";
//$key=array("2","1","1","3");
//$res=(new QueryBuilder())->run($sql,"iiii",$key);
//var_dump($res);

//$res = $conn->prepare("SELECT * FROM tb_goods WHERE goods_category_id=? and goods_status=? ORDER BY created_at LIMIT ?,?");
//$sql="SELECT * FROM tb_goods WHERE goods_category_id=? and goods_status=? ORDER BY created_at LIMIT ?,?";
//$key=array("1","1","1","3");
//QueryBuilder::listField($conn,$sql,"iiii",$key);



//$refArr = array("iiii",1,1,1,8);
//$ref = new ReflectionClass('mysqli_stmt');
//$method = $ref->getMethod("bind_param");
//$method->invokeArgs($res,$refArr);
//$res->execute();
//var_dump($res->execute());


function listGoodsCategoryPagination($conn,int $categoryId,int $page,int $num,int $status=1) :array
{

    $sql="SELECT * FROM tb_goods WHERE goods_category_id=? and goods_status=? ORDER BY created_at LIMIT ?,?";
    $stmt = $conn->prepare($sql);

    $arr=array('2','1','1','3');
    $stmt->bind_param('ssss', ...$arr);
    $stmt->execute();


    $result=$stmt->get_result();
    $rows=$result->fetch_all(2);
    $stmt->free_result();
    $stmt->close();
    var_dump($rows);


//
//    $page=($page-1)*$num;
//    $sql="SELECT * FROM tb_goods WHERE goods_category_id=? and goods_status=? ORDER BY created_at LIMIT ?,?";
//    $stmt = $conn->stmt_init();
//    $stmt->prepare($sql);
////    $stmt->bind_param(0,"i",$categoryId);
////    $stmt->bind_param(1,"i",$status);
////    $stmt->bind_param(2,"i",$page);
////    $stmt->bind_param(3,"i",$num);
//    $stmt->bind_param("iiii",$categoryId,$status,$page,$num);
////    $stmt->bind_param("iiii",$categoryId,$status,$page,$num);
//
//    $stmt->execute();
//    return Connection::releaseRes($stmt);

}

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

  

