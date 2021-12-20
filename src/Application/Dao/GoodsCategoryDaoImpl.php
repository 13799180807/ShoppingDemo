<?php
namespace Application\Dao;
 use Application\Library\SqlUtil;

 class GoodsCategoryDaoImpl implements GoodsCategoryDao
 {
     /**
      * 获取所有分类信息
      * @param string $fields
      * @return array
      */
     public function listGoodsCategoryName(string $fields) : array
     {
         $sql="SELECT {$fields} FROM tb_goods_category ";
         return (new SqlUtil())->run("queryAll",$sql);
     }

     /**
      * 根据查询条件获取相对应的页码
      * @param int $categoryId
      * @param int $num
      * @param int $status
      * @return int
      */
     public function countGoodsCategoryId(int $categoryId,int $num,int $status=1) : int
     {
         if($categoryId==0)
         {
             $sql="SELECT goods_id FROM tb_goods where goods_status=?";
             $res=(new SqlUtil())->run("count",$sql,"i",array($status));
         }
         else{
             $sql="SELECT goods_id FROM tb_goods WHERE goods_category_id=? and goods_status=? ";
             $res=(new SqlUtil())->run("count",$sql,"ii",array($categoryId,$status));
         }
         return ceil($res/$num); //有小数就取整加一
     }

     /**
      * 获取分页信息数据
      * @param string $fields
      * @param int $categoryId
      * @param int $page
      * @param int $num
      * @param int $status
      * @return array
      */
     public function listGoodsCategoryPagination(string $fields,int $categoryId,int $page,int $num,int $status=1) : array
     {
         $page=($page-1)*$num;
         if($categoryId==0)
         {
             $sql="SELECT {$fields} FROM tb_goods  WHERE goods_status=? ORDER BY created_at LIMIT ?,?";
             return (new SqlUtil())->run("query",$sql,"iii",array($status,$page,$num));

         }else{
             $sql="SELECT {$fields} FROM tb_goods WHERE goods_category_id=? and goods_status=? ORDER BY created_at LIMIT ?,?";
             $data=array($categoryId,$status,$page,$num);
             return (new SqlUtil())->run("query",$sql,"iiii",array($categoryId,$status,$page,$num));
         }

     }

     /**
      * 获取单个分类信息
      * @param string $fields
      * @param int $categoryId
      * @return array
      */
     public function getGoodsCategoryId(string $fields,int $categoryId) : array
     {
         $sql="SELECT {$fields} FROM tb_goods_category WHERE goods_category_id=? ";
         return (new SqlUtil())->run("query",$sql,"i",array($categoryId));
     }

     /**
      * 根据这个id删除这个分类
      * @param int $categoryId
      * @return bool
      */
     public function removeByGoodsCategoryId(int $categoryId): bool
     {
         $sql="DELETE FROM tb_goods_category WHERE goods_category_id=?";
         return (new SqlUtil())->run("remove",$sql,"i",array($categoryId));
     }





 }

