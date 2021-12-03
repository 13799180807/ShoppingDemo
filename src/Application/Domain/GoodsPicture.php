<?php


class GoodsPicture
{
    public $id; //图片id
    public $goodsId;  //商品id
    public $goodsPicturePath; //图片路径

    /**
     * GoodsPicture constructor.
     * @param $id
     * @param $goodsId
     * @param $goodsPicturePath
     */
    public function __construct($id="", $goodsId="", $goodsPicturePath="")
    {
        $this->id = $id;
        $this->goodsId = $goodsId;
        $this->goodsPicturePath = $goodsPicturePath;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getGoodsId()
    {
        return $this->goodsId;
    }

    /**
     * @param mixed $goodsId
     */
    public function setGoodsId($goodsId): void
    {
        $this->goodsId = $goodsId;
    }

    /**
     * @return mixed
     */
    public function getGoodsPicturePath()
    {
        return $this->goodsPicturePath;
    }

    /**
     * @param mixed $goodsPicturePath
     */
    public function setGoodsPicturePath($goodsPicturePath): void
    {
        $this->goodsPicturePath = $goodsPicturePath;
    }




}