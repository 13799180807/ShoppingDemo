<?php


namespace Application\Service;


interface AdminService
{
    /**
     * 登入
     * @param string $adminId
     * @param string $pwd
     * @return array
     */
    public function login(string $adminId, string $pwd): array;

    /**
     * 审核充值
     * @param int $scoreId
     * @param int $status
     * @return array
     */
    public function auditRecharge(int $scoreId, int $status): array;

}