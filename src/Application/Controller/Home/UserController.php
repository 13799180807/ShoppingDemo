<?php


class UserController
{
    /**
     * 用户注册
     * 普通用户一个个注册
     * 管理员可以多个注册
     * 这是用户的控制器所以只支持一个个注册
     */
    public static function userRegister($parameter){
        if (isset($parameter['account']) && isset($parameter['password']) && $parameter['account']!="" && $parameter['password']!="" ){
            $User=array(array($parameter['account'],$parameter['password']));
            $User=UserModel::addUser($User);
            $res=UserServiceImpl::addUser($User);

            if ($res["success"]=="[{$parameter['account']}]"){
                //注册成功
                $backList=array();
                $backList["account"]="{$parameter['account']}";
                $backList["password"]="{$parameter['password']}";
                $json=successJson("注册成功",$backList);
                return $json;

            }else{
                $backList=array();
                $backList["account"]="{$parameter['account']}";
                $backList["password"]="{$parameter['password']}";
                $json=successJson("注册失败账号已经存在",$backList);
                return $json;
            }

        }else{
            $errlist=array();
            $errlist['err']="请输入正确值";
            $json=failJson("请求失败", $errlist);
            return $json;

        }

    }

}