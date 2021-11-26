<?php
error_reporting(-1);
ini_set('display_errors',0);
ini_set('log_errors',1);
ini_set('error_log','../logs/sys_log');


require '../src/functions.php';
require '../src/constants.php';
require '../src/Application/Middleware/CheckRoute.php';
require '../src/Application/Model/Route.php';
require '../src/Application/Library/Connection.php';
require '../src/Application/Library/DelectBuilder.php';
require '../src/Application/Library/QueryBuilder.php';
require '../src/Application/Dao/WaresDao.php';
require '../src/Application/Service/WaresService.php';
require '../src/Application/Controller/Home/WaresController.php';
require '../src/Application/Model/WaresModelAll.php';


