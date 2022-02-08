<?php


namespace Application\Service;


use Application\Dao\AdminDaoImpl;
use Application\Dao\RechargeScoreDaoImpl;
use Application\Dao\UserInformationDaoImpl;

class AdminServiceImpl implements AdminService
{
    /**
     * 管理员登入
     * @param string $adminId
     * @param string $pwd
     * @return array
     */
    public function login(string $adminId, string $pwd): array
    {
        /** 检测账号存在不存在 */
        $isAdminId = (new AdminDaoImpl())->getById($adminId);
        if (count($isAdminId) == 0) {
            return array(
                'status' => false,
                'msg' => "账号不存在",
            );
        }
        /** 检测密码是否正确 */
        if ($isAdminId[0]['admin_pwd'] == encryption($adminId, $pwd)) {
            return array(
                'status' => true,
                'msg' => "密码正确",
            );
        }
        return array(
            'status' => false,
            'msg' => '密码错误'
        );

    }

    /**
     * 审核充值
     * @param int $scoreId
     * @param int $status
     * @return array
     */
    public function auditRecharge(int $scoreId, int $status): array
    {
        /** 获取该订单信息 */
        $scoreData = (new RechargeScoreDaoImpl())->listByField($scoreId);
        if (count($scoreData) == 0) {
            return array(
                'status' => false,
                'msg' => "订单不存在，操作异常",
            );
        }

        if ($scoreData[0]['score_status'] != 2) {
            return array(
                'status' => false,
                'msg' => "已完成对订单的操作",
            );
        }

        /** 检测管理员操作 */
        if ($status == 3) {
            /** 执行拒绝充值 */
            (new RechargeScoreDaoImpl())->updateRechargeScore($scoreId, 3);
            return array(
                'status' => true,
                'msg' => "拒绝充值成功"
            );
        }

        if ($status != 1) {
            return array(
                'status' => false,
                'msg' => "操作异常"
            );
        }

        /** 获取充值账号的信息 */
        $userDara = (new UserInformationDaoImpl())->listUserInformationByField($scoreData[0]['user_id']);
        if (count($userDara) == 0) {
            return array(
                'status' => false,
                'msg' => "充值失败，用户不存在"
            );
        }

        /** 修改充值账户余额 */
        (float)$newScore = $scoreData[0]['score_amount'] + $userDara[0]['user_score'];
        (new UserInformationDaoImpl())->updateUserInformation($scoreData[0]['user_id'], null, null, $newScore);
        /** 修改订单状态 */
        (new RechargeScoreDaoImpl())->updateRechargeScore($scoreId, 1);

        /** 完成订单充值 */
        return array(
            'status' => true,
            'msg' => "充值成功"
        );



    }
}