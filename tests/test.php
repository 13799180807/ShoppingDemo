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
use Application\Service\GoodsIntroductionServiceImpl;
use Application\Service\GoodsPictureServiceImpl;
use Application\Service\GoodsServiceImpl;

echo " 测试页面 <hr>";
//$sql="SELECT\s''  FROM tb_goods  WHERE goods_status=? ORDER BY created_at LIMIT ?,?";

$pattern = "/(select[\s])|(insert[\s])|(update[\s])|(delete[\s])|(from[\s])|(where[\s])|(drop[\s])/i";
$sql="/(select[\s])";
$res=escapeString($pattern);
echo $res;

//(new GoodsCategoryServiceImpl())->deleteByGoodsCategoryId(8);
//(new GoodsIntroductionDaoImpl())->deleteByGoodsId(19);

//(new GoodsCategoryDaoImpl())->deleteByGoodsCategoryId(8);
//var_dump((new GoodsCategoryServiceImpl())->listGoodsCategoryIndex(1,1,5));


//var_dump((new GoodsCategoryServiceImpl())->listGoodsCategoryName());

//echo (new GoodsCategoryDaoImpl())->countGoodsCategoryId(1,20);
//$data=(new GoodsServiceImpl())->listGoodsIdShow(0);
//var_dump($data);
//var_dump((new GoodsIntroductionServiceImpl())->getGoodsId(5));
//var_dump((new GoodsPictureServiceImpl())->getGoodsId(3));



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

  

