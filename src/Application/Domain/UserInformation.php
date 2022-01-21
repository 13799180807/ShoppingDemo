<?php


namespace Application\Domain;


class UserInformation
{
    public string $id;
    public string $userId;
    public string $userName;
    public int $userPhone;
    public float $userScore;
    public string $paymentPwd;

    public function userModel(array $rows): array
    {
        $dataList = array();
        $i = 0;
        foreach ($rows as $row) {
            $c = new UserInformation();
            foreach ($row as $key => $value) {
                $key = underscoreToHump($key);
                /** 安全处理 */
                $c->$key = htmlentities($value);
            }
            $dataList[$i] = (array)$c;
            $i++;
        }
        return $dataList;
    }


}