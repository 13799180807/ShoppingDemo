<?php


class SortController
{

    /**
     * 显示分类
     */
    public static function  waresSortList(){
        //前端为处理
        $dao=new SortServiceImpl();
        $res=$dao->sortAll();
        var_dump($res);

    }

    /**
     * 分类删除
     */
    public static function  waresSortDel(){
        //前端为处理
        $dao=new SortServiceImpl();
        $res=$dao->sortDel("5");
        var_dump($res);
    }

    /**
     * 添加分类
     */
    public static function waresSortAdd(){
        //前端为处理
        $dao=new SortServiceImpl();
        $res=$dao->sortAdd("ceshi111");
        var_dump($res);
    }

    /**
     * 更新分类
     */
    public static function waresSortUpdate(){
        //前端处理
        $dao=new SortServiceImpl();
        $res=$dao->sortUpate("11","是我");
        var_dump($res);
    }

}