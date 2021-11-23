<?php


class Wares
{
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
    var $create_time; //创建时间

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
    public function setSpUid($sp_uid): void
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
    public function setSpVarieties($sp_varieties): void
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
    public function setSpName($sp_name): void
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
    public function setSpPrice($sp_price): void
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
    public function setSpNum($sp_num): void
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
    public function setSpState($sp_state): void
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
    public function setSpText($sp_text): void
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
    public function setSpImgpath($sp_imgpath): void
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
    public function setSpHot($sp_hot): void
    {
        $this->sp_hot = $sp_hot;
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
    public function setSpCollection($sp_collection): void
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
    public function setSpSold($sp_sold): void
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
    public function setSpAdmin($sp_admin): void
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
    public function setCreateTime($create_time): void
    {
        $this->create_time = $create_time;
    }





}