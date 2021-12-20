<?php
namespace Application\Controller;

use Application\Helper\FeedBack;
use Application\Helper\FilterHelper;
use Application\Helper\RegularExpression;
use Application\Service\GoodsCategoryServiceImpl;

class CategoryController
{
    /** 分类页面 */
    public function actionIndex()
    {
        $postArr=array('id','page','num');

        /** 检测是否数字 */
        if ( count($_POST)==3 && (new FilterHelper())->numeric($postArr))
        {
            /** 判断其数值是否合法 */
            $data=array(
                0=>array('page',$_POST['page'],"str",0,4),
                1=>array('num',$_POST['num'],"str",0,4)
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

        echo FeedBack::fail("请求不正确，请正确传参");
    }

}