<?php


namespace Application\Domain;

/**
 * 充值记录表
 * Class RechargeScore
 * @package Application\Domain
 */
class RechargeScore
{
    public int $scoreId;
    public string $scoreStatus;
    public float $scoreAmount;
    public string $userId;
    public string $scoreDescription;
    public string $dataStatus;
    public string $createdAt;
    public string $updatedAt;

    public function RechargeScoreModel(array $rows): array
    {
        $dataList = array();
        $i = 0;
        foreach ($rows as $row) {
            $c = new RechargeScore();
            foreach ($row as $key => $value) {
                $key = underscoreToHump($key);
                $c->$key = htmlentities($value);
            }
            $dataList[$i] = (array)$c;
            $i++;
        }
        return $dataList;
    }

}