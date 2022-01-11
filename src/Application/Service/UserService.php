<?php


namespace Application\Service;


interface UserService
{
    /**
     * 添加一条数据
     * @param string $userId
     * @param string $userPwd
     * @return array
     */
    public function saveUser(string $userId, string $userPwd): array;

    public function login(string $userId, string $userPwd): array;

}