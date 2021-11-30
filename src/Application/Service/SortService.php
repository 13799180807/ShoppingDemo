<?php
require 'SortServiceImpl.php';
interface SortService
{

    /**
     * @return mixed
     * 显示分类查询列表信息
     */
    public function sortAll();

    /**
     * @return mixed
     * 删除一个分类
     */
    public function sortDel($id);

    /**
     * @param $name
     * @return mixed
     * 添加一个分类
     */
    public function sortAdd($name);

    /**
     * @param $id
     * @param $name
     * @return mixed
     * 更新一个分类
     */
    public function sortUpate($id,$name);

    /**
     * @param $sortName
     * @param $pages
     * @param $num
     * @return mixed
     * 分页显示
     */
    public function sortWaresPages($sortName,$pages,$num);

    /**
     * @param $sortName
     * @param $num
     * @return mixed
     * 给前端显示有多少页面
     */
    public function waresPagesNum($sortName,$num);


}
