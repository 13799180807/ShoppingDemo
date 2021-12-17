<?php
namespace Application\Controller;

use Application\Helper\FeedBack;
use Application\Service\GoodsCategoryServiceImpl;

class CategoryController
{
    /** 分类页面 */
    public function actionIndex()
    {

        /** 进行是不是数字和空值检测 */
        if ( count($_POST)==3  && isset($_POST['id']) && is_numeric($_POST['id']) && isset($_POST['page']) && is_numeric($_POST['page']) && isset($_POST['num']) && is_numeric($_POST['num']) )
        {
            $data=(new GoodsCategoryServiceImpl())->listGoodsCategoryIndex($_POST['id'],$_POST['page'],$_POST['num']);
            echo FeedBack::result(200,"请求成功",$data);

        }else{
            echo FeedBack::fail("请求不正确，请正确传参");

        }
    }

}