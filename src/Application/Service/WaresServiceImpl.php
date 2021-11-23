<?php

class WaresServiceImpl implements WaresService{

    /**
     * @param $typea
     * @param $num
     * @param $state
     * @return int|mixed
     */
    public function waresShowAll($typea, $num, $state)
    {
        // TODO: Implement waresShowAll() method.
        $conn=Connection::conn();
        $dao=new WaresDaolmpl();
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
    public function waresImgAll($sp_uid)
    {
        // TODO: Implement waresImgAll() method.
        $conn=Connection::conn();
        $dao=new WaresDaolmpl();
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
    public function waresTextAll($sp_uid)
    {
        // TODO: Implement waresTextAll() method.
        $conn=Connection::conn();
        $dao=new WaresDaolmpl();
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
    public function waresOneAll($sp_uid)
    {
        // TODO: Implement waresOneAll() method.
        $conn=Connection::conn();
        $dao=new WaresDaolmpl();
        $rows=$dao->waresOneQuery($conn,$sp_uid);
        $conn->close();
        if (count($rows)>0){
            return $rows;
        }else{
            return -1;
        }
    }

}