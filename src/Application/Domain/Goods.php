<?php
namespace Application\Domain;

class Goods
{
    public $goodsId; //id
    public $goodsName; //名字
    public $goodsCategoryId; //分类id
    public $goodsPrice;  //价格
    public $goodsStock; //库存
    public $goodsStatus; //状态
    public $goodsHot; //热门
    public $goodsRecommendation; //推荐
    public $goodsDescribe; //简单描述
    public $goodsImg;    //主图
    public $createdAt;  //创建时间
    public $updatedAt;   //最后更新时间

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
    public function getGoodsName()
    {
        return $this->goodsName;
    }

    /**
     * @param mixed $goodsName
     */
    public function setGoodsName($goodsName): void
    {
        $this->goodsName = $goodsName;
    }

    /**
     * @return mixed
     */
    public function getGoodsCategoryId()
    {
        return $this->goodsCategoryId;
    }

    /**
     * @param mixed $goodsCategoryId
     */
    public function setGoodsCategoryId($goodsCategoryId): void
    {
        $this->goodsCategoryId = $goodsCategoryId;
    }

    /**
     * @return mixed
     */
    public function getGoodsPrice()
    {
        return $this->goodsPrice;
    }

    /**
     * @param mixed $goodsPrice
     */
    public function setGoodsPrice($goodsPrice): void
    {
        $this->goodsPrice = $goodsPrice;
    }

    /**
     * @return mixed
     */
    public function getGoodsStock()
    {
        return $this->goodsStock;
    }

    /**
     * @param mixed $goodsStock
     */
    public function setGoodsStock($goodsStock): void
    {
        $this->goodsStock = $goodsStock;
    }

    /**
     * @return mixed
     */
    public function getGoodsStatus()
    {
        return $this->goodsStatus;
    }

    /**
     * @param mixed $goodsStatus
     */
    public function setGoodsStatus($goodsStatus): void
    {
        $this->goodsStatus = $goodsStatus;
    }

    /**
     * @return mixed
     */
    public function getGoodsHot()
    {
        return $this->goodsHot;
    }

    /**
     * @param mixed $goodsHot
     */
    public function setGoodsHot($goodsHot): void
    {
        $this->goodsHot = $goodsHot;
    }

    /**
     * @return mixed
     */
    public function getGoodsRecommendation()
    {
        return $this->goodsRecommendation;
    }

    /**
     * @param mixed $goodsRecommendation
     */
    public function setGoodsRecommendation($goodsRecommendation): void
    {
        $this->goodsRecommendation = $goodsRecommendation;
    }

    /**
     * @return mixed
     */
    public function getGoodsDescribe()
    {
        return $this->goodsDescribe;
    }

    /**
     * @param mixed $goodsDescribe
     */
    public function setGoodsDescribe($goodsDescribe): void
    {
        $this->goodsDescribe = $goodsDescribe;
    }

    /**
     * @return mixed
     */
    public function getGoodsImg()
    {
        return $this->goodsImg;
    }

    /**
     * @param mixed $goodsImg
     */
    public function setGoodsImg($goodsImg): void
    {
        $this->goodsImg = $goodsImg;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param mixed $createdAt
     */
    public function setCreatedAt($createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param mixed $updatedAt
     */
    public function setUpdatedAt($updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }






}