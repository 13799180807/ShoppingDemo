<?php
require 'UserServiceImpl.php';
interface UserService{
    /**
     * @param $User
     * @return mixed
     * 添加用户
     */
    public static function addUser($User);

}