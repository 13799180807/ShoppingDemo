<?php


class GoodsServiceImpl implements GoodsService
{

    /**
     * @param $id
     * @return mixed|void
     * 获取一条信息
     * 没有结果返回-1，有结果就返回结果
     */
    public static function getById($id)
    {
        // TODO: Implement getById() method.
        $conn=Connection::conn();
        $res=GoodsDaoImpl::getById($conn,$id);
        $conn->close();
        if(count($res)>0){
            return $res;
        }else{
            return -1;
        }

    }

    /**
     * @param $field
     * @param $value
     * @param $status
     * @param $num
     * @return mixed|void
     */
    public static function listByfield($field, $value, $status, $num)
    {
        // TODO: Implement listByfield() method.
        $conn=Connection::conn();
        $res=GoodsDaoImpl::listByfield($conn,$field,$value,$status,$num);
        $conn->close();
        if (count($res)>0){
            return $res;
        }else{
            return -1;
        }


    }
}