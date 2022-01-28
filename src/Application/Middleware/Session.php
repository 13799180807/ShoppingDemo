<?php


namespace Application\Middleware;


use Application\Library\SqlUtil;

class Session
{
    public string $account;
    public string $token;
    public int $lifetime = 3600; //设置生存时间1小时

    public function __construct($token = "", $account = "")
    {
        $this->account = $account;
        $this->token = $token;
    }

    /**
     * 修改token用的当修改了密码token要失效
     * @return array
     */
    public function updateTokenLife(): array
    {
        (new SqlUtil())->run("update", "UPDATE tb_session SET token=?, lifetime=? WHERE account=? ", "sss", array("0", 0, $this->account));
        return array();
    }

    /**
     * 判断token是否可以用
     * @return array
     */
    public function getToken(): array
    {
        /** 检测该token值有没用 */
        $res = (new SqlUtil())->run("query", "SELECT * FROM tb_session WHERE token=? ", "s", array($this->token));
        if (count($res) == 0) {
            return array(
                'status' => false,
                'msg' => "你还没有进行登入，请登入后再操作。",
                'data' => array()
            );
        }

        /** 进行token时间判断 */
        if ($res[0]['lifetime'] <= time()) {
            return array(
                'status' => false,
                'msg' => "登入信息已经过期，请重新登入",
                'data' => array()
            );
        }

        /** 没有过期  延长token时间 */
        (new SqlUtil())->run("update", "UPDATE tb_session SET lifetime=? WHERE  token=?", "ss", array(time() + $this->lifetime, $this->token));

        return array(
            'status' => true,
            'msg' => "验证成功",
            'data' => array(
                'account' => $res[0]['account']
            )
        );

    }

    public function setToken(): array
    {
        /** 生成唯一的值 */
        self::uuid();
        /** 检测账号是否是第一次登入 */
        if (count((new SqlUtil())->run("query", "SELECT * FROM tb_session WHERE account=? ", "s", array($this->account))) == 0) {
            /** 插入操作 该账号进行第一次登入 */
            (new SqlUtil())->run("save", "INSERT INTO tb_session (account, token, lifetime) VALUES (?,?,?)", "sss", array($this->account, $this->token, time() + $this->lifetime));
        } else {
            /** 修改token操作 */
            (new SqlUtil())->run("update", "UPDATE tb_session SET token=?, lifetime=? WHERE account=? ", "sss", array($this->token, time() + $this->lifetime, $this->account));
        }

        /** 返回值 */
        return array(
            'status' => true,
            'msg' => "获得token成功",
            'data' => array(
                'account' => $this->account,
                'token' => $this->token
            )
        );

    }

    /** 生成唯一的标识符做token值 */
    protected function uuid()
    {
        $chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        $rand_str = null;
        for ($i = 0; $i < 16; $i++) {
            $rand_str .= $chars[mt_rand(0, 61)];
        }
        $this->token = MD5(time() . $rand_str);

    }


}