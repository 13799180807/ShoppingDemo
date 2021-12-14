<?php
/** 数据库连接配置 */
if (!function_exists('database'))
{
    function database(): array
    {
        return array(
            'link'=>'localhost:3306',
            'user'=>'igg',
            'password'=>'igg123456',
            'dbName'=>'iggdemo',
            'dbCode'=>'utf8'
        );
    }

}
