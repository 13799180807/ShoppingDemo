<?php
require 'application/Library/WaresImg.php';
require 'application/Library/WaresText.php';
require 'application/Library/Wares.php';


class WaresModelAll
{
    /**
     * @param $rows
     * @return array[]
     *主页分类显示
     */
    public static function waresIndexAll($rows){
        $i=0;
        foreach ($rows as $row){
            $c=new Wares();
            $c->sp_uid=$row[0];  //商品UID
            $c->sp_name=$row[1]; //商品名字
            $c->sp_price=$row[2]; //商品价格
            $c->sp_imgpath=$row[3]; //商品主图
            $c->sp_hot=$row[4];   //访问量/热门程度  用来畅销产品给星级
            $c->sp_sold=$row[5]; //已售出 用来畅销产品给星级
            $userList[$i]=$c;
            $i++;
        }
        $arr=array("wareslist"=>$userList);
        return $arr;
    }

    /**
     * @param $rows
     * @return array[]
     * 商品图片
     */
    public static function waresDetailsImg($rows){
        $i=0;
        foreach ($rows as $row){
            $c=new WaresImg($row[0],$row[1]);
            $userList[$i]=$c;
            $i++;
        }
        $arr=array("wareslist"=>$userList);
        return $arr;
    }

    /**
     * @param $rows
     * @return array[]
     * 商品详情信息文本介绍用的
     */
    public static function waresDerailsText($rows){
        $i=0;
        foreach ($rows as $row){
            $c=new WaresText($row[0],$row[1]);
            $userList[$i]=$c;
            $i++;
        }
        $arr=array("wareslist"=>$userList);
        return $arr;
    }

    /**
     * @param $rows
     * @return array[]
     * 商品详情页面使用
     */
    public static function waresDereilsAll($rows){
        $i=0;
        foreach ($rows as $row){
            $c=new Wares();
            $c->sp_uid=$row[0];  //商品UID
            $c->sp_varieties=$row[1]; //商品分类
            $c->sp_name=$row[2]; //商品名字
            $c->sp_price=$row[3]; //商品价格
            $c->sp_num=$row[4];       //剩余库存
            $c->sp_imgpath=$row[5]; //商品主图
            $c->sp_hot=$row[6];       //访问量/热门程度
            $c->sp_sold=$row[7]; //已售出 用来畅销产品给星级
            $c->sp_text=$row[8];      //商品描述
            $userList[$i]=$c;
            $i++;
        }
        $all=array("wareslist"=>$userList);
        return $all;
    }


}

