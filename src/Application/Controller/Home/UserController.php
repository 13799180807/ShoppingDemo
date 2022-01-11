<?php


namespace Application\Controller\Home;


use Application\Helper\DetectRequest;
use Application\Helper\FeedBack;
use Application\Service\UserServiceImpl;

class UserController
{
    /** 登入 */
    public function actionLogin()
    {
        /** 请求检查 */
        $param = DetectRequest::detectRequest(array('account' => "account", 'pwd' => 'pwd'));
        if ($param[0]) {
            /** 得到请求的数据 */
            $requestData = $param[1];
            /** 检测数据是否符合规范 */
            $detect = array(
                0 => array('account', $requestData['account'], 'str', 6, 16),
                1 => array('pwd', $requestData['pwd'], 'str', 6, 16),
            );
            $resDetect = DetectRequest::detectRun($detect);

            if (count($resDetect) == 0) {
                /** 进行账号密码验证 */
                $data = (new UserServiceImpl())->login($requestData['account'], $requestData['pwd']);
                if ($data['status']) {
                    /** 账号验证成功 */
                    $res = (new \Application\Middleware\Session("", $requestData['account']))->setToken();
                    echo FeedBack::result('200', "登入成功", $res['data']);
                    return;

                } else {
                    /** 登入失败 */
                    echo FeedBack::result('404', $data['msg'], array());
                    return;
                }
            }
            echo FeedBack::result('404', '请求的参数不规范，请联系管理员。', $resDetect);
            return;

        }
        echo FeedBack::fail($param[1]);
    }

    /**
     * 注册
     */
    public function actionRegister()
    {
        $param = DetectRequest::detectRequest(array('account' => "account", 'pwd' => 'pwd'));
        if ($param[0]) {
            $requestData = $param[1];
            /** 检测数据是否符合规范 */
            $detect = array(
                0 => array('account', $requestData['account'], 'str', 6, 16),
                1 => array('pwd', $requestData['pwd'], 'str', 6, 16),
            );
            $resDetect = DetectRequest::detectRun($detect);

            if (count($resDetect) == 0) {
                $res = (new UserServiceImpl())->saveUser($requestData['account'], $requestData['pwd']);
                if ($res['status']) {
                    echo FeedBack::result('200', $res['msg']);
                    return;
                }
                echo FeedBack::result('404', $res['msg']);
                return;
            }
            echo FeedBack::result('404', '请求的参数不规范，请联系管理员。', $resDetect);
            return;

        }
        echo FeedBack::fail("请求失败");

    }

    /** 测试一下状态 */
    public function actionState()
    {
        $param = DetectRequest::detectRequest(array('token' => "token"));
        if ($param[0]) {
            /** 得到请求的数据 */
            $requestData = $param[1];
            $res = (new \Application\Middleware\Session($requestData['token']))->getToken();
            if ($res['status']) {
                echo FeedBack::result('200', $res['msg']);
                return;
            }
            echo FeedBack::result('404', $res['msg']);
            return;


        }
        echo FeedBack::result('404', '当前还没有登入', array());

    }


}