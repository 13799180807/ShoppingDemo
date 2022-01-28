<?php


namespace Application\Dao;


interface UserDao
{

    /**
     * 根据id获取一条数据
     * @param string $userId
     * @return array
     */
    public function getById(string $userId): array;

    /**
     * 添加一条数据
     * @param string $userId
     * @param string $userPwd
     * @return int
     */
    public function saveUser(string $userId, string $userPwd): int;

    /**
     * 根据userId删除一条数据
     * @param string $userId
     * @return bool
     */
    public function moveByUserId(string $userId): bool;

    /**
     * 修改密码
     * @param string $userId
     * @param string $userPwd
     * @return bool
     */
    public function updateByUserId(string $userId, string $userPwd): bool;


}