<?php
namespace src\Application\Controller;

use src\Application\Helper\ResultJson;
use src\Application\Service\GoodsCategoryServiceImpl;

class GoodsCategoryController
{
    /** 分类页面 */
    public function categoryPageInformation()
    {
        if (isset($_POST['id']) && is_numeric($_POST['id']) && isset($_POST['page']) && is_numeric($_POST['page']) && isset($_POST['num']) && is_numeric($_POST['num']) )
        {
            //显示分类列表
            $category=GoodsCategoryServiceImpl::listGoodsCategoryName();
            //页码
            $totalPage=GoodsCategoryServiceImpl::countGoodsCategoryId($_POST['id'],$_POST['num']);
            //信息
            $goodsList=GoodsCategoryServiceImpl::listGoodsCategoryPagination($_POST['id'],$_POST['page'],$_POST['num']);

            //分类信息
            if($_POST['id']==0)
            {
                $categoryId="0";
                $categoryName="查询全部";
            }
            else{
                $categoryOne=GoodsCategoryServiceImpl::getGoodsCategoryId($_POST['id']);
                foreach ($categoryOne as $value){
                    $categoryId=$value[0];
                    $categoryName=$value[1];
                }
            }

            $callBack=array();
            $callBack['totalPage']=$totalPage;
            $callBack['page']=$_POST['page'];
            $callBack['num']=$_POST['num'];
            $callBack['categoryId']=$categoryId;
            $callBack['categoryName']=$categoryName;

            $res=array(
                "category"=>$category,
                "goodsList"=>$goodsList,
                "callBack"=>$callBack

            );

            echo ResultJson::result(200,"请求成功",$res);

        }else{

            $error=array();
            $error['err']="参数错误";
            echo ResultJson::result(400,"请求出错",$error);

        }
    }

}