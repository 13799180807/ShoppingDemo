<?php

 class GoodsCategoryDaoImpl implements GoodsCategoryDao
 {

     /**
      * @param $conn
      * @return array
      * 获取所有分类信息
      */
     public static function listGoodsCategoryName($conn) :array
     {
         return QueryBuilder::queryAll($conn,"tb_goods_category");
     }

     /**
      * @param $conn
      * @param $categoryId
      * @param $num
      * @param int $status
      * @return int
      */
     public static function  countGoodsCategoryId($conn,$categoryId,$num,$status=1) :int
     {
         if($categoryId==0)
         {
             $sql="SELECT * FROM tb_goods where goods_status=?";
             $stmt = $conn->stmt_init();
             $stmt->prepare($sql);
             $stmt->bind_param("i",$status);
         }
         else{
             $sql="SELECT * FROM tb_goods WHERE goods_category_id=? and goods_status=? ";
             $stmt = $conn->stmt_init();
             $stmt->prepare($sql);
             $stmt->bind_param("ii",$categoryId,$status);
         }
         $stmt->execute();
         $result=$stmt->get_result();
         $stmt->free_result();
         $stmt->close();
         $rows = $result -> num_rows; //查到几条数据
         return ceil($rows/$num); //有小数就取整加一
     }

     /**
      * @param $conn
      * @param $categoryId
      * @param $page
      * @param $num
      * @param int $status
      * @return array
      */
     public static function listGoodsCategoryPagination($conn, $categoryId, $page, $num,$status=1) :array
     {
         // TODO: Implement listGoodsCategoryPagination() method.
         $page=($page-1)*$num;
         if($categoryId==0)
         {
             $sql="SELECT * FROM tb_goods  WHERE goods_status=? ORDER BY created_at LIMIT ?,?";
             $stmt = $conn->stmt_init();
             $stmt->prepare($sql);
             $stmt->bind_param("iii",$status,$page,$num);
         }else{
             $sql="SELECT * FROM tb_goods WHERE goods_category_id=? and goods_status=? ORDER BY created_at LIMIT ?,?";
             $stmt = $conn->stmt_init();
             $stmt->prepare($sql);
             $stmt->bind_param("iiii",$categoryId,$status,$page,$num);
         }
         $stmt->execute();
         $result=$stmt->get_result();
         $rows=$result->fetch_all(2);
         $stmt->free_result();
         $stmt->close();
         return $rows;

     }

     /**
      * @param $conn
      * @param $categoryId
      * @return array
      * 获取单个分类信息
      */
     public static function getGoodsCategoryId($conn, $categoryId) :array
     {
         $sql="SELECT * FROM tb_goods_category WHERE goods_category_id=? ";
         $stmt=$conn->stmt_init();//构建空白的语句对象
         $stmt->prepare($sql);
         $stmt->bind_param("i",$categoryId);
         $stmt->execute();
         $result=$stmt->get_result();
         $rows=$result->fetch_all(2);
         $stmt->free_result();
         $stmt->close();
         return $rows;
     }
 }

