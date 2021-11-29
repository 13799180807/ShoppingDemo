<?php


class SortController
{



    public static function sortPageWaresAll($parameter){

        if(isset($parameter['sortName'])  && isset($parameter['page']) &&  isset($parameter['num'])
            && is_numeric($parameter['num']) && is_numeric($parameter['page']) ){
            $name=$parameter['sortName'];
            $page=$parameter['page'];
            $num=$parameter['num'];
            $dao=new SortServiceImpl();
            $res=$dao->sortWaresPages($name,$page,$num);
            if ($res=="-1"){
                $backAll=array();
                $backAll["name"]=$name;
                $backAll["page"]=$page;
                $backAll["num"]=$num;
                $arr=array(
                    0=>array('','','',''),
                );
                $arr=WaresModelAll::sortWaresModelAll($arr,$backAll);
                $json=successJson("请求成功",$arr,"0");
                return $json;
            }else{
              $backAll=array();
              $backAll["name"]=$name;
              $backAll["page"]=$page;
              $backAll["num"]=$num;
              $arr=WaresModelAll::sortWaresModelAll($res,$backAll);
              $json=successJson("请求成功",$arr);
              return $json;
            }

        }
        $errlist=array();
        $errlist['err']="请输入正确值";
        $json=failJson("请求失败", $errlist);
        return $json;

    }

    /**
     * @param $parameter
     * @return false|string
     * 根据前端传的数量显示页码值
     */
    public static function waresSortPageList($parameter){

        if (isset($parameter['num']) && isset($parameter['sortName']) && is_numeric($parameter['num']) ){
            $name=$parameter['sortName'];
            $num=$parameter['num'];
            $dao=new SortServiceImpl();
            $res=$dao->waresPagesNum($name,$num);
            $arr=array();
            $arr['sortName']=$name;
            $arr['page']=$res;
            $arr['num']=$num;
            $json=successJson("请求成功",$arr);
            return $json;
        }else{
            $errlist=array();
            $errlist['err']="请输入正确值";
            $json=failJson("请求失败", $errlist);
            return $json;
        }
    }


    /**
     * 显示分类
     */
    public static function  waresSortList($parameter){

        if (isset($parameter["method"])){
            $typea=$parameter["method"];
            if ($typea=="all"){
                $dao=new SortServiceImpl();
                $res=$dao->sortAll();
                if ($res=="-1"){
                    $arr=array(
                        0=>array('',''),
                    );
                    $arr=Sort::sortModel($arr);
                    $json=successJson("请求成功,数据为空",$arr,"0");
                    return $json;
                }else{
                    $arr=Sort::sortModel($res);
                    $json=successJson("请求成功",$arr);
                    return $json;
                }
            }else{
                $errlist=array();
                $errlist['err']="请输入正确值";
                $json=failJson("请求失败，参数不正确", $errlist);
                return $json;
            }
        }else{
            $errlist=array();
            $errlist['err']="请输入正确值";
            $json=failJson("请求失败，参数不正确", $errlist);
            return $json;
        }
    }

    /**
     * 分类删除
     */
    public static function  waresSortDel(){
        //前端为处理
        $dao=new SortServiceImpl();
        $res=$dao->sortDel("5");
        var_dump($res);
    }

    /**
     * 添加分类
     */
    public static function waresSortAdd(){
        //前端为处理
        $dao=new SortServiceImpl();
        $res=$dao->sortAdd("ceshi111");
        var_dump($res);
    }

    /**
     * 修改分类
     */
    public static function waresSortUpdate(){
        //前端处理
        $dao=new SortServiceImpl();
        $res=$dao->sortUpate("11","是我");
        var_dump($res);
    }

}