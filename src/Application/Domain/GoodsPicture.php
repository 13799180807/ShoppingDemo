<?php
namespace Application\Domain;

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





}