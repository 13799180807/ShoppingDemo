<?php


namespace Application\Service;


use Application\Dao\RechargeScoreDaoImpl;
use Application\Dao\UserDaoImpl;
use Application\Dao\UserInformationDaoImpl;
use Application\Domain\RechargeScore;
use Application\Domain\User;
use Application\Domain\UserInformation;
use Application\Exception\Log;

class UserServiceImpl implements UserService
{

    /**
     * 注册账号
     * @param string $userId
     * @param string $userPwd
     * @return array
     */
    public function saveUser(string $userId, string $userPwd): array
    {
        if (count((new \Application\Dao\UserDaoImpl())->getById($userId)) != 0) {
            return array(
                'status' => false,
                'msg' => "账号已经存在，请更换注册账号",
            );
        }

        (new \Application\Dao\UserDaoImpl())->saveUser($userId, $userPwd);
        return array(
            'status' => true,
            'msg' => "注册成功"
        );


    }

    /**
     * 登入检验
     * @param string $userId
     * @param string $userPwd
     * @return array
     */
    public function login(string $userId, string $userPwd): array
    {
        /** 查询账号存在不存在 */
        $res = (new \Application\Dao\UserDaoImpl())->getById($userId);

        if (count($res) == 0) {
            return array(
                'status' => false,
                'msg' => "账号不存在",
            );
        }

        /** 进行判断是否正确 */
        if ($res[0]['user_pwd'] == encryption($userId, $userPwd)) {
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
     * 添加用户信息
     * @param string $userId
     * @param string|null $userName
     * @param int|null $userPhone
     * @param string|null $paymentPwd
     * @return array
     */
    public function saveUserInformation(string $userId, string $userName = null, int $userPhone = null, string $paymentPwd = null): array
    {
        /** 检测该用户信息存在不存在 存在不添加 不存在则添加 */
        if (count((new UserInformationDaoImpl())->listUserInformationByField($userId)) != 0) {
            /** 用户信息存在 */
            return array(
                'status' => false,
                'msg' => "该用户信息已经存在"
            );
        }
        /** 进行添加 */
        $res = (new UserInformationDaoImpl())->saveUserInformation($userId, $userName, $userPhone, 0, $paymentPwd);
        /** 判断是否添加成功 */
        if ($res == 0) {
            return array(
                'status' => false,
                'msg' => "出错啦，添加失败请联系管理员"
            );
        }
        return array(
            'status' => true,
            'msg' => "添加成功"
        );
    }

    /**
     * 获取账号数据
     * @param string $userId
     * @return array
     */
    public function getUserData(string $userId): array
    {
        /** 获取该账号的账号信息 */
        $userRes = (new UserDaoImpl())->getById($userId);
        if (count($userRes) == 0) {
            return array(
                'status' => false,
                'msg' => "账号不存在，获取失败"
            );
        }
        $userRes = (new User())->userModel($userRes);

        /** 获取该账号的用户信息 */
        $informationRes = (new UserInformationDaoImpl())->listUserInformationByField($userId);
        $informationRes = (new UserInformation())->userModel($informationRes);

        /** 获取该账号的收获地址 */

        /** 获取账号的订单信息 */

        /** 返回 */
        $callBack = array(
            'user' => $userRes,
            'information' => $informationRes,
        );
        return array(
            'status' => true,
            'msg' => "获取信息成功",
            'data' => $callBack
        );
    }

    /**
     * 修改用户信息
     * @param string $userId
     * @param string|null $userName
     * @param int|null $userPhone
     * @return array
     */
    public function updateInformation(string $userId, string $userName = null, int $userPhone = null): array
    {
        /** 检查该用户存在不存在 */
        $isUser = (new UserDaoImpl())->getById($userId);
        $isInformation = (new UserInformationDaoImpl())->listUserInformationByField($userId);
        if (count($isUser) == 0 || count($isInformation) == 0) {
            return array(
                'status' => false,
                'msg' => "该账户不存在，修改失败"
            );
        }
        /** 进行修改 */
        $updRes = (new UserInformationDaoImpl())->updateUserInformation($userId, $userName, $userPhone);
        if ($updRes) {
            return array(
                'status' => true,
                'msg' => "账号信息修改成功"
            );
        }
        return array(
            'status' => false,
            'msg' => "出现异常，请联系管理员"
        );

    }

    /**
     * 删除用户
     * @param string $userId
     * @return array
     */
    public function moveUser(string $userId): array
    {
        (new UserDaoImpl())->moveByUserId($userId);
        (new UserInformationDaoImpl())->removeByUserId($userId);
        (new RechargeScoreDaoImpl())->removeByUserId("$userId");
        return array(
            'status' => true,
            'msg' => "删除数据成功"
        );

    }

    /**
     * 用户充值操作
     * @param string $userId
     * @param float $score
     * @return array
     */
    public function saveRechargeScore(string $userId, float $score): array
    {
        /** 检查该用户存在不存在 */
        $isUser = (new UserDaoImpl())->getById($userId);
        if (count($isUser) == 0) {
            return array(
                'status' => false,
                'msg' => "用户不存在，充值失败"
            );
        }
        /** 存在执行充值申请 */
        $res = (new RechargeScoreDaoImpl())->saveRechargeScore($userId, (float)$score);
        if ($res > 0) {
            return array(
                'status' => true,
                'msg' => "申请充值成功，正在充值中"
            );
        }

        $msg = "用户账号:{$userId}， 充值{$score}积分,充值失败。结果为{$res}";
        (new Log())->run($msg);

        return array(
            'status' => false,
            'msg' => "出现异常，请联系管理员"

        );
    }

    /**
     * 获取用户充值数据
     * @param int|null $scoreId
     * @param int|null $scoreStatus
     * @param string|null $userId
     * @param int|null $dataStatus
     * @param int|null $page
     * @param int|null $num
     * @return array
     */
    public function listRechargeScore(int $scoreId = null, int $scoreStatus = null, string $userId = null, int $dataStatus = null, int $page = null, int $num = null): array
    {
        /** 统计一下  一共有多少页面 */
        $countRes = (new RechargeScoreDaoImpl())->countByField($scoreId, $scoreStatus, $userId, $dataStatus);
        $totalPages = ceil($countRes / $num);
        /** 执行数据查询 */
        $dataRes = (new RechargeScoreDaoImpl())->listByField($scoreId, $scoreStatus, $userId, $dataStatus, $page, $num);
        /** 返回结果 */
        return array(
            'status' => "获取数据成功",
            'totalPages' => $totalPages,
            'data' => (new RechargeScore())->RechargeScoreModel($dataRes)
        );
    }

    /**
     * 用户修改密码
     * @param string $userId
     * @param string $userPwd
     * @param string $newPwd
     * @return array
     */
    public function updatePwd(string $userId, string $userPwd, string $newPwd): array
    {
        /** 检查该用户存在不存在 */
        $isUser = (new UserDaoImpl())->getById($userId);
        if (count($isUser) == 0) {
            $msg = "试图修改：{$userId} 账号密码，该账号不存在，出现安全隐患了；";
            (new Log())->run($msg);
            return array(
                'status' => false,
                'msg' => "用户不存在，修改密码失败"
            );
        }

        /** 验证原密码 */
        if ($isUser[0]['user_pwd'] != encryption($userId, $userPwd)) {
            return array(
                'status' => false,
                'msg' => "修改密码失败，原密码出错",
            );
        }
        /** 修改密码 */
        (new UserDaoImpl())->updateByUserId($userId, $newPwd);
        return array(
            'status' => true,
            'msg' => "密码修改成功",
        );
    }
}