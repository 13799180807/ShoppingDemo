<?php


class GoodsCategoryController
{
    /**
     * @param $parameter
     * @return false|string
     * 分类页面显示信息
     */
    public static function categoryPageInformation($parameter)
    {
        if( isset($parameter['id']) && is_numeric($parameter['id']) && isset($parameter['page']) && is_numeric($parameter['page']) && isset($parameter['num']) && is_numeric($parameter['num']))
        {
            //显示分类列表
            $category=GoodsCategoryModel::categoryInformation(GoodsCategoryServiceImpl::listGoodsCategoryName());
            //页码
            $totalPage=GoodsCategoryServiceImpl::countGoodsCategoryId($parameter['id'],$parameter['num']);
            //信息
            $goodsList=GoodsModel::homeInformationDisplay(GoodsCategoryServiceImpl::listGoodsCategoryPagination($parameter['id'],$parameter['page'],$parameter['num']));
            //分类信息
            if($parameter['id']==0)
            {
                $categoryId="0";
                $categoryName="查询全部";
            }
            else{
                $categoryOne=GoodsCategoryServiceImpl::getGoodsCategoryId($parameter['id']);
                foreach ($categoryOne as $value){
                    $categoryId=$value[0];
                    $categoryName=$value[1];
                }
            }


            $callBack=array();
            $callBack['totalPage']=$totalPage;
            $callBack['page']=$parameter['page'];
            $callBack['num']=$parameter['num'];
            $callBack['categoryId']=$categoryId;
            $callBack['categoryName']=$categoryName;

            $res=array(
                "category"=>$category,
                "goodsList"=>$goodsList,
                "callBack"=>$callBack

            );

            return successJson("获取成功",$res);

        }else{

            $error=array();
            $error['err']="请输入正确值";
            return failJson("请求失败，参数不正确", $error);

        }
    }

}