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

require '../src/Application/Library/Connection.php';
require '../src/Application/Library/DeleteBuilder.php';
require '../src/Application/Library/QueryBuilder.php';

require '../src/Application/Model/GoodsModel.php';
require '../src/Application/Model/GoodsCategoryModel.php';

require '../src/Application/Dao/GoodsDao.php';
require '../src/Application/Dao/GoodsPictureDao.php';
require '../src/Application/Dao/GoodsCategoryDao.php';
require '../src/Application/Dao/GoodsIntroductionDao.php';

require '../src/Application/Service/GoodsService.php';
require '../src/Application/Service/GoodsPictureService.php';
require '../src/Application/Service/GoodsCategoryService.php';
require '../src/Application/Service/GoodsIntroductionService.php';

require '../src/Application/Controller/GoodsController.php';
require '../src/Application/Controller/GoodsCategoryController.php';








