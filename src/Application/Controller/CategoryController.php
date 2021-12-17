<?php
namespace Application\Controller;

use Application\Helper\FeedBack;
use Application\Helper\RegularExpression;
use Application\Service\GoodsCategoryServiceImpl;

class CategoryController
{
    /** 分类页面 */
    public function actionIndex()
    {
        /** 传入的参数判断 */
        if (count($_POST)==3 &&isset($_POST['id']) && isset($_POST['page'])  && isset($_POST['num']) )
        {
            /** 检测是否数字 */
            if (is_numeric($_POST['id']) && is_numeric($_POST['num']) &&  is_numeric($_POST['page']) )
            {
                /** 判断其数值是否合法 */
                $data=array(
                    0=>array('page',$_POST['page'],"num",0,999),
                    1=>array('num',$_POST['num'],"num",0,20)
                );
                foreach ($data as $arr)
                {
                    $res=(new RegularExpression())->run($arr);
                    if (!$res[1]) {
                        echo FeedBack::fail("请求不正确，请正确传参");
                        return;
                    }
                }

                $data=(new GoodsCategoryServiceImpl())->listGoodsCategoryIndex($_POST['id'],$_POST['page'],$_POST['num']);
                echo FeedBack::result(200,"请求成功",$data);
                return;
            }
        }
        echo FeedBack::fail("请求不正确，请正确传参");
    }

}