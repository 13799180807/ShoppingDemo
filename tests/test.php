<?php
use Application\Dao\GoodsCategoryDaoImpl;
use Application\Dao\GoodsDaoImpl;
use Application\Dao\GoodsIntroductionDaoImpl;
use Application\Dao\GoodsPictureDaoImpl;
use Application\Helper\DetectRequest;
use Application\Helper\FeedBack;
use Application\Helper\Filter;
use Application\Helper\RegularExpression;
use Application\Library\Connection;
use Application\Library\SqlUtil;
use Application\Service\GoodsCategoryServiceImpl;
use Application\Service\GoodsIntroductionServiceImpl;
use Application\Service\GoodsPictureServiceImpl;
use Application\Service\GoodsServiceImpl;

echo encryption("admin","123456");

//$num="0";
//if ( preg_match("/^[0-9][0-9]*$/" ,$num)) {
//    echo 1;
//} else{
//    echo 2;
//}
//
//$detectData=array(
//    0=>array('id',"55.3",'numInt',1,100000),
//    1=>array('page',1,"numInt",1,9999),
//    2=>array('num',3,"numInt",1,99),
//);
//
//$resDetectData=DetectRequest::detectRun($detectData);
//var_dump($resDetectData);



//var_dump((new GoodsServiceImpl())->updateGoodsById(1,'Ok吗',7,99.99,90,1,1,
//    1,'这是简单说明','1.jpg',"我是详细说名具体是什么你自己猜猜看呀哈哈哈"));
//$id=10;
//$str="修改了吗";
//
////
//if ( count((new GoodsIntroductionDaoImpl())->getGoodsId($id)) ==0 )
//{
//    /** 插入操作 */
//    var_dump((new GoodsIntroductionDaoImpl())->saveByGoodsId($id,$str));
//} else {
//    /** 修改操作 */
//    var_dump((new GoodsIntroductionDaoImpl())->updateByGoodsId($id,$str));
//}








/** 修改商品信息 */
//var_dump((new GoodsServiceImpl())->updateGoodsById(1,"01修改",3,1,1,1,
//    1,1,"lueluelu","2.jpg"));






//$data=array(
/*        "a"=>"<? W3S?h????>",*/
//        "b"=>"123",
//        "c"=>"!@#$%^&*(",
//);
//var_dump($data);
//echo "<hr>";
//$a=Filter::setEntities($data);
//echo $a['a'];
//echo "<hr>";





//$a='1";drop table demo; ';
//$sql = "update demo set name=?,pwd=? where id=?";
//var_dump((new SqlUtil())->run("update",$sql,"ssi",array($str,"33",46)));
//echo " 测试页面 <hr>";
//echo "<hr>";

//var_dump("1\r2\n3\4'5Control-Z");
//echo "1\r2\n3\4'5Control-Z";
////$sql = "update demo set name=?,pwd=? where id=?";
////
//$conn=(new Connection())->conn();
//$user = mysqli_real_escape_string($conn,"1\r2\n3\4'5Control-Z");
//$pwd = mysqli_real_escape_string($conn,"1\r2\n3\4'5Control-Z");
//var_dump($user);
//var_dump($pwd);
//
//$sql="UPDATE tb_goods SET goods_name=?,goods_category_id=?,goods_price=?,goods_stock=?,goods_status=?,
//                  goods_hot=?, goods_recommendation=? ,goods_describe=?,goods_img=? WHERE goods_id=? ";
//$test=array('修改01',2,'15.26',111,2,2,2,"更新测试","11.jpg",1);
// (new SqlUtil())->run("update",$sql,"sisiiiissi",$test);




/** 查询商品表中的某个数据存在不存在 */
//var_dump((new GoodsDaoImpl())->getByField("goods_name","s","1"));
/** 数据库更新 */
//$sql = "update demo set name=?,pwd=? where id=?";
//var_dump((new SqlUtil())->run("update",$sql,"ssi",array("小明","33",32)));
/** 数据库插入 */
//$sql = "INSERT INTO demo (name, pwd) VALUES (?,?)";
//var_dump((new SqlUtil())->run("save",$sql,"ss",array("小明","222")));

/** 用户获取分类信息 */
//$data=(new GoodsCategoryServiceImpl())->listGoodsCategory('user',1,5,1,5);
//var_dump($data);
/** 用户获取分页信息 */
//var_dump((new GoodsCategoryServiceImpl())->listGoodsCategory("admin",0,0,1,3,"",0,0));


/** 用户的模糊查询 */
//var_dump((new GoodsServiceImpl())->getByGoodsName("小"));
/** 单个商品的详细信息查看 */
//var_dump((new GoodsServiceImpl())->listGoodsIdShow("admin",5));
/** 主页显示的信息 */
//var_dump((new GoodsServiceImpl())->listIndex());

//var_dump((new GoodsDaoImpl())->listGoodsCategoryId(1));
//var_dump((new GoodsDaoImpl())->getByGoodsName("小"));
//var_dump((new GoodsDaoImpl())->listField(5,0,"goods_hot","21"));
//var_dump((new GoodsDaoImpl())->listField(5,0,"goods_hot",1,));
//var_dump((new GoodsDaoImpl())->getById("user",40,1));


//$a1="insert into from table value ('ss',''s);";
//$a2="delete from table ";
//$a3="select * from table where and where ";
//$a4="12345qwert";
/*$a5="?><:{}+_)*&^%$##@";*/
//$a6="~~@@!#$%^&*(){}][';<>.,//";
//
//
//$c="abc";
//$c1=(int)$c;
//var_dump($c);
//var_dump($c1);
//
//$c2="123";
//$c3=(string)$c2;
//var_dump($c2);
//var_dump($c3);



//echo "<hr>";
//
//$b1=escapeshellcmd($a1);
//echo $a1." || ".$b1;
//echo "<hr>";
//
//$b2=addslashes($a2);
//echo $a2." || ".$b2;
//echo "<hr>";
//
//$b3=escapeshellcmd($a3);
//echo $a3." || ".$b3;
//echo "<hr>";
//
//$b4=quotemeta($a4);
//echo $a4." || ".$b4;
//echo "<hr>";
//
//$b5=quotemeta($a5);
//echo $a5." || ".$b5;
//echo "<hr>";
//
//$b6=quotemeta($a6);
//echo $a6." || ".$b6;
//echo "<hr>";
//$var='123456Bob sd bob';
//echo str_replace("sd","A",$var);

//var_dump((new GoodsCategoryDaoImpl())->listGoodsCategoryPagination("admin","","0","0","0","0","1","5"));


//var_dump((new GoodsCategoryDaoImpl())->countCategoryByGoodsCondition(''));





//$a=splicing(array("AAAAAAAAAAasa",'demo_a_aaa_aas',"asAs",'*'));
//echo $a;


//var_dump((new GoodsCategoryDaoImpl())->countCategoryByGoodsCondition("","0","0","0","0"));
//var_dump((new GoodsCategoryDaoImpl())->countCategoryByGoodsCondition("","0","0","0","0"));




//$dataList=array();
//$dataList[]=2;
//$dataList[]=3;
//$dataList[]=1;
//var_dump($dataList);




//$requestData = array(
//    'name'=>"goodsName",
//    'status'=>"goodsStatus",
//    'label'=>"goodsLabel",
//    'category'=>"goodsCategory",
//    'num'=>"num",
//    'page'=>"page"
//);
//var_dump($requestData);


//$detectData=array(
//    0=>array('name',"11","str",0,10),
//    1=>array('status',"2","num",0,5),
//    2=>array('label',"2","num",0,5),
//    3=>array('category',"3","num",0,10),
//    4=>array('num',"6","num",5,50),
//    5=>array('page',"1","num",0,1000),
//);
//
//$res=DetectRequest::detectRun($detectData);
//
//var_dump(count($res));



//$requestData=array(
//    'name'=>'0',
//    'status'=>'1',
//    'label'=>'2',
//    'category'=>'0',
//    'num'=>'10',
//    'page'=>'1'
//);
//$res=array(true,$requestData);
//var_dump($res[0]);
//foreach ($requestData as $key=>$val ) {
//  echo $key.":".$val."<br/>";
//}
//$arr=array(
//    'name'=>'0',
//    'status'=>'1',
//    'label'=>'2',
//    'category'=>'0',
//    'num'=>'10',
//    'page'=>'1'
//);
//var_dump((new GoodsCategoryServiceImpl())->listAdminIndex($arr));



//var_dump((new GoodsCategoryDaoImpl())->countListAdminIndex(20,array("%","%","%","%","%")));


//$sql="SELECT * FROM tb_goods_category ";
//var_dump((new SqlUtil())->run("queryAll",$sql));

//$sql="SELECT * FROM tb_goods WHERE goods_category_id=? and goods_status=? ORDER BY created_at LIMIT ?,?";
//
//var_dump((new SqlUtil())->run("query",$sql,"iiii",array(1,1,1,3)));


///** 新版本统计 */
//$sql="SELECT goods_id FROM tb_goods WHERE goods_category_id=? and goods_status=? ";
//var_dump((new SqlUtil())->run("count",$sql,"ii",array(1,1)));







/** 删除一个分类  */
//(new GoodsCategoryServiceImpl())->removeByGoodsCategoryId(6);






//新版本插入
//$sql = "INSERT INTO demo (name, pwd) VALUES (?,?)";
//var_dump((new SqlUtil())->run("save",$sql,"ss",array("asd","1234")));



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
//$arr=\src\Application\Helper\Filter::safeReplace($arr);
//
////$arr=Filter::safeReplace($arr);
//
//echo "<br />";
//var_dump($arr);



