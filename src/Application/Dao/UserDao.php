<?php
require 'UserDaoImpl.php';
interface UserDao{
    /**
     * @param $conn
     * @param $id
     * @return mixed
     * 根据id删除
     */
    public static function deleteById($conn,$id);

    /**
     * @param $conn
     * @param $User
     * @return mixed
     * 添加账号或者注册账号
     */
    public static function insert($conn,$User);

    /**
     * @param $conn
     * @param $id
     * @param $User
     * @return mixed
     * 根据id进行更新用户信息
     */
    public static function updateById($conn,$id,$User);

    /**
     * @param $conn
     * @param $id
     * @return mixed
     * 获取单个用户信息根据id
     */
    public static function getById($conn,$id);

    /**
     * @param $conn
     * @return mixed
     * 获取多个用户信息
     */
    public static function listByid($conn);

}