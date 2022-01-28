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

    /**
     * 用户修改用户名
     * @param string $userId
     * @param string|null $userName
     * @param int|null $userPhone
     * @return array
     */
    public function updateInformation(string $userId, string $userName = null, int $userPhone = null): array;

    /**
     * 用户修改密码
     * @param string $userId
     * @param string $userPwd
     * @param string $newPwd
     * @return array
     */
    public function updatePwd(string $userId, string $userPwd, string $newPwd): array;
    //  还没使用上去

    /**
     * 删除用户
     * @param string $userId
     * @return array
     */
    public function moveUser(string $userId): array;

    /**
     * 用户充值
     * @param string $userId
     * @param float $score
     * @return array
     */
    public function saveRechargeScore(string $userId, float $score): array;

    /**
     * 获取充值记录信息
     * @param int|null $scoreId
     * @param int|null $scoreStatus
     * @param string|null $userId
     * @param int|null $dataStatus
     * @param int|null $page
     * @param int|null $num
     * @return array
     */
    public function listRechargeScore(int $scoreId = null, int $scoreStatus = null, string $userId = null, int $dataStatus = null, int $page = null, int $num = null): array;


}