<?php


namespace Application\Controller\Home;

use Application\Helper\FeedBack;
use Application\Helper\Request;
use Application\Middleware\Session;
use Application\Service\UserServiceImpl;

class UserController
{


    /** 用户充值分 */
    public function actionSaveScore()
    {
        $token = Request::param("token", "s");
        $account = Request::param("account", "s");
        $score = Request::param("score", "i");

        $data = Request::detect(array(
            0 => array("account", $account, 'account'),
            1 => array("score", $score, 'intSize', 10, 1000)
        ));
        if (!$data['status']) {
            /** 数据不符合 */
            echo FeedBack::fail("充值失败，当次充值请在10-1000", $data['err']);
            return;
        }
        $tokenRes = (new Session($token))->getToken();
        if (!$tokenRes['status']) {
            /** token失效 */
            echo FeedBack::result(404, $tokenRes['msg']);
            return;
        }
        if ($tokenRes['data']['account'] != $account) {
            echo FeedBack::result(404, "非法token");
            return;
        }
        /** 执行充值 */
        $res = (new UserServiceImpl())->saveRechargeScore($account, (float)$score);
        if (!$res['status']) {
            echo FeedBack::result(404, $res['msg']);
            return;
        }
        echo FeedBack::result(200, "充值成功，请耐心等待到账时间");

    }

    /** 用户修改密码 */
    public function actionUpdPwd()
    {
        /** 接收数据  */
        $token = Request::param("token", "s");
        $account = Request::param("account", "s");
        $pwd = Request::param("pwd", "s");
        $newPwd = Request::param("newPwd", "i");
        /** 数据检验 */
        $data = Request::detect(array(
            0 => array("account", $account, 'account'),
            1 => array("pwd", $pwd, 'length', 6, 16),
            2 => array("newPwd", $newPwd, 'length', 6, 16)
        ));
        /** 数据判断 */
        if (!$data['status']) {
            /** 数据不符合 */
            echo FeedBack::fail("修改密码失败，参数错误", $data['err']);
            return;
        }
        /** token检查 */
        $tokenRes = (new Session($token))->getToken();
        if (!$tokenRes['status']) {
            /** token失效 */
            echo FeedBack::result(404, $tokenRes['msg']);
            return;
        }
        if ($tokenRes['data']['account'] != $account) {
            echo FeedBack::result(404, "非法token");
            return;
        }
        /** 执行修改密码 */
        $res = (new UserServiceImpl())->updatePwd($account, $pwd, $newPwd);
        if (!$res['status']) {
            echo FeedBack::result(404, $res['msg']);
            return;
        }
        /** 修改成功，修改token值，让用户重新登入 */
        (new Session("", $account))->updateTokenLife();
        /** 返回成功值 */
        echo FeedBack::result(200, "修改密码成功，请重新登入");
    }

    /** 用户更新个人信息表 */
    public function actionUpdInformation()
    {
        /** 获取数据 */
        $token = Request::param("token", "s");
        $userId = Request::param("account", "s");
        $userName = Request::param("name", "s");
        $userPhone = Request::param("phone", "i");

        /** 验证前端消息 */
        $data = Request::detect(array(
            0 => array("account", $userId, 'account'),
            1 => array("name", $userName, 'length', 1, 16),
            2 => array("phone", $userPhone, 'phone'),
        ));
        if (!$data['status']) {
            /** 数据不符合 */
            echo FeedBack::fail("参数请求不规范", $data['err']);
            return;
        }

        /** 验证状态 */
        $tokenRes = (new Session($token))->getToken();
        if (!$tokenRes['status']) {
            /** token失效 */
            echo FeedBack::result(404, $tokenRes['msg']);
            return;
        }

        /** 验证token和操作账号是否相同 */
        if ($tokenRes['data']['account'] != $userId) {
            echo FeedBack::result(404, "非法token");
            return;
        }
        /** 执行操作 */
        $res = (new UserServiceImpl())->updateInformation($userId, $userName, $userPhone);
        if (!$res['status']) {
            echo FeedBack::result(404, $res['msg']);
            return;
        }
        echo FeedBack::result(200, "修改信息成功");

    }

    /** 获取个人信息 */
    public function actionGetInformation()
    {
        $token = Request::param("token", "s");
        $userId = Request::param("account", "s");

        /** 验证前端消息 */
        $data = Request::detect(array(
            0 => array("account", $userId, 'account'),
        ));
        if (!$data['status']) {
            /** 数据不符合 */
            echo FeedBack::fail("获取失败，请求参数有问题", $data['err']);
            return;
        }

        /** 验证token  */
        $tokenRes = (new Session($token))->getToken();
        if (!$tokenRes['status']) {
            /** token失效 */
            echo FeedBack::result(404, $tokenRes['msg']);
            return;
        }

        /** 验证token是不是对应本账号的 */
        if ($tokenRes['data']['account'] != $userId) {
            echo FeedBack::result(404, "非法token");
            return;
        }

        /** 开始查询数据 */
        $res = (new UserServiceImpl())->getUserData($userId);
        if (!$res['status']) {
            echo FeedBack::result(404, $res['msg']);
            return;
        }

        /** 去掉不要的数据 在传给前端 */
        $res = $res['data'];
        /** 获得注册时间 */
        $regTime = $res['user'][0]['createdAt'];
        /** 去掉支付密码 */
        $information = $res['information'];
        $userInFo = array();
        foreach ($information as $row) {
            /** 去掉密码 */
            if (array_key_exists("paymentPwd", $row)) {
                unset($row['paymentPwd']);
                $userInFo[] = $row;
            }
        }
        /** 返回数据 */
        $callBack = array(
            'regTime' => $regTime,
            'information' => $userInFo
        );
        echo FeedBack::result(200, "获取信息成功", $callBack);

    }

    /** 添加个人信息 */
    public function actionAddInformation()
    {
        /** 接收前端的数据 */
        $token = Request::param("token", "s");
        $request = Request::only(
            array("account", "userName", "userPhone", "payPwd"),
            array("s", "s", "i", "s")
        );

        /** 验证前端消息 */
        $data = Request::detect(array(
            0 => array("account", $request['account'], 'account'),
            1 => array("userName", $request['userName'], 'length', 1, 16),
            2 => array("userPhone", $request['userPhone'], 'phone'),
            3 => array("payPwd", $request['payPwd'], 'pwd'),
        ));
        if (!$data['status']) {
            /** 数据不符合 */
            echo FeedBack::fail("添加个人信息失败，请求参数不规范", $data['err']);
            return;
        }

        /** 验证 token */
        $res = (new Session($token))->getToken();
        if (!$res['status']) {
            /** token失效 */
            echo FeedBack::result(404, $res['msg']);
            return;
        }

        if ($res['data']['account'] != $request['account']) {
            echo FeedBack::result(404, "非法token");
            return;
        }

        /** 数据符合 */
        $saveRes = (new UserServiceImpl())->saveUserInformation($request['account'], $request['userName'], $request['userPhone'], $request['payPwd']);

        if (!$saveRes['status']) {
            echo FeedBack::result(404, $saveRes['msg']);
            return;
        }
        echo FeedBack::result(200, "个人信息添加成功");

    }

    /** 登入 */
    public function actionLogin()
    {
        /** 请求检查 */
        $goodsName = Request::param("account", "s");
        $goodsCategoryId = Request::param("pwd", "s");

        /** 检测数据是否符合规范 */
        $data = Request::detect(array(
            0 => array('account', $goodsName, 'length', 6, 16),
            1 => array('pwd', $goodsCategoryId, 'length', 6, 16),
        ));
        if (!$data['status']) {
            echo FeedBack::fail("参数请求不规范", $data['err']);
            return;
        }

        /** 进行账号密码验证 */
        $loginRes = (new UserServiceImpl())->login($goodsName, $goodsCategoryId);
        if (!$loginRes['status']) {
            /** 登入失败 */
            echo FeedBack::result(404, $loginRes['msg'], array());
            return;
        }

        /** 账号验证成功 */
        $res = (new Session("", $goodsName))->setToken();
        echo FeedBack::result(200, "登入成功", $res['data']);
    }

    /** 注册 */
    public function actionRegister()
    {
        /** 获取前端请求数据 */
        $goodsCategoryId = Request::param("pwd", "s");
        $goodsName = Request::param("account", "s");

        /** 数据检验 */
        $data = Request::detect(array(
            0 => array('account', $goodsName, 'length', 6, 16),
            1 => array('pwd', $goodsCategoryId, 'length', 6, 16),
        ));
        /** 判断数据 */
        if (!$data['status']) {
            echo FeedBack::fail("参数请求不规范", $data['err']);
            return;
        }

        $res = (new UserServiceImpl())->saveUser($goodsName, $goodsCategoryId);
        if (!$res['status']) {
            echo FeedBack::result(404, $res['msg']);
            return;
        }
        echo FeedBack::result(200, $res['msg']);

    }

    /** 测试一下状态 */
    public function actionState()
    {
        $token = Request::param("token", "s");
        $res = (new Session($token))->getToken();

        if (!$res['status']) {
            echo FeedBack::result(404, $res['msg']);
            return;
        }
        echo FeedBack::result(200, $res['msg']);

    }


}