<?php

namespace Application\Middleware;
class Token
{

    /**
     * 检测登录状态
     * @param string $type
     * @param string $account
     * @param string $token
     * @return array
     */
    public function isState(string $type, string $account, string $token): array
    {
        $isRes = (new Session($token))->getToken();
        if (!$isRes['status']) {
            return array(
                'status' => false,
                'msg' => $isRes['msg']
            );
        }

        if ($type == "admin") {
            $account = "Admin_" . $account;
        }

        /** 检验token是否合法 */
        if ($isRes['data']['account'] != $account) {
            return array(
                'status' => false,
                'msg' => "非法获取token，验证失败"
            );
        }
        return array(
            'status' => true,
            'msg' => "验证成功"
        );


    }
}