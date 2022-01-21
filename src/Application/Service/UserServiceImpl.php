<?php


namespace Application\Service;


use Application\Dao\UserDaoImpl;
use Application\Dao\UserInformationDaoImpl;
use Application\Domain\User;
use Application\Domain\UserInformation;

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

    public function getUserData(string $userId): array
    {
        // TODO: Implement listUserData() method.
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
}