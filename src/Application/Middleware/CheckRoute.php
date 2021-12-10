<?php
namespace src\Application\Middleware;

class CheckRoute
{

    /**
     * 进行匹配
     * @param $key
     * @return bool
     */
    public function matching($key): bool
    {
        $rows= array(
            "GoodsHome",      //主页
            "GoodsCategoryPage", //分类页面
            "GoodsProduct",  //详情页面
            "GoodsFuzzy",  //模糊查询
            "Demo1Add1",
            "Demo1Add2",
        );
        foreach (array_keys($rows) as $val) {

            if ($rows[$val] == $key) {
                return true;
            }
        }
        return false;
    }




}