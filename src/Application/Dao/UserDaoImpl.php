<?php


namespace Application\Dao;


use Application\Helper\Filter;
use Application\Library\SqlUtil;

class UserDaoImpl implements UserDao
{

    /**
     * 根据id获取一条记录
     * @param string $userId
     * @return array
     */
    public function getById(string $userId): array
    {
        return (new SqlUtil())->run("query","SELECT * FROM tb_user WHERE user_id=?","s",array($userId));

    }

    /**
     * 添加一条记录
     * @param string $userId
     * @param string $userPwd
     * @return int
     */
    public function saveUser(string $userId, string $userPwd): int
    {
        $userPwd=encryption($userId,$userPwd);

        $resValue = Filter::setEntities(array(
                "userId" => $userId,
                "userPwd" => $userPwd
            )
        );

        $sql = "INSERT INTO tb_user (user_id, user_pwd) VALUES (?,?)";

        return (new SqlUtil())->run("save", $sql, "ss", array(
            $resValue['userId'], $resValue['userPwd']
        ));
    }
}