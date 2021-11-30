<?php
require '../src/settings.php';
//require '../src/Application/Views/Home/curl.php';





//
//$hot=GoodsServiceImpl::listByfield("goods_hot","1","1",5);
//$recommend=GoodsServiceImpl::listByfield("goods_recommend","1","1",5);
//$newest=GoodsServiceImpl::listByfield("created_at","1","1",5);
//
//$hot=GoodsModel::homePageinformationDisplay("hot",$hot);
//$recommend=GoodsModel::homePageinformationDisplay("recommend",$recommend);
//$newest=GoodsModel::homePageinformationDisplay("newest",$newest);
//
//$res=array(
//    "hor"=>$hot,
//    "recommend"=>$recommend,
//    "newest"=>$newest
//);
//
//$a=successJson("获取成功",$res);
//echo $a;
////var_dump($res);








//
//$a=GoodsServiceImpl::getById(1);
//var_dump($a);

//$a=GoodsServiceImpl::listByfield("goods_hot","1","1",3);
//var_dump($a);
//
//$hot=GoodsServiceImpl::listByfield("goods_hot","1","1",5);
//$recommend=GoodsServiceImpl::listByfield("goods_recommend","1","1",5);
//$newest=GoodsServiceImpl::listByfield("created_at","1","1",5);
//
//$hot=GoodsModel::homePageinformationDisplay("热门",$hot);
//$hot=array(
//    0=>array('','','','','','','','','','','',''),
//);
//$hot=GoodsModel::homePageinformationDisplay("hot",$hot);
//
//var_dump($hot);
//
//$hot=GoodsServiceImpl::listByfield("goods_hot","3","1",5);
////$recommend=GoodsServiceImpl::listByfield("goods_recommend","1","1",5);
////$newest=GoodsServiceImpl::listByfield("created_at","1","1",5);
//
//
//
//$hot=GoodsModel::homePageinformationDisplay("hot",$hot);
//
//
//var_dump($hot);
//$recommend=GoodsModel::homePageinformationDisplay("recommend",$recommend);
//$newest=GoodsModel::homePageinformationDisplay("newest",$newest);


//var_dump($hot);


//$hot=GoodsServiceImpl::listByfield("goods_hot","1","1",5);
//$recommend=GoodsServiceImpl::listByfield("goods_recommend","1","1",5);
//$newest=GoodsServiceImpl::listByfield("created_at","1","1",5);
//var_dump($hot);













//$cars = array
//(
//    array("cdx111", "456"),
//    array("cdx111", "456"),
//    array("cdx11", "4562"),
//);
//
//function userModel($cars){
//    $i=0;
//    foreach ($cars as $row){
//        $c=array();
//        $c["user"]=$row[0];
//        $c["password"]=md5($row[1]);
//        $dataList[$i]=$c;
//        $i++;
//    }
//    return $dataList;
//}
//$a=userModel($cars);
 //var_dump($a);
//$a=User::userModel($a);
//foreach ($a as $item){
//    foreach ($item as $value){
//        var_dump($value);
//    }
//}
//var_dump($a);


//
//$a=UserServiceImpl::addUser($a);
//var_dump($a);





//var_dump($cars);
//$cars = array
//(
//    array(
//        'user'=>"cdx1",
//        'password'=>"456"
//    ),
//    array(
//        'user'=>"cdx2",
//        'password'=>"456"
//    ),
//    array(
//        'user'=>"cdx3",
//        'password'=>"456"
//    ),
//);



//SortController::waresSortAdd();

//SortController::waresSortUpdate();
//var_dump(SortController::waresSortDel());


//$a=WaresController::waresFuzzySearchDisplay("木");
//var_dump($a);


//$s=SortController::waresSortPageList();
//echo $s;

//$dao=new SortDaoImpl();
//$conn=Connection::conn();
////$a=$dao->waresSortQuery($conn,"查询全部",1,5);
//$a=$dao->waresPage($conn,"查询全部",3);
//var_dump($a);
//
//$conn->close();


//$json=testUri();
//var_dump($json);
//
//
//
//
//function testUri(){
//    $url="http://localhost:8080/index/details/text/sin/";
//    $datalist=array();
//    $datalist["uid"]="5";
//    $json=curl_post($url,$datalist);
//    echo $json;
//    echo "<br />";
//    $tesrlist=JsonList($json);
//    return $tesrlist;
//}

//$urlSingle="http://localhost:8080/index/details/img/ii/";
//$datalist=array();
//$datalist["uid"]="3";
//$singleall=curl_post($urlSingle,$datalist);
//var_dump($singleall);


//
//function imgcurl(){
//    $url="http://localhost:8080/index/details/img/";
//    $postdata=array();
//    $postdata['uid']="3";
//    $imglist=curl_post($url,$postdata);
//    $imglist=JsonList($imglist);
//    if ($imglist=="-1"){
//        return -1;
//    }else{
//        return $imglist;
//    }
//}







