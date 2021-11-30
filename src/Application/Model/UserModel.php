<?php


class UserModel
{

    public static function addUser($User){
        $i=0;
        foreach ($User as $row){
            $c=array();
            $c["user"]=$row[0];
            $c["password"]=md5($row[1]);
            $dataList[$i]=$c;
            $i++;
        }
        return $dataList;
    }
}