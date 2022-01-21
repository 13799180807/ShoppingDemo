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

    /**
     * 添加用户信息
     * @param string $userId
     * @param string|null $userName
     * @param int|null $userPhone
     * @param string|null $paymentPwd
     * @return array
     */
    public function saveUserInformation(string $userId, string $userName = null, int $userPhone = null, string $paymentPwd = null): array;

    /**
     * 获取用户信息信息
     * @param string $userId
     * @return array
     */
    public function getUserData(string $userId): array;


}