<?php

namespace core;


class Config
{
    public static array $configData;

    /**
     * 配置入口
     */
    public function run()
    {

      // echo __CLASS__."配置入口"."<hr/>";

        /** 组合路径 */
        $dirPath=APP_PATH.'src';
     //   $dirPath=APP_PATH.'tests';
        $config=scandir($dirPath);

        foreach ($config as $item)
        {
            /** 跳出本次循环  */
            if ($item=="." || $item==".." || $item=="constants"  )
            {
                continue;
            }

            $classPath=$dirPath.'/'.$item;
            if (is_file($classPath))
            {
                $class=include $classPath;
                $configName=str_replace('.php','',$item);
                self::$configData[$configName]=$class;
            }
        }
    }

    /**
     * @param string $name
     * @return false|mixed
     * 获取配置信息
     */
    public function config(string $name)
    {
        $dirName=$name;
        $configName='';

        /** 分割配置信息 */
        if (strpos($name,'.'))
        {
            list($dirName,$configName)=explode('.',$name);
        }

        /** 获取信息 */
        $config=self::$configData;

        /** 拿到一级配置信息 */
        if ($configName=="" && isset($config[$dirName]))
        {
            return $config[$dirName];
        }

        /** 拿到二级配置信息 */
        if ($configName !== "" && isset($config[$dirName][$configName]))
        {
            return $config[$dirName][$configName];
        }
        return  false;

    }

}