<?php
header("Content-type:Application/json;charset=utf-8");

class WaresController
{

    //商品分类信息显示
    public static function waresSortAll(){

        //前端数据还没处理
        $arr=WaresServiceImpl::waresShowAll("sp_hot","5","上1架");
        if($arr=="-1"){
            $arr=array(
                0=>array('','','','','','','','','','','','',''),
            );
            $arr=WaresModelAll::waresIndexAll($arr);
            $json=successJson("请求成功,数据为空",$arr,"0");
            return $json;
        }else{
            $arr=WaresModelAll::waresIndexAll($arr);
            $json=successJson("请求成功",$arr);
            return $json;
        }
    }

    //当个商品详情页面
    public static function waresDetailsAll(){

        //前端数据还没处理
        $arr=WaresServiceImpl::waresOneAll(50);
        if($arr=="-1"){
            $arr=array(
                0=>array('','','','','','','','','','','','',''),
            );
            $arr=WaresModelAll::waresOneDereils($arr);
            $json=successJson("请求成功,数据为空",$arr,"0");
            return $json;
        }else{
            $arr=WaresModelAll::waresOneDereils($arr);
            $json=successJson("请求成功",$arr);
            return $json;
        }
    }

    //单个商品图片信息显示
    public static function waresImgAll(){

        //前端接受过来为进行处理
        $arr=WaresServiceImpl::waresImgAll(30);
        if ($arr=="-1"){
            $arr=array(
                0=>array('','',''),
            );
            $arr=WaresModelAll::waresDetailsImg($arr);
            $json=successJson("请求成功,数据为空",$arr,"0");
            return $json;
        }else{
            $arr=WaresModelAll::waresDetailsImg($arr);
            $json=successJson("请求成功",$arr);
            return $json;
        }
    }

    //单个商品详细信息介绍
    public static function waresTextAll(){
        //前端接受过来未进行处理
         $arr=WaresServiceImpl::waresTextAll(3);
         if($arr=="-1"){
             $arr=array(
                 0=>array('','',''),
             );
             $arr=WaresModelAll::waresDerailsText($arr);
             $json=successJson("请求成功,数据为空",$arr,"0");
             return $json;
         }else{
             $arr=WaresModelAll::waresDerailsText($arr);
             $json=successJson("请求成功",$arr);
             return $json;
         }
    }




}