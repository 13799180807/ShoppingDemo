<?php


namespace Application\Controller\Home;

use Application\Helper\FeedBack;
use Application\Helper\Request;
use Application\Service\UserServiceImpl;

class UserController
{
    /** 获取个人信息 */
    public function actionGetInformation()
    {
        $token = Request::param("token", "s");
        $userId = Request::param("account", "s");
        /** 验证前端消息 */
        $data = Request::detect(array(
            0 => array("account", $userId, 'account'),
        ));
        if ($data['status']) {

            /** 验证token  */
            $tokenRes = (new \Application\Middleware\Session($token))->getToken();
            if ($tokenRes['status']) {

                /** 验真token是不是对应本账号的 */
                if ($tokenRes['data']['account'] == $userId) {

                    /** 开始查询数据 */
                    $res = (new UserServiceImpl())->getUserData($userId);

                    /** 判断数据 进行挑选不要的去除 */
                    if ($res['status']) {

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
                        return;

                    }
                    echo FeedBack::result(404, $res['msg']);
                    return;

                }
                echo FeedBack::result(404, "非法token");
                return;

            }
            /** token失效 */
            echo FeedBack::result(404, $tokenRes['msg']);
            return;
        }
        /** 数据不符合 */
        echo FeedBack::fail("参数请求不规范", $data['err']);

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
        if ($data['status']) {

            /** 验证 token */
            $res = (new \Application\Middleware\Session($token))->getToken();
            if ($res['status']) {

                if ($res['data']['account'] == $request['account']) {
                    /** 数据符合 */
                    $saveRes = (new UserServiceImpl())->saveUserInformation($request['account'], $request['userName'], $request['userPhone'], $request['payPwd']);
                    if ($saveRes['status']) {
                        echo FeedBack::result(200, "个人信息添加成功");
                        return;
                    }
                    echo FeedBack::result(404, $saveRes['msg']);
                    return;

                }
                echo FeedBack::result(404, "非法token");
                return;

            }
            /** token失效 */
            echo FeedBack::result(404, $res['msg']);
            return;
        }
        /** 数据不符合 */
        echo FeedBack::fail("参数请求不规范", $data['err']);
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
        if ($data['status']) {
            /** 进行账号密码验证 */
            $loginRes = (new UserServiceImpl())->login($goodsName, $goodsCategoryId);
            if ($loginRes['status']) {
                /** 账号验证成功 */
                $res = (new \Application\Middleware\Session("", $goodsName))->setToken();
                echo FeedBack::result(200, "登入成功", $res['data']);
                return;

            } else {
                /** 登入失败 */
                echo FeedBack::result(404, $loginRes['msg'], array());
                return;
            }
        }
        echo FeedBack::fail("参数请求不规范", $data['err']);
    }

    /**
     * 注册
     */
    public function actionRegister()
    {
        $goodsName = Request::param("account", "s");
        $goodsCategoryId = Request::param("pwd", "s");

        $data = Request::detect(array(
            0 => array('account', $goodsName, 'length', 6, 16),
            1 => array('pwd', $goodsCategoryId, 'length', 6, 16),
        ));

        if ($data['status']) {
            $res = (new UserServiceImpl())->saveUser($goodsName, $goodsCategoryId);
            if ($res['status']) {
                echo FeedBack::result(200, $res['msg']);
                return;
            }
            echo FeedBack::result(404, $res['msg']);
            return;
        }
        echo FeedBack::fail("参数请求不规范", $data['err']);

    }

    /** 测试一下状态 */
    public function actionState()
    {
        $token = Request::param("token", "s");
        $res = (new \Application\Middleware\Session($token))->getToken();
        if ($res['status']) {
            echo FeedBack::result(200, $res['msg']);
            return;
        }
        echo FeedBack::result(404, $res['msg']);

    }


}