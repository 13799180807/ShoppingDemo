<?php
date_default_timezone_set("Asia/Shanghai");
//error_reporting(-1);
//ini_set('display_errors',0);
//ini_set('log_errors',1);
//ini_set('error_log','../logs/sys_log');

require '../src/functions.php';
require '../src/constants.php';



require '../src/Application/Middleware/CheckRoute.php';
require '../src/Application/Model/Route.php';


require '../src/Application/Model/UserModel.php';

require '../src/Application/Library/Connection.php';
require '../src/Application/Library/DeleteBuilder.php';
require '../src/Application/Library/QueryBuilder.php';

require '../src/Application/Dao/GoodsDao.php';
require '../src/Application/Service/GoodsService.php';


require '../src/Application/Controller/GoodsController.php';
require '../src/Application/Controller/GoodsCategoryController.php';



require '../src/Application/Dao/GoodsCategoryDao.php';
require '../src/Application/Dao/GoodsIntroduceDao.php';
require '../src/Application/Service/GoodsIntroduceService.php';

require '../src/Application/Model/GoodsModel.php';
require '../src/Application/Model/GoodsCategoryModel.php';



require '../src/Application/Dao/GoodsPictureDao.php';
require '../src/Application/Service/GoodsPictureService.php';
require '../src/Application/Service/GoodsCategoryService.php';



require '../src/Application/Dao/UserDao.php';
require '../src/Application/Service/UserService.php';

require '../src/Application/Domain/User.php';


require '../src/Application/Controller/Home/UserController.php';



require '../src/Application/Helper/CharCode.php';




