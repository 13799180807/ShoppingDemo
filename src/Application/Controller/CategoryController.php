<?php
namespace Application\Controller;

use Application\Helper\FeedBack;
use Application\Service\GoodsCategoryServiceImpl;

class CategoryController
{
    /** 分类页面 */
    public function actionIndex()
    {
        if (count($_POST)!=3){
            echo FeedBack::fail("请求不正确，请正确传参");
            return;
        }
        /** 进行是不是数字和空值检测 */
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
            echo FeedBack::result(200,"请求成功",$res);

        }else{
            echo FeedBack::fail("请求失败，参数错误");

        }
    }

}