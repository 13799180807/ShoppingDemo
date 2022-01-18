<?php


namespace Application\Service;


interface UserService
{
    /**
     * 注册账号
     * @param string $userId
     * @param string $userPwd
     * @return array
     */
    public function saveUser(string $userId, string $userPwd): array;

    /**
     * 登入
     * @param string $userId
     * @param string $userPwd
     * @return array
     */
    public function login(string $userId, string $userPwd): array;

}