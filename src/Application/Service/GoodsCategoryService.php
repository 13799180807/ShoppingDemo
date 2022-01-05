<?php

namespace Application\Service;
interface GoodsCategoryService
{
    /**
     * 分类查询显示用的
     * @param string $userType
     * @param int $page
     * @param int $num
     * @param int $status
     * @param int $categoryId
     * @param string $name
     * @param int $hot
     * @param int $recommendation
     * @return array
     */
    public function listCategoryGoods(string $userType, int $page, int $num, int $status, int $categoryId = 0, string $name = "",
                                      int $hot = 0, int $recommendation = 0): array;

    /**
     * 获取分类所有信息
     * @return array
     */
    public function listCategory() :array;

//    /**
//     * 删除一个分类
//     * @param int $categoryId
//     * @return bool
//     */
//    public function removeByGoodsCategoryId(int $categoryId) :bool;
//








}