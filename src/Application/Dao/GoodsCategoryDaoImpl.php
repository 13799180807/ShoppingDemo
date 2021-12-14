<?php
namespace src\Application\Dao;
 use src\Application\Library\Connection;
 use src\Application\Library\QueryBuilder;

 class GoodsCategoryDaoImpl implements GoodsCategoryDao
 {


     /**
      * 根据id删除这个分类
      * @param $conn
      * @param int $categoryId
      * @return bool
      */
     public static function deleteByGoodsCategoryId($conn, int $categoryId): bool
     {
         $sql="DELETE FROM tb_goods_category WHERE goods_category_id=? ";
         $stmt=$conn->stmt_init();
         $stmt->prepare($sql);
         $stmt->bind_param("i",$categoryId);
         $stmt->execute();
         $stmt->close();
         return true;

     }

     /**
      * 获取所有分类信息
      * @param $conn
      * @return array
      */
     public static function listGoodsCategoryName($conn) :array
     {
         return QueryBuilder::queryAll($conn,"tb_goods_category");
     }

     /**
      * 根据查询条件获取相对应数量的
      * @param $conn
      * @param int $categoryId
      * @param int $num
      * @param int $status
      * @return int
      */
     public static function  countGoodsCategoryId($conn,int $categoryId,int $num,int $status=1) :int
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
      * 获取分页信息
      * @param $conn
      * @param int $categoryId
      * @param int $page
      * @param int $num
      * @param int $status
      * @return array
      */
     public static function listGoodsCategoryPagination($conn,int $categoryId,int $page,int $num,int $status=1) :array
     {

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
         return Connection::releaseRes($stmt);

     }

     /**
      * 获取单个分类信息
      * @param $conn
      * @param int $categoryId
      * @return array
      */
     public static function getGoodsCategoryId($conn,int $categoryId) :array
     {
         $sql="SELECT * FROM tb_goods_category WHERE goods_category_id=? ";
         $stmt=$conn->stmt_init();//构建空白的语句对象
         $stmt->prepare($sql);
         $stmt->bind_param("i",$categoryId);
         $stmt->execute();
         return Connection::releaseRes($stmt);
     }


 }

