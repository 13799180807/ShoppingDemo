<?php


namespace Application\Library;

/**
 * 统计
 * Class CountBuilder
 * @package Application\Library
 */
class CountBuilder
{
    public $conn; //数据库连接
    public int $type; //统计类型 1无条件统计 2有条件统计
    public string $sql; //sql语句
    public string $fieldsType; //字段类型
    public array $key; //字段值
    public int $res; //统计结果

    /**
     * 统计：1无条件统计2有条件统计，sql语句,字段类型,字段值
     * @param int $type
     * @param string $sql
     * @param string $types
     * @param array $key
     * @return int
     */
    public function run(int $type,string $sql,string $types="",array $key=array()) :int
    {
        $this->setParameter($type,$sql,$types,$key);
        $this->count();
        return $this->res;
    }

    /** 执行统计 */
    public function count()
    {
        if ($this->type==1)
        {
            /** 无条件统计 */

        } else{
            /** 有条件统计 */
            $stmt = $this->conn->prepare($this->sql);
            $stmt->bind_param($this->fieldsType, ...$this->key);
            $stmt->execute();
            $result=$stmt->get_result();
            $stmt->free_result();
            $stmt->close();
            $this->res = $result -> num_rows; //查到几条数据
        }

    }

    /**
     * 写入参数
     * @param int $type
     * @param string $sql
     * @param string $types
     * @param array $key
     */
    public function setParameter(int $type, string $sql, string $types,array $key)
    {
        $this->conn=(new Connection())->conn();
        $this->type=$type;
        $this->sql=$sql;
        $this->fieldsType=$types;
        $this->key=$key;
    }


}