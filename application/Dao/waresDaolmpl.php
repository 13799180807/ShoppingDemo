<?php



class waresDaolmpl implements waresDao{


    /**
     * @param $typea
     * @param $num
     * @param $state
     * @return false|mixed|string
     * 主页分类查询结果返回例如最新最热推荐
     */
    public function waresShowindex($typea, $num, $state)
    {
        $conn=Connection::conn();
        $sql="SELECT sp_uid,sp_name,sp_price,sp_imgpath,sp_hot,sp_sold FROM shop_wares WHERE sp_state='{$state}' ORDER BY {$typea} DESC limit {$num}";
        $stmt = $conn->stmt_init();
        $stmt->prepare($sql);
        $stmt->execute();
        $result=$stmt->get_result();
        $rows=$result->fetch_all(2);
        $stmt->free_result();
        $stmt->close();
        $conn->close();
        if(count($rows)>0){
            $arr=WaresModelAll::waresIndexAll($rows);
            $json=SuccessJson("请求成功",$arr);
            return $json;
        }else{
            $arr=array(
                0=>array('','','','','',''),
            );
            $arr=WaresindexlistJson($arr);
            $json=successJson("请求成功,数据为空",$arr,"0");
            return $json;
        }
    }

    /**
     * @param $sp_uid
     * @return false|mixed|string
     * 商品详情页面图片显示
     */
    public function waresShowImg($sp_uid)
    {
        $sql="SELECT sp_uid,img_Path FROM shop_waresimg WHERE sp_uid=? ";
        $conn=Connection::conn();
        $stmt=$conn->stmt_init();//构建空白的语句对象
        $stmt->prepare($sql);
        $stmt->bind_param("s",$sp_uid);
        $stmt->execute();
        $result=$stmt->get_result();
        $rows=$result->fetch_all(2);
        $stmt->free_result();
        $stmt->close();
        $conn->close();
        if (count($rows)>0){
            $arr=WaresModelAll::waresDetailsImg($rows);
            $json=SuccessJson("数据请求成功",$arr);
            return $json;
        }else{
            $arr=array(
                0=>array('',''),
            );
            $arr=WaresModelAll::waresDetailsImg($arr);
            $json=SuccessJson("数据请求成功，但是数据为空",$arr,"0");
            return $json;
        }
    }

    /**
     * @param $sp_uid
     * @return false|mixed|string
     * 商品详细介绍的
     */
    public function waresShowText($sp_uid)
    {
        $sql="SELECT sp_uid,spuidtext FROM shop_warestext WHERE sp_uid=? ";
        $conn=Connection::conn();
        $stmt=$conn->stmt_init();//构建空白的语句对象
        $stmt->prepare($sql);
        $stmt->bind_param("s",$sp_uid);
        $stmt->execute();
        $result=$stmt->get_result();
        $rows=$result->fetch_all(2);
        $stmt->free_result();
        $stmt->close();
        $conn->close();
        if (count($rows)>0){
            $arr=WaresModelAll::waresDerailsText($rows);
            $json=SuccessJson("数据请求成功",$arr);
            return $json;
        }else{
            $arr=array(
                0=>array('',''),
            );
            $arr=WaresModelAll::waresDerailsText($arr);
            $json=SuccessJson("请求成功，数据为空",$arr,"0");
            return $json;
        }
    }

    /**
     * @param $sp_uid
     * @return false|mixed|string
     * 商品详情页面显示作用
     */
    public function waresShowDetails($sp_uid)
    {
        // TODO: Implement waresShowDetails() method.
        $sql="SELECT sp_uid,sp_varieties,sp_name,sp_price,sp_num,sp_imgpath,sp_hot,sp_sold,sp_text FROM shop_wares WHERE sp_uid=? ";
        $conn=Connection::conn();
        $stmt=$conn->stmt_init();//构建空白的语句对象
        $stmt->prepare($sql);
        $stmt->bind_param("s",$sp_uid);
        $stmt->execute();
        $result=$stmt->get_result();
        $rows=$result->fetch_all(2);
        $stmt->free_result();
        $stmt->close();
        $conn->close();
        if (count($rows)>0){
            $arr=WaresModelAll::waresDereilsAll($rows);
            $json=SuccessJson("请求成功",$arr);
            return $json;
        }
        else{
            $arr=array(
                0=>array('','','','','','','','',''),
            );
            $arr=WaresModelAll::waresDereilsAll($arr);
            $json=SuccessJson("请求成功，空数据",$arr,"0");
            return $json;
        }
    }


}


