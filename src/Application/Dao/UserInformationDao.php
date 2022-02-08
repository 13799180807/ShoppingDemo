<?php


namespace Application\Dao;


interface UserInformationDao
{
    /**
     * 用户信息表中添加一个数据
     * @param string $userId
     * @param string|null $userName
     * @param int|null $userPhone
     * @param float|null $userScore
     * @param string|null $paymentPwd
     * @return int
     */
    public function saveUserInformation(string $userId, string $userName = null, int $userPhone = null, float $userScore = null, string $paymentPwd = null): int;

    /**
     * 根据名字或者账号进行查询
     * @param string|null $userId
     * @param string|null $userName
     * @param string|null $ordinationField
     * @param int|null $pagination
     * @param int|null $num
     * @return array
     */
    public function listUserInformationByField(string $userId = null, string $userName = null, string $ordinationField = null, int $pagination = null, int $num = null): array;

    /**
     * 统计
     * @param string|null $userId
     * @param string|null $userName
     * @return int
     */
    public function countUserInformationByField(string $userId = null, string $userName = null): int;

    /**
     * 更改用户信息
     * @param string $userId
     * @param string|null $userName
     * @param int|null $userPhone
     * @param float|null $userScore
     * @param string|null $paymentPwd
     * @return bool
     */
    public function updateUserInformation(string $userId, string $userName = null, int $userPhone = null, float $userScore = null, string $paymentPwd = null): bool;

    /**
     * 删除数据
     * @param string $userId
     * @return bool
     */
    public function removeByUserId(string $userId): bool;


}