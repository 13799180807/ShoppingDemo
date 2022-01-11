<?php


namespace Application\Service;


class UserServiceImpl implements UserService
{

    /**
     * 保存一个账号信息
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
     * 登入验证
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
}