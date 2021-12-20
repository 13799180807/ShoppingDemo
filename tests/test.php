<?php


use Application\Dao\GoodsCategoryDaoImpl;
use Application\Dao\GoodsDaoImpl;
use Application\Dao\GoodsIntroductionDaoImpl;
use Application\Dao\GoodsPictureDaoImpl;
use Application\Helper\FeedBack;
use Application\Helper\FilterHelper;
use Application\Helper\RegularExpression;
use Application\Library\Connection;
use Application\Library\SqlUtil;
use Application\Service\GoodsCategoryServiceImpl;
use Application\Service\GoodsIntroductionServiceImpl;
use Application\Service\GoodsPictureServiceImpl;
use Application\Service\GoodsServiceImpl;

echo " 测试页面 <hr>";
echo "<hr>";


//$sql="SELECT * FROM tb_goods_category ";
//var_dump((new SqlUtil())->run("queryAll",$sql));

//$sql="SELECT * FROM tb_goods WHERE goods_category_id=? and goods_status=? ORDER BY created_at LIMIT ?,?";
//
//var_dump((new SqlUtil())->run("query",$sql,"iiii",array(1,1,1,3)));





///** 新版本统计 */
//$sql="SELECT goods_id FROM tb_goods WHERE goods_category_id=? and goods_status=? ";
//var_dump((new SqlUtil())->run("count",$sql,"ii",array(1,1)));



//新版本插入
//$sql = "INSERT INTO demo (name, pwd) VALUES (?,?)";
//var_dump((new SqlUtil())->run("save",$sql,"ss",array("6去","2")));




/** 删除一个分类  */
//(new GoodsCategoryServiceImpl())->removeByGoodsCategoryId(6);






//新版本插入
//$sql = "INSERT INTO demo (name, pwd) VALUES (?,?)";
//var_dump((new SqlUtil())->run("save",$sql,"ss",array("asd","1234")));

//新版本更新
//$sql = "update demo set name=?,pwd=? where id=?";
//var_dump((new SqlUtil())->run("update",$sql,"ssi",array("5asd","51234",5)));

//新版本删除
//$sql="DELETE FROM demo WHERE id=?";
//var_dump((new SqlUtil())->run("remove",$sql,"i",array(5)));



//$type="save";
//
//if ($type=="save" || $type=="update") {
//
//    echo 1;
//}else{
//    echo 2;
//}

//$sql = "update demo set name=?,pwd=? where id=?";
//if ((new UpdateBuilder())->run($sql,"sss",array("336","333","500"))){
//    echo "yes";
//}else{
//    echo "失败";
//}

//$sql = "INSERT INTO demo (name, pwd) VALUES (?,?)";
//if ((new SaveBuilder())->run($sql,"ss",array("636","yes"))) {
//    echo "成功";
//}else{
//    echo "失败";
//}

//(new SaveBuilder())->run("aaa");
//
//(new SaveBuilder())->run("aaa");
//(new SaveBuilder())->run("aaa");
//(new SaveBuilder())->run("aaa");
//(new SaveBuilder())->run("aaa");
//(new SaveBuilder())->run("aaa");
//echo SaveBuilder::$conn;
//$arr=array("account","s1234",'account',"");
//$res=(new RegularExpression)->run($arr);
//var_dump($res);

//$sql="SELECT\s''  FROM tb_goods  WHERE goods_status=? ORDER BY created_at LIMIT ?,?";
//
//$pattern = "/(select[\s])|(insert[\s])|(update[\s])|(delete[\s])|(from[\s])|(where[\s])|(drop[\s])/i";
//$sql="/(select[\s])";
//$res=escapeString($pattern);
//echo $res;

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

  

