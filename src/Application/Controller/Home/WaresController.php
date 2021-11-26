<?php


class WaresController
{


    /**
     * @param $parameter
     * @return false|string
     * 商品分类信息显示
     */
    public static function waresSortAll($parameter){

        if (isset($parameter["method"])){

        }else{
            $errlist=array();
            $errlist['err']="请输入正确值";
            $json=failJson("请求失败，参数不正确", $errlist);
            return $json;
        }
        $typea=$parameter["method"];
        if ($typea=="hot"){
            $typea="sp_hot";
        }elseif ($typea=="sold"){
            $typea="sp_sold";
        }elseif ($typea=="time"){
            $typea="create_time";
        }else{
            $errlist=array();
            $errlist['err']="请输入正确值";
            $json=failJson("请求失败，参数不正确", $errlist);
            return $json;
        }
        $dao= new WaresServiceImpl();
        $arr=$dao->waresShowAll($typea,"5","上架");
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

    /**
     * @param $parameter
     * @return false|string
     * 单个商品详情页面
     */
    public static function waresDetailsAll($parameter){

        if (isset($parameter["uid"])){
            $sp_uid=$parameter["uid"];
            $dao= new WaresServiceImpl();
            $arr=$dao->waresOneAll($sp_uid);
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
        }else{
            $errlist=array();
            $errlist['err']="请输入正确值";
            $json=failJson("请求失败", $errlist);
            return $json;
        }
    }

    /**
     * @param $parameter
     * @return false|string
     * 单个商品图片信息显示
     */
    public static function waresImgAll($parameter){

        if (isset($parameter["uid"])) {
            $sp_uid = $parameter["uid"];
            $dao= new WaresServiceImpl();
            $arr=$dao->waresImgAll($sp_uid);
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
        }else{
            $errlist=array();
            $errlist['err']="请输入正确值";
            $json=failJson("请求失败", $errlist);
            return $json;
        }
    }


    /**
     * @param $parameter
     * @return false|string
     * 单个商品详细信息介绍
     */
    public static function waresTextAll($parameter){

        if (isset($parameter["uid"])) {
            $sp_uid = $parameter["uid"];
            $dao= new WaresServiceImpl();
            $arr=$dao->waresTextAll($sp_uid);
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
        }else{
            $errlist=array();
            $errlist['err']="请输入正确值";
            $json=failJson("请求失败", $errlist);
            return $json;
        }
    }

}