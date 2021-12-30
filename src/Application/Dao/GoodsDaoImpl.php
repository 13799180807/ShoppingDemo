<?php
namespace Application\Dao;
use Application\Helper\Filter;
use Application\Library\SqlUtil;

class GoodsDaoImpl implements  GoodsDao
{
    /**
     * 删除商品表中一个分类的数据
     * @param int $goodsCategoryId
     * @return bool
     */
    public function removeByGoodsCategoryId(int $goodsCategoryId): bool
    {
        $sql="DELETE FROM tb_goods WHERE goods_category_id=?";
        return (new SqlUtil())->run("remove",$sql,"i",array($goodsCategoryId));

    }

    /**
     * 根据id进行查询商品的某个信息
     * @param string $userType
     * @param int $goods_id
     * @param int $goods_status
     * @return array
     */
    public function getById(string $userType, int $goods_id, int $goods_status=0): array
    {
        /** 组装sql */
        $dataList=array();

        if ($userType == "admin" ) {
            $sql="SELECT * FROM tb_goods WHERE goods_id=? AND";
        } else {
            $sql="SELECT goods_id,goods_name,goods_category_id,goods_price,goods_stock, goods_hot,goods_recommendation,goods_describe,goods_img,created_at FROM tb_goods WHERE goods_id=? AND";
        }
        $fieldsType="i";
        $dataList[]=$goods_id;

        if ($goods_status != 0) {
            /** 增加条件 */
            $sql=$sql." goods_status=?";
            $fieldsType=$fieldsType."i";
            $dataList[]=$goods_status;
        } else {
            /** 去掉多余的AND */
            $sql=trim($sql,"AND");

        }
        return (new SqlUtil())->run("query",$sql,$fieldsType,$dataList);

    }

    /**
     * 根据不同字段进行查询该字段的信息
     * @param int $num
     * @param int $status
     * @param string $field
     * @param string $value
     * @return array
     */
    public function listField(int $num,int $status, string $field="",string $value="") : array
    {
        $sql = "SELECT goods_id,goods_name,goods_category_id,goods_price,goods_img FROM tb_goods WHERE";
        $dataList = array();
        $fieldsType="";

        if ($status != 0) {
            $sql=$sql." goods_status=? AND";
            $dataList[]=$status;
            $fieldsType=$fieldsType."i";
        }

        /** 拼接sql */
        if ( $field !="") {
            $sql=$sql." ".$field."=? ORDER BY updated_at DESC limit ?";
            $dataList[]=$value;
            $dataList[]=$num;
            $fieldsType=$fieldsType."si";
        } else {
            $sql=trim($sql,"WHERE");
            $sql=trim($sql,"AND");
            $sql=$sql." ORDER BY created_at DESC limit ?";
            $dataList[]=$num;
            $fieldsType=$fieldsType."i";
        }
        return (new SqlUtil())->run("query",$sql,$fieldsType,$dataList);

    }

    /**
     * 根据名字进行模糊查询商品信息
     * @param string $goodsName
     * @param int $status
     * @return array
     */
    public function getByGoodsName(string $goodsName,int $status=0) : array
    {
        $sql="SELECT goods_id,goods_name,goods_category_id,goods_price,goods_img FROM tb_goods WHERE";
        $dataList=array();
        $goodsName=str_replace("%"," ",addslashes($goodsName));
        $goodsName="%".$goodsName."%";
        /** 拼装 */
        if ($status !=0) {
            $sql=$sql." goods_status=? and goods_name  LIKE ?";
            $fieldsType="is";
            $dataList[]=$status;
            $dataList[]=$goodsName;
        } else {
            $sql=$sql." goods_name  LIKE ?";
            $fieldsType="s";
            $dataList[]=$goodsName;
        }
        return (new SqlUtil())->run("query",$sql,$fieldsType,$dataList);
    }

    /**
     * 获取这个分类下的商品的id
     * @param int $goodsCategoryId
     * @return array
     */
    public function listGoodsCategoryId(int $goodsCategoryId) :array
    {
        $sql="SELECT goods_id FROM tb_goods WHERE goods_category_id=? ";
        return (new SqlUtil())->run("query",$sql,"i",array($goodsCategoryId));
    }

    /**
     * 根据商品id进行这个分类更新
     * @param int $goodsId
     * @param string $name
     * @param int $categoryId
     * @param float $prick
     * @param int $stock
     * @param int $status
     * @param int $hot
     * @param int $recommendation
     * @param string $describe
     * @param string $img
     * @return bool
     */
    public function updateGoodsById(int $goodsId, string $name, int $categoryId, float $prick, int $stock, int $status = 1,
                                    int $hot = 2, int $recommendation = 2, string $describe = "", string $img = ""): bool
    {
        /** 数据检测过滤 */
        //mysqli_real_escape_string()没必要了意思不大

        /** 过滤转义字符 */
        $filterArr=array(
            "name"=>$name,
            "describe"=>$describe,
            "img"=>$img,
        );
        $resFilter=Filter::setEntities($filterArr);

        /** 执行操作 */
        $sql="UPDATE tb_goods SET goods_name=?,goods_category_id=?,goods_price=?,goods_stock=?,goods_status=?,
                  goods_hot=?, goods_recommendation=? ,goods_describe=?,goods_img=? WHERE goods_id=? ";
        $dataList=array($resFilter['name'],$categoryId,$prick,$stock,$status,$hot,$recommendation,$resFilter['describe'],$resFilter['img'],$goodsId);
        return (new SqlUtil())->run("update",$sql,"sisiiiissi",$dataList);

    }
}