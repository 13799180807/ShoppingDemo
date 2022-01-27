<?php


namespace Application\Dao;


use Application\Helper\Filter;
use Application\Library\SqlUtil;

class RechargeScoreDaoImpl implements RechargeScoreDao
{
    protected string $sql = "";
    protected string $fieldsType = "";
    protected array $data = array();

    /**
     * 添加一条数据
     * @param string $userId
     * @param float $score
     * @return int
     */
    public function saveRechargeScore(string $userId, float $score): int
    {
        $data = Filter::preventXss(array($userId, $score));
        return (new SqlUtil())->run("save", "INSERT INTO tb_recharge_score (user_id,score_amount) VALUES (?,?)", "ss", $data);
    }

    /**
     * 修改数据
     * @param int $scoreId
     * @param int|null $scoreStatus
     * @param string|null $scoreDescription
     * @param int|null $dataStatus
     * @return bool
     */
    public function updateRechargeScore(int $scoreId, int $scoreStatus = null, string $scoreDescription = null, int $dataStatus = null): bool
    {
        // TODO: Implement updateRechargeScore() method.
        $sql = "UPDATE tb_recharge_score SET";
        $data = array();
        $fileType = "";

        if ($scoreStatus != null) {
            $sql = $sql . " score_status=?,";
            $data[] = $scoreStatus;
            $fileType = $fileType . "i";
        }

        if ($scoreDescription != null) {
            $sql = $sql . " score_description=?,";
            $data[] = $scoreDescription;
            $fileType = $fileType . "s";
        }

        if ($dataStatus != null) {
            $sql = $sql . " data_status=?,";
            $data[] = $dataStatus;
            $fileType = $fileType . "i";
        }

        $sql = trim($sql, ",");
        $sql = $sql . " WHERE score_id=? ";
        $fileType = $fileType . "i";
        $data[] = $scoreId;
        /** 进行转义 */
        $data = Filter::preventXss($data);
        return (new SqlUtil())->run("update", $sql, "$fileType", $data);
    }

    /**
     * 删除一个用户的充值记录
     * @param string $userId
     * @return bool
     */
    public function removeByUserId(string $userId): bool
    {
        $sql = "DELETE FROM tb_recharge_score WHERE user_id=?";
        $data = Filter::preventXss(array($userId));
        return (new SqlUtil())->run("remove", $sql, "s", $data);
    }

    /**
     * 查询数据
     * @param int|null $scoreId
     * @param int|null $scoreStatus
     * @param string|null $userId
     * @param int|null $dataStatus
     * @param int|null $page
     * @param int|null $num
     * @return array
     */
    public function listByField(int $scoreId = null, int $scoreStatus = null, string $userId = null, int $dataStatus = null, int $page = null, int $num = null): array
    {
        self::combinationSql($scoreId, $scoreStatus, $userId, $dataStatus);
        $data = $this->data;
        $fieldsType = $this->fieldsType;
        /** SQL 拼接 */
        $sql = "SELECT * FROM tb_recharge_score WHERE" . $this->sql;

        /** 去除多余的SQL代码 */
        $sql = trim($sql, "AND");
        $sql = trim($sql, "WHERE");

        if ($page != null) {
            /** 需要分页 */
            $sql = $sql . " ORDER BY created_at LIMIT ?,?";
            $data[] = ($page - 1) * $num;
            $data[] = $num;
            $fieldsType = $fieldsType . "ii";
        }

        if (count($data) == 0) {
            /** 无条件查询 */
            return (new SqlUtil())->run("queryAll", $sql);
        }
        return (new SqlUtil())->run("query", $sql, $fieldsType, $data);

    }

    /**
     * 组装sql
     * @param int|null $scoreId
     * @param int|null $scoreStatus
     * @param string|null $userId
     * @param int|null $dataStatus
     */
    protected function combinationSql(int $scoreId = null, int $scoreStatus = null, string $userId = null, int $dataStatus = null)
    {
        $sql = $this->sql;
        $fieldsType = $this->fieldsType;
        $data = $this->data;

        /** SQL 组装 */
        if ($scoreId != null) {
            $sql = $sql . "  score_id=? AND";
            $fieldsType = $fieldsType . "i";
            $data[] = $scoreId;
        }
        if ($scoreStatus != null) {
            $sql = $sql . "  score_status=? AND";
            $fieldsType = $fieldsType . "i";
            $data[] = $scoreStatus;
        }
        if ($userId != null) {
            $sql = $sql . "  user_id=? AND";
            $fieldsType = $fieldsType . "s";
            $data[] = $userId;
        }
        if ($dataStatus != null) {
            $sql = $sql . "  data_status=? AND";
            $fieldsType = $fieldsType . "i";
            $data[] = $dataStatus;
        }

        $this->sql = $sql;
        $this->data = $data;
        $this->fieldsType = $fieldsType;
    }

    /**
     * 根据条件统计数量
     * @param int|null $scoreId
     * @param int|null $scoreStatus
     * @param string|null $userId
     * @param int|null $dataStatus
     * @return int
     */
    public function countByField(int $scoreId = null, int $scoreStatus = null, string $userId = null, int $dataStatus = null): int
    {
        self::combinationSql($scoreId, $scoreStatus, $userId, $dataStatus);
        $data = $this->data;

        /** SQL 拼接 */
        $sql = "SELECT * FROM tb_recharge_score WHERE" . $this->sql;
        /** 去除多余的SQL代码 */
        $sql = trim($sql, "AND");

        if (count($data) == 0) {
            /** 无条件查询 */
            $sql = trim($sql, "WHERE");
            return (new SqlUtil())->run("countAll", $sql);
        }
        /** 有条件查询 */
        return (new SqlUtil())->run("count", $sql, $this->fieldsType, $data);
    }
}