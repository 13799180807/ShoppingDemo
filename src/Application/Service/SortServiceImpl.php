<?php


class SortServiceImpl implements SortService
{

    /**
     * @return int|mixed
     * 查询显示的结果
     */
    public static function sortAll()
    {
        // TODO: Implement sortAll() method.
        $conn=Connection::conn();
        $dao=new SortDaoImpl();
        $rows=$dao->sortListQuery($conn);
        $conn->close();
        if (count($rows)>0){
            return $rows;
        }else{
            return -1;
        }
    }

    /**
     * @param $id
     * @return bool|mixed
     * 删除一个分类
     */
    public static function sortDel($id)
    {
        $conn=Connection::conn();
        $dao=new SortDaoImpl();
        $res=$dao->sortOneDelect($conn,$id);
        $conn->close();
        return $res;
    }


    /**
     * @param $name
     * @return int
     * 添加一个分类
     * 存在不添加，不存在就添加
     */
    public static function sortAdd($name)
    {
        // TODO: Implement sortAdd() method.
        $conn=Connection::conn();
        $res=QueryBuilder::innserQuery($conn,"shop_sort","sort_name=?","s",$name);

        if($res=="1"){
            $dao=new SortDaoImpl();
            $res=$dao->sortInsert($conn,$name);
            if ($res){
                $conn->close();
                return 1;
            }
        }
        $conn->close();
        return -1;
    }

    /**
     * @param $id
     * @param $name
     * @return int
     * 更新一个分类，判断分类是否存在，不存在执行，存在不执行
     */
    public static function sortUpate($id, $name)
    {
        // TODO: Implement sortUpate() method.
        $conn=Connection::conn();
        $res=QueryBuilder::innserQuery($conn,"shop_sort","sort_name=?","s",$name);
        if ($res=="1"){
            $dao=new SortDaoImpl();
            $res=$dao->sortUpdate($conn,$id,$name);
            if ($res){
                $conn->close();
                return 1;
            }
        }
        $conn->close();
        return -1;
    }

    /**
     * @param $sortName
     * @param $pages
     * @param $num
     * @return mixed|void
     * 分页查询显示
     */
    public static function sortWaresPages($sortName, $pages, $num)
    {
        // TODO: Implement sortWaresPages() method.
        $conn=Connection::conn();
        $dao=new SortDaoImpl();
        $rows=$dao->waresSortQuery($conn,$sortName,$pages,$num);
        $conn->close();
        if (count($rows)==0){
            return -1;
        }else{
            return $rows;
        }
    }

    /**
     * @param $sortName
     * @param $num
     * @return false|float|mixed
     * 给出分页数码
     */
    public static function waresPagesNum($sortName,$num)
    {
        // TODO: Implement waresPagesNum() method.
        $conn=Connection::conn();
        $dao=new SortDaoImpl();
        $pages=$dao->waresPage($conn,$sortName,$num);
        $conn->close();
        return $pages;
    }
}

