<?php
namespace src\Application\Domain;

class GoodsIntroduction
{
    public $id; //id
    public $goodsId; //商品id
    public $goodsIntroduction;//详情说明

    /**
     * GoodsIntroduction constructor.
     * @param $id
     * @param $goodsId
     * @param $goodsIntroduce
     */
    public function __construct($id="", $goodsId="", $goodsIntroduce="")
    {
        $this->id = $id;
        $this->goodsId = $goodsId;
        $this->goodsIntroduction = $goodsIntroduce;
    }


}