<?php


namespace Application\Dao;


interface AdminDao
{
    /**
     * 根据adminId获取数据
     * @param string $adminId
     * @return array
     */
    public function getById(string $adminId): array;

}