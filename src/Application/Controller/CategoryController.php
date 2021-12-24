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

    /** 管理员分类界面 */
    public function actionAdminIndex()
    {
        $postArr=array('goodsStatus','goodsLabel','goodsCategory','num','page');
        if ( count($_POST)==6 && (new FilterHelper())->numeric($postArr))
        {

            /** 判断其数值是否合法 */
            $data=array(
                0=>array('goodsName',$_POST['goodsName'],"str",0,10),
                1=>array('goodsStatus',$_POST['goodsStatus'],"num",0,5),
                2=>array('goodsLabel',$_POST['goodsLabel'],"num",0,5),
                3=>array('goodsCategory',$_POST['goodsCategory'],"num",0,15),
                4=>array('num',$_POST['num'],"num",5,50),
                5=>array('page',$_POST['page'],"num",0,100)
            );
            foreach ($data as $arr)
            {
                $res=(new RegularExpression())->run($arr);
                if (!$res[1]) {
                    echo FeedBack::fail("请求不正确，请正确传参");
                    return;
                }
            }

            /** 替换 */
            $name=str_replace('%','',$_POST['goodsName']);

            $arr=array(
                'name'=>$name,
                'status'=>$_POST['goodsStatus'],
                'label'=>$_POST['goodsLabel'],
                'category'=>$_POST['goodsCategory'],
                'num'=>$_POST['num'],
                'page'=>$_POST['page']
            );
            $data= (new GoodsCategoryServiceImpl())->listAdminIndex($arr);
            echo FeedBack::result(200,"请求成功",$data);
            return;

        }
        echo FeedBack::fail("请求不正确，请正确传参");

    }

}