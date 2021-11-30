<?php


class UserServiceImpl implements UserService
{

    /**
     * @param $User
     * @return array
     * 数组返回结果
     */
    public static function addUser($User)
    {
        $res=array();
        $conn=Connection::conn();
        $i=0;
        $sStr="";
        $fStr="";
        foreach ($User as $row){
            $i=$i+1;
           if(QueryBuilder::innserQuery($conn,"shop_user","user=?","s",$row['user'])==1 && $row['user']!="" && $row['password']!=""){
               UserDaoImpl::insert($conn,$row);
               $sStr=$sStr."[{$row['user']}]";
           }else{
               $fStr=$fStr."[{$row['user']}]";

           }
        }
        $conn->close();
        $res["success"]=$sStr;
        $res["fail"]=$fStr;
        return $res;
    }
}