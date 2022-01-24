<?php


namespace Application\Dao;

use Application\Helper\Filter;
use Application\Library\SqlUtil;

/**
 * 用户个人资料信息表
 * Class UserInformationDaoImpl
 * @package Application\Dao
 */
class UserInformationDaoImpl implements UserInformationDao
{

    /**
     * 添加数据
     * @param string $userId
     * @param string|null $userName
     * @param int|null $userPhone
     * @param float|null $userScore
     * @param string|null $paymentPwd
     * @return int
     */
    public function saveUserInformation(string $userId, string $userName = null, int $userPhone = null, float $userScore = null, string $paymentPwd = null): int
    {
        /**  sql语句 */
        $sql = "INSERT INTO tb_user_information (user_id,user_name,user_phone,user_score,payment_pwd) VALUES (?,?,?,?,?) ";
        /** 过滤 */
        $resFilter = Filter::setEntities(array(
            "userId" => $userId,
            "userName" => $userName,
            "paymentPwd" => $paymentPwd
        ));
        $paymentPwd=payPwd(1,$paymentPwd);

        /** 执行查询 ，查询结果返回插入的自增id */
        return (new SqlUtil())->run("save", $sql, "ssiss", array(
            $resFilter['userId'], $resFilter['userName'], $userPhone, $userScore, $paymentPwd));
    }

    /**
     * 根据不同字段进行查询
     * @param string|null $userId
     * @param string|null $userName
     * @param string|null $ordinationField
     * @param int|null $pagination
     * @param int|null $num
     * @return array
     */
    public function listUserInformationByField(string $userId = null, string $userName = null, string $ordinationField = null, int $pagination = null, int $num = null): array
    {
        $sql = "SELECT * FROM tb_user_information WHERE";
        $fieldsType = "";
        $data = array();
        /** 组装查询条件 */
        if ($userId != null) {
            $sql = $sql . " user_id=? AND";
            $data[] = $userId;
            $fieldsType = $fieldsType . "s";
        }

        if ($userName != null) {
            $sql = $sql . " user_name=? AND";
            $data[] = $userName;
            $fieldsType = $fieldsType . "s";
        }

        /** 去除多余的 WHERE 和 AND */
        $sql = trim($sql, "AND");
        $sql = trim($sql, "WHERE");

        /** 查看是否需要排序 */
        if ($ordinationField != null) {
            $sql = $sql . " order by " . $ordinationField . " desc";
        }

        /** 检查是否需要分页 */
        if ($pagination != null) {
            $start = ($pagination - 1) * $num;
            $sql = $sql . " LIMIT {$start},{$num} ";
        }
        if (count($data) == 0) {
            return (new SqlUtil())->run("queryAll", $sql, $fieldsType, $data);
        }
        return (new SqlUtil())->run("query", $sql, $fieldsType, $data);
    }

    /**
     * 组装sql
     */
    private function combinationSql()
    {

    }
}