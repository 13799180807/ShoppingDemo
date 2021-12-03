<?php


class GoodsIntroduce
{
    public $id; //id
    public $goodsId; //商品id
    public $goodsIntroduce;//详情说明

    /**
     * GoodsIntroduce constructor.
     * @param $id
     * @param $goodsId
     * @param $goodsIntroduce
     */
    public function __construct($id="", $goodsId="", $goodsIntroduce="")
    {
        $this->id = $id;
        $this->goodsId = $goodsId;
        $this->goodsIntroduce = $goodsIntroduce;
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
    public function getGoodsIntroduce()
    {
        return $this->goodsIntroduce;
    }

    /**
     * @param mixed $goodsIntroduce
     */
    public function setGoodsIntroduce($goodsIntroduce): void
    {
        $this->goodsIntroduce = $goodsIntroduce;
    }



}