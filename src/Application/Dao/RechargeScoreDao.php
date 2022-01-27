<?php

namespace Application\Dao;

interface RechargeScoreDao
{
    /**
     * 添加一条数据
     * @param string $userId
     * @param float $score
     * @return int
     */
    public function saveRechargeScore(string $userId, float $score): int;

    /**
     * 更新一条数据
     * @param int $scoreId
     * @param int|null $scoreStatus
     * @param string|null $scoreDescription
     * @param int|null $dataStatus
     * @return bool
     */
    public function updateRechargeScore(int $scoreId, int $scoreStatus = null, string $scoreDescription = null, int $dataStatus = null): bool;

    /**
     * 删除一个用户的充值记录
     * @param string $userId
     * @return bool
     */
    public function removeByUserId(string $userId): bool;

    /**
     * 获取数据
     * @param int|null $scoreId
     * @param int|null $scoreStatus
     * @param string|null $userId
     * @param int|null $dataStatus
     * @param int|null $page
     * @param int|null $num
     * @return array
     */
    public function listByField(int $scoreId = null, int $scoreStatus = null, string $userId = null, int $dataStatus = null, int $page = null, int $num = null): array;

    /**
     * 统计数量
     * @param int|null $scoreId
     * @param int|null $scoreStatus
     * @param string|null $userId
     * @param int|null $dataStatus
     * @return int
     */
    public function countByField(int $scoreId = null, int $scoreStatus = null, string $userId = null, int $dataStatus = null): int;


}