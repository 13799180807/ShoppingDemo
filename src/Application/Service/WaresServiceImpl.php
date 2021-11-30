<?php

class WaresServiceImpl implements WaresService
{

    /**
     * @param $typea
     * @param $num
     * @param $state
     * @return int|mixed
     */
    public static function waresShowAll($typea, $num, $state)
    {
        // TODO: Implement waresShowAll() method.
        $conn=Connection::conn();
        $dao=new WaresDaoImpl();
        $rows=$dao->waresNewsQuery($conn,$typea,$num,$state);
        $conn->close();
        if (count($rows)>0){
            return $rows;
        }else{
            return -1;
        }
    }

    /**
     * @param $sp_uid
     * @return int|mixed
     */
    public static function waresImgAll($sp_uid)
    {
        // TODO: Implement waresImgAll() method.
        $conn=Connection::conn();
        $dao=new WaresDaoImpl();
        $rows=$dao->waresImgQuery($conn,$sp_uid);
        $conn->close();
        if (count($rows)>0){
            return $rows;
        }else{
            return -1;
        }
    }

    /**
     * @param $sp_uid
     * @return int|mixed
     */
    public static function waresTextAll($sp_uid)
    {
        // TODO: Implement waresTextAll() method.
        $conn=Connection::conn();
        $dao=new WaresDaoImpl();
        $rows=$dao->waresTextQuery($conn,$sp_uid);
        $conn->close();
        if (count($rows)>0){
            return $rows;
        }else{
            return -1;
        }
    }

    /**
     * @param $sp_uid
     * @return int|mixed
     */
    public static function waresOneAll($sp_uid)
    {
        // TODO: Implement waresOneAll() method.
        $conn=Connection::conn();
        $dao=new WaresDaoImpl();
        $rows=$dao->waresOneQuery($conn,$sp_uid);
        $conn->close();
        if (count($rows)>0){
            return $rows;
        }else{
            return -1;
        }
    }

    /**
     * @param $name
     * @return int|mixed
     * 模糊查找
     */
    public static function waresFuzzySearch($name)
    {
        // TODO: Implement waresFuzzySearch() method.
        $conn=Connection::conn();
        $dao=new WaresDaoImpl();
        $name="%".$name."%";
        $rows=$dao->waresVagueQuery($conn,$name);
        $conn->close();
        if (count($rows)>0){
            return $rows;
        }else{
            return -1;
        }
    }
}