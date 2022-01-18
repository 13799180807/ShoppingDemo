<?php


namespace Application\Controller\Home;

use Application\Helper\FeedBack;
use Application\Helper\Request;
use Application\Service\UserServiceImpl;

class UserController
{
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
        echo FeedBack::fail("参数请求不规范",$data['err']);
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
        echo FeedBack::fail("参数请求不规范",$data['err']);

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