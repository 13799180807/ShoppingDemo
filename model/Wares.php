<?php

function WaresindexlistJson($rows){
    /**
     * 显示出来
     * //主要用途例如：热度排序（访问量），销量最高（已售出）,最新产品（上架时间）
     */
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
    //$a=successJson("请求成功",array("wareslist"=>$userList));
    $a=array("wareslist"=>$userList);
    return $a;
}

/**
 * @param $rows
 * @return array[]
 * 商品详情页用的主要部分显示
 */
function WaresdetailList($rows){
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
    $a=array("wareslist"=>$userList);
    return $a;
}

function WareslistJson($rows){
    /**
     * 显示出来
     */
        $i=0;
        foreach ($rows as $row){
            $c=new Wares();
            $c->sp_uid=$row[0];  //商品UID
            $c->sp_varieties=$row[1]; //商品分类
            $c->sp_name=$row[2];      //商品名字
            $c->sp_price=$row[3];     //商品价格
            $c->sp_num=$row[4];       //剩余库存
            $c->sp_state=$row[5];     //商品状态
            $c->sp_text=$row[6];      //商品描述
            $c->sp_imgpath=$row[7];   //商品主图
            $c->sp_hot=$row[8];       //访问量/热门程度
            $c->sp_collection=$row[9]; //商品被收藏数
            $c->sp_sold=$row[10];      //已售出多少数量
            $c->sp_admin=$row[11];      //商品创建者
            $c->sp_create_time=$row[12];  //创建时间
            $userList[$i]=$c;
            $i++;
        }
        $a=successJson("请求成功",array("wareslist"=>$userList));
      //  echo $a;
        return $a;
}

class Wares
{
    /** public**/
    var $sp_uid;  //商品id
    var $sp_varieties;  //商品分类
    var $sp_name;   //商品名字
    var $sp_price;  //商品价格
    var $sp_num;    //商品数量/库存
    var $sp_state;  //商品状态
    var $sp_text;    //商品描述
    var $sp_imgpath;  //商品主图片1
    var $sp_hot;     //热门程度
    var $sp_collection; //商品收藏数
    var $sp_sold;     //已售出
    var $sp_admin;    //操作者
    var $create_time;  //创建时间

    /**
     * Wares constructor.
     * @param $sp_uid
     * @param $sp_varieties
     * @param $sp_name
     * @param $sp_price
     * @param $sp_num
     * @param $sp_state
     * @param $sp_text
     * @param $sp_imgpath
     * @param $sp_hot
     * @param $sp_collection
     * @param $sp_sold
     * @param $sp_admin
     * @param $create_time
     */
//    public function __construct($sp_uid=“”, $sp_varieties=“”, $sp_name=“”, $sp_price=“”, $sp_num=“”, $sp_state=“”, $sp_text=“”, $sp_imgpath=“”, $sp_hot=“”, $sp_collection=“”, $sp_sold=“”, $sp_admin=“”, $create_time=“”)
//    {
//        $this->sp_uid = $sp_uid;
//        $this->sp_varieties = $sp_varieties;
//        $this->sp_name = $sp_name;
//        $this->sp_price = $sp_price;
//        $this->sp_num = $sp_num;
//        $this->sp_state = $sp_state;
//        $this->sp_text = $sp_text;
//        $this->sp_imgpath = $sp_imgpath;
//        $this->sp_hot = $sp_hot;
//        $this->sp_collection = $sp_collection;
//        $this->sp_sold = $sp_sold;
//        $this->sp_admin = $sp_admin;
//        $this->create_time = $create_time;
//    }

//    function add($rows){
//        /**
//         * 显示出来
//         * //主要用途例如：热度排序（访问量），销量最高（已售出）,最新产品（上架时间）
//         */
//        $i=0;
//        foreach ($rows as $row){
//            $c=new Wares();
//            $c->sp_uid=$row[0];  //商品UID
//            $c->sp_name=$row[1];      //商品名字
//            $c->sp_price=$row[2];     //商品价格
//            $c->sp_imgpath=$row[3];   //商品主图
//            $c->sp_hot=$row[4];       //访问量/热门程度
//            $userList[$i]=$c;
//            $i++;
//        }
//        $a=successJson("请求成功",array("wareslist"=>$userList));
//        //  echo $a;
//        return $a;
//    }

    /**
     * @return mixed
     */
    public function getSpUid()
    {
        return $this->sp_uid;
    }



    /**
     * @param mixed $sp_uid
     */
    public function setSpUid($sp_uid)
    {
        $this->sp_uid = $sp_uid;
    }

    /**
     * @return mixed
     */
    public function getSpVarieties()
    {
        return $this->sp_varieties;
    }

    /**
     * @param mixed $sp_varieties
     */
    public function setSpVarieties($sp_varieties)
    {
        $this->sp_varieties = $sp_varieties;
    }

    /**
     * @return mixed
     */
    public function getSpName()
    {
        return $this->sp_name;
    }

    /**
     * @param mixed $sp_name
     */
    public function setSpName($sp_name)
    {
        $this->sp_name = $sp_name;
    }

    /**
     * @return mixed
     */
    public function getSpPrice()
    {
        return $this->sp_price;
    }

    /**
     * @param mixed $sp_price
     */
    public function setSpPrice($sp_price)
    {
        $this->sp_price = $sp_price;
    }

    /**
     * @return mixed
     */
    public function getSpNum()
    {
        return $this->sp_num;
    }

    /**
     * @param mixed $sp_num
     */
    public function setSpNum($sp_num)
    {
        $this->sp_num = $sp_num;
    }

    /**
     * @return mixed
     */
    public function getSpState()
    {
        return $this->sp_state;
    }

    /**
     * @param mixed $sp_state
     */
    public function setSpState($sp_state)
    {
        $this->sp_state = $sp_state;
    }

    /**
     * @return mixed
     */
    public function getSpText()
    {
        return $this->sp_text;
    }

    /**
     * @param mixed $sp_text
     */
    public function setSpText($sp_text)
    {
        $this->sp_text = $sp_text;
    }

    /**
     * @return mixed
     */
    public function getSpImgpath()
    {
        return $this->sp_imgpath;
    }

    /**
     * @param mixed $sp_imgpath
     */
    public function setSpImgpath($sp_imgpath)
    {
        $this->sp_imgpath = $sp_imgpath;
    }

    /**
     * @return mixed
     */
    public function getSpHot()
    {
        return $this->sp_hot;
    }

    /**
     * @param mixed $sp_hot
     */
    public function setSpHot($sp_hot)
    {
        $this->sp_host = $sp_hot;
    }

    /**
     * @return mixed
     */
    public function getSpCollection()
    {
        return $this->sp_collection;
    }

    /**
     * @param mixed $sp_collection
     */
    public function setSpCollection($sp_collection)
    {
        $this->sp_collection = $sp_collection;
    }

    /**
     * @return mixed
     */
    public function getSpSold()
    {
        return $this->sp_sold;
    }

    /**
     * @param mixed $sp_sold
     */
    public function setSpSold($sp_sold)
    {
        $this->sp_sold = $sp_sold;
    }

    /**
     * @return mixed
     */
    public function getSpAdmin()
    {
        return $this->sp_admin;
    }

    /**
     * @param mixed $sp_admin
     */
    public function setSpAdmin($sp_admin)
    {
        $this->sp_admin = $sp_admin;
    }

    /**
     * @return mixed
     */
    public function getCreateTime()
    {
        return $this->create_time;
    }

    /**
     * @param mixed $create_time
     */
    public function setCreateTime($create_time)
    {
        $this->create_time = $create_time;
    } //创建时间

}