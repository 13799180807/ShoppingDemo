<?php

namespace core;
use Application\Helper\FeedBack;

class Route
{
    /** 控制器 */
    public string $controller='';

    /** 方法名 */
    public string $action='';

    /** 存储变量信息 */
    public array $ctrlArr=array();

    /** 加载路由 */
    public function run()
    {
       // echo '初始化路由';
        $this->setRoute($_SERVER['REQUEST_URI']);
        $this->setCtrl();
        $this->makeCtrl();

    }

    /**
     * 对路由进行处理,分割路由第一个控制器第二个方法名多余算get请求参数
     * @param string $path
     */
    public function setRoute(string $path)
    {
        /** 判断出现的位置  如果存在/index.php 则去掉  */
        if (strpos($path,'/index.php')==0)
        {
            $path=str_replace('/index.php','',$path);
        }

        /** 去掉开头结尾的 / 得到自己想要的样子 */
        if(strpos($path,'/')==0)
        {
            $path=trim($path,'/');
        }

        /** 进行分割得到想要的样子 */
        $pathArr=array();
        if (strlen($path) !=0)
        {
            $pathArr=explode('/',$path);
        }
        $this->ctrlArr=$pathArr;

    }

    /** 处理前端get传进来的值 用get保存*/
    public function setParam($param)
    {
        $i=2;
        /** 判断分割后的有几个 */
        while ($i<=count($param))
        {
            /** 一个名字，一个键值 用get存入 */
            if (isset($param[$i]) && isset($param[$i+1]))
            {
                $_GET[$param[$i]]=$param[$i+1];
            }
            $i +=2;
        }
    }

    /** 设置控制器和方法 **/
    public function setCtrl()
    {
        $pathArr=$this->ctrlArr;

        /** 完整的uri */
        if (count($pathArr)>=2)
        {
            /** 控制器 */
            if (isset($pathArr[0]))
            {
                $this->controller=$pathArr[0];
                unset($pathArr[0]);
            }

            /** 方法名 */
            if (isset($pathArr[1]))
            {
                $this->action=$pathArr[1];
                unset($pathArr[1]);
            }

            /** 处理get信息存入post */
            if (count($pathArr)>0)
            {
                $this->setParam($pathArr);
            }

            /**测试 */
            //var_dump($_GET);
        }

    }

    /** 制作路由靠控制器的转发进行判断 */
    public function makeCtrl()
    {
        /** 地址名字拼接组装 */

        $ctrlName=$this->controller.'Controller.php';
        $ctrlPath=APP_PATH.APP_NAME.'/Controller/'.$ctrlName;

        /** 检查控制器存在不存在 */
        if (is_file($ctrlPath))
        {
            /** 控制器存在，引入控制器 组装一下路径 new一个对象 */
            include $ctrlPath;
            $nameSpace='\Application\Controller\\'.$this->controller.'Controller';
            $ctrl=new $nameSpace();

            /** 对控制器的方法进行组装 */
            $method='action'.ucfirst($this->action);

            /** 判断该方法存在不存在 */
            if (method_exists($ctrl,$method))
            {
                /** 方法存在 调用这个方法 */
                header("Content-type:Application/json;charset=utf-8");
                $ctrl->$method();

            } else {
                /** 方法不存在 */
                $error=array();
                $error['err']="请联系管理员";
                header("Content-type:Application/json;charset=utf-8");
                echo FeedBack::result(404,"请求出错",$error);
            }

        } else{
             /** 控制器不存在 */
        //    (new Log())->run("控制器不存在：".$ctrlPath);
      //      header("Content-type:Application/json;charset=utf-8");
       //     echo FeedBack::result(500,"服务器出错","");
           include APP_PATH.'tests/test.php';
        }

    }


}