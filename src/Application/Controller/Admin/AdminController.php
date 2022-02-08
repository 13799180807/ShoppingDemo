<?php


namespace Application\Controller\Admin;


use Application\Helper\FeedBack;
use Application\Helper\Request;
use Application\Middleware\Session;
use Application\Middleware\Token;
use Application\Service\AdminServiceImpl;
use Application\Service\UserServiceImpl;

class AdminController
{

    /** 管理员审核充值 */
    public function actionAuditRecharge()
    {
        /** 接收数据 */
        $account = Request::param("account", "s");
        $token = Request::param("token", "s");
        $scoreId = Request::param("scoreId", "s");
        /**  */


    }

    /** 获取充值记录 */
    public function actionListRecharge()
    {
        $account = Request::param("account", "s");
        $token = Request::param("token", "s");
        $userId = Request::param("userId", "s");
        $page = Request::param("page", "s");
        $num = Request::param("num", "s");

        $detectData = Request::detect(array(
            0 => array('userId', $userId, 'length', 0, 16),
            1 => array('page', $page, 'intSize', 1, 10000),
            2 => array('num', $num, 'intSize', 0, 100),
        ));
        if (!$detectData['status']) {
            /** 类型不符合 */
            echo FeedBack::fail("参数请求不规范", $detectData['err']);
            return;
        }
        /** 检验token */
        $isToken = (new Token())->isState("admin", $account, $token);
        if (!$isToken['status']) {
            echo FeedBack::result(404, $isToken['msg']);
            return;
        }
        $res = (new UserServiceImpl())->listRechargeScore(null, null, $userId, null, $page, $num);
        $callBack = array(
            'totalPages' => $res['totalPages'],
            'rechargeList' => $res['data']
        );
        echo FeedBack::result(200, "获取信息成功", $callBack);

    }


    /** 删除用户 */
    public function actionDelUser()
    {
        /** 接收数据 */
        $account = Request::param("account", "s");
        $token = Request::param("token", "s");
        $userId = Request::param("userId", "s");
        $detectData = Request::detect(array(
            0 => array('userId', $userId, "account"),
        ));
        if (!$detectData['status']) {
            /** 类型不符合 */
            echo FeedBack::fail("删除失败，参数请求不规范", $detectData['err']);
            return;
        }
        /** 检验token */
        $isToken = (new Token())->isState("admin", $account, $token);
        if (!$isToken['status']) {
            echo FeedBack::result(404, $isToken['msg']);
            return;
        }
        (new UserServiceImpl())->moveUser($userId);
        echo FeedBack::result(200, "删除数据成功");
    }

    /** 获取用户信息 */
    public function actionListUser()
    {
        /** 接收数据 */
        $account = Request::param("account", "s");
        $token = Request::param("token", "s");
        $userId = Request::param("userId", "s");
        $name = Request::param("name", "s");
        $page = Request::param("page", "s");
        $num = Request::param("num", "s");

        $detectData = Request::detect(array(
            0 => array('userId', $userId, 'length', 0, 16),
            1 => array('name', $name, 'length', 0, 50),
            2 => array('page', $page, 'intSize', 1, 10000),
            3 => array('num', $num, 'intSize', 0, 100),
        ));
        if (!$detectData['status']) {
            /** 类型不符合 */
            echo FeedBack::fail("参数请求不规范", $detectData['err']);
            return;
        }

        /** 检验token */
        $isToken = (new Token())->isState("admin", $account, $token);
        if (!$isToken['status']) {
            echo FeedBack::result(404, $isToken['msg']);
            return;
        }

        /** 执行查找 */
        $res = (new UserServiceImpl())->listUserInformation($page, $num, $userId, $name);
        $userList = array();

        /** 去除多余的数据 */
        if (count($res['data']['user']) != 0) {
            foreach ($res['data']['user'] as $row) {
                if (array_key_exists("paymentPwd", $row)) {
                    unset($row['paymentPwd']);
                    $userList[] = $row;
                }
            }
        }
        $callBack = array(
            'totalPage' => $res['data']['totalPage'],
            'userList' => $userList
        );

        echo FeedBack::result(200, "获取信息成功", $callBack);
    }

    /**
     * 状态检测
     */
    public function actionState()
    {
        $account = Request::param("account", "s");
        $token = Request::param("token", "s");
        $isState = (new Token())->isState('admin', $account, $token);
        if (!$isState['status']) {
            echo FeedBack::result(404, $isState['msg']);
            return;
        }
        echo FeedBack::result(200, $isState['msg']);
    }

    /** 登录 */
    public function actionLogin()
    {
        /** 请求检查 */
        $account = Request::param("account", "s");
        $pwd = Request::param("pwd", "s");
        /** 检测数据是否符合规范 */
        $data = Request::detect(array(
            0 => array('account', $account, 'length', 6, 16),
            1 => array('pwd', $pwd, 'length', 6, 16),
        ));
        if (!$data['status']) {
            echo FeedBack::fail("登录失败，请求参数错误", $data['err']);
            return;
        }
        /** 登录验证 */
        $isLogin = (new AdminServiceImpl())->login($account, $pwd);
        if (!$isLogin['status']) {
            /** 登录失败 */
            echo FeedBack::result(404, $isLogin['msg'], array());
            return;
        }
        /** 登录成功  */
        $res = (new Session("", "Admin_" . $account))->setToken();
        echo FeedBack::result(200, "登录成功", $res['data']);
    }


}