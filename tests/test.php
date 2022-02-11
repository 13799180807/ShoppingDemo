<?php

use Application\Dao\GoodsCategoryDaoImpl;
use Application\Dao\GoodsDaoImpl;
use Application\Dao\GoodsIntroductionDaoImpl;
use Application\Dao\GoodsPictureDaoImpl;
use Application\Dao\ShoppingCartsDaoImpl;
use Application\Dao\UserInformationDaoImpl;
use Application\Helper\FeedBack;
use Application\Helper\Filter;
use Application\Helper\Request;
use Application\Library\Connection;
use Application\Library\SqlUtil;
use Application\Service\GoodsCategoryServiceImpl;
use Application\Service\GoodsPictureServiceImpl;
use Application\Service\GoodsServiceImpl;


echo " 测试页面 <hr>";
echo "<hr>";

//$res=(new \Application\Service\ShoppingCartsServiceImpl())->listByUserCarts("dexian");
//$res=(new \Application\Dao\ShoppingCartsDaoImpl())->getByField(null,"",9);
//$res1=(new \Application\Service\ShoppingCartsServiceImpl())->saveShoppingCart("dexian",2,1);


//$res=(new \Application\Service\AdminServiceImpl())->auditRecharge(10,1);
//var_dump($res['data']['carts']);
//var_dump($res['data']['goods']);

//(new \Application\Controller\Home\CartsController())->actionListCarts();



//$res=(new \Application\Service\UserServiceImpl())->listUserInformation();
//var_dump($res);
//var_dump($res['data']);
//var_dump($res['data']['user']);
//$informationRes = (new UserInformationDaoImpl())->listUserInformationByField();
//$res1 = (new UserInformationDaoImpl())->countUserInformationByField("dexian");
//var_dump($informationRes);
//var_dump($res1);
//$res=(new \Application\Service\UserServiceImpl())->listRechargeScore(null,null,null,null,1,10);
//var_dump($res);

//$res=(new \Application\Dao\RechargeScoreDaoImpl())->listByField(null,null,"dexian",null,1,2);
//$res = (new \Application\Dao\RechargeScoreDaoImpl())->countByField(null,null,"dexian");

//$res=(new \Application\Service\UserServiceImpl())->saveRechargeScore("dexian","15.56");
//var_dump($res);

//(new \Application\Dao\RechargeScoreDaoImpl())->updateRechargeScore(1,1,"ni",2);
//(new \Application\Dao\RechargeScoreDaoImpl())->removeByUserId("dexian");
////var_dump(Request::ip());
//echo $_SERVER['SERVER_NAME'];


//$res=(new \Application\Service\UserServiceImpl())->moveUser("771");
//$res = (new \Application\Dao\UserInformationDaoImpl())->updateUserInformation("771", "更新","13960760606",50,"123456");
//var_dump($res);

//$e=(new \Application\Service\UserServiceImpl())->getUserData("dexian");
//var_dump($e['data']);


//$paymentPwd=payPwd(1,"565");
//var_dump($paymentPwd);
//var_dump((new \Application\Service\UserServiceImpl())->saveUserInformation(66, "hello", 12345678912, "963541"));


//var_dump((new \Application\Dao\UserInformationDaoImpl())->listUserInformationByField("","","user_score"));
//var_dump((new \Application\Dao\UserInformationDaoImpl())->saveUserInformation(rand(6,1000), "2", 12345698745, 10000, "123456"));


//var_dump((new GoodsServiceImpl())->removeByGoodsId(1));
//$pictureRes = (new GoodsPictureDaoImpl())->getGoodsId(32);
//if (count($pictureRes) != 0) {
//    foreach ($pictureRes as $row) {
//        $path = UPLOAD_PATH .$row['goods_picture_path'];
//        deleteFile($path);
//    }
//}

//var_dump((new \Application\Middleware\Session("33f3a8822017b8ad2698c5e7546a8174"))->getToken());
//var_dump((new \Application\Middleware\Session("","admin123"))->setToken());

//$res=(new GoodsDaoImpl())->getByField("goods_id", "i", 5);
//var_dump($res[0]['goods_img']);


/** 保存一个账号信息 */
//var_dump((new \Application\Service\UserServiceImpl())->saveUser("123456","123456"));
//var_dump((new \Application\Service\UserServiceImpl())->saveUser("abc123","abc123"));
/** 验证登入 */
//var_dump((new \Application\Service\UserServiceImpl())->login("abc1231","abc123"));

/** 获取一个记录 */
//var_dump((new \Application\Dao\UserDaoImpl())->getById("abc123"));

/** 添加一个用户 */
//var_dump((new \Application\Dao\UserDaoImpl())->saveUser("abc123","abc123"));


/** 数据删除 */
//(new GoodsServiceImpl())->removeByGoodsId(23);

/** 商品添加测试 */
//var_dump((new GoodsServiceImpl())->saveGoods("1连载1",3,15.69,1,1,1,1,"测而已","3.jpg","sia"));

/** 数据库插入 */
//$sql = "INSERT INTO demo (name, pwd) VALUES (?,?)";
//var_dump((new SqlUtil())->run("save",$sql,"ss",array("小1明","222")));

///** 插入商品测试 */
//var_dump((new GoodsDaoImpl())->saveGoods("测试save",3,15.69,1,1,1,1,"测试说明而已","3.jpg"));

/** 查询商品表中的某个数据存在不存在 */
//var_dump((new GoodsDaoImpl())->getByField("goods_name","s","小猪佩奇"));


//var_dump($conf);
//$conf=require_once './../src/database.json';
//$conf=json_decode($conf, true);

//echo encryption("admin","123456");

//$num="0";
//if ( preg_match("/^[0-9][0-9]*$/" ,$num)) {
//    echo 1;
//} else{
//    echo 2;
//}
//





