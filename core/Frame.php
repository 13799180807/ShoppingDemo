<?php


namespace core;




use src\Application\Exception\Log;

class Frame
{
    /**
     * 存放已经引入的类
     * @var array
     */
    static array $classMap=array();

    /** 框架入口 */
    public function run()
    {
        /** 载入配置 */
        (new Config())->run();

        /** 路由初始化 */
        (new Route())->run();

    }

    /**
     * 自动载入
     * @param string $nameSpace
     * @return bool
     */
    public static function loader( string $nameSpace) :bool
    {
      //  echo "自动载入:".$nameSpace;

        /** 判断是否已经引入 */
        if (isset(self::$classMap[$nameSpace]))
        {
            return true;
        }

        /** 组合路径 */
        $class=str_replace('\\','/',$nameSpace);
        $classPath=APP_PATH.$class.'.php';

        /** 去掉不存在的类 */
        if (!is_file($classPath))
        {
            return false;
        }

        /** 引入类文件 */
        include $classPath;
        self::$classMap[$nameSpace]=$classPath;
        return true;

    }

}