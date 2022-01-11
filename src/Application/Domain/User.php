<?php


namespace Application\Domain;


class User
{
    public string $user_id;
    public string $user_pwd;
    public string $created_at;

    public function userModel(array $rows): array
    {
        $dataList = array();
        $i = 0;
        foreach ($rows as $row) {
            $c = new User();
            foreach ($row as $key => $value) {
                $key = underscoreToHump($key);
                /** 安全处理 */
                $c->$key = htmlentities($value);
            }
            $dataList[$i] = $c;
            $i++;
        }
        return $dataList;
    }


}