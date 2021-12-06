<?php


class GoodsCategory
{
    public $goodsCategoryId;
    public $goodsCategoryName;

    /**
     * GoodsCategory constructor.
     * @param $goodsCategoryId
     * @param $goodsCategoryName
     */
    public function __construct($goodsCategoryId="", $goodsCategoryName="")
    {
        $this->goodsCategoryId = $goodsCategoryId;
        $this->goodsCategoryName = $goodsCategoryName;
    }



}