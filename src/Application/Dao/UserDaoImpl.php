<?php

class UserDaoImpl implements UserDao
{

    public static function deleteById($conn, $id)
    {
        // TODO: Implement deleteById() method.
    }


    /**
     * @param $conn
     * @param $User
     * @return mixed
     * 添加账号
     * 数组形式进入
     */
    public static function insert($conn, $User)
    {
        $sql="INSERT INTO shop_user(user,password) value (?,?)";
        $stmt=$conn->stmt_init();
        $stmt->prepare($sql);
        $stmt->bind_param("ss",$User['user'],$User['password']);
        $result=$stmt->execute();
        $stmt->close();
        return $result;
    }

    public static function updateById($conn, $id, $User)
    {
        // TODO: Implement updateById() method.
    }

    public static function getById($conn, $id)
    {
        // TODO: Implement getById() method.
    }

    public static function listByid($conn)
    {
        // TODO: Implement listByid() method.
    }
}
