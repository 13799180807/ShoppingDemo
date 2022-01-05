<?php


namespace core;

use Application\Exception\Log;

class Frame
{

    /**
     * 存放已经引入的类
     * @var array
     */
    static array $classMap = array();

    /**
     * 自动载入
     * @param string $nameSpace
     * @return bool
     */
    public static function loader(string $nameSpace): bool
    {
//        echo "自动载入:".$nameSpace;
//        echo "<br/>";

        /** 判断是否已经引入 */
        if (isset(self::$classMap[$nameSpace])) {
            return true;
        }

        /** 进行分割 */
        $dirName = explode("\\", $nameSpace);

        /** 进行替换 */
        $class = str_replace('\\', '/', $nameSpace);

        /** 判断是不是core开头的的，不是就进入src目录下 */
        if ($dirName[0] == "core") {
            /** 组合路径 */
            $classPath = APP_PATH . $class . '.php';
        } else {
            /** 组合路径 */
            $classPath = APPLICATION . $class . '.php';
        }

        /**  判断该文件存在不存在  存在引入 不存在去掉不存在的类 */
        if (is_file($classPath)) {
            /** 引入类文件 */
            include $classPath;
            self::$classMap[$nameSpace] = $classPath;
            return true;
        }

        return false;
    }

    /** 框架入口 */
    public function run()
    {
        /** 载入配置 */
        (new Config())->run();

        /** 路由初始化 */
        (new Route())->run();

    }

}