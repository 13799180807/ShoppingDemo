<?php


namespace Application\Dao;


use Application\Library\SqlUtil;

class AdminDaoImpl implements AdminDao
{

    /**
     * 获取一条数据
     * @param string $adminId
     * @return array
     */
    public function getById(string $adminId): array
    {
        return (new SqlUtil())->run("query", "SELECT * FROM tb_admin WHERE admin_id=?", "s", array($adminId));
    }
}