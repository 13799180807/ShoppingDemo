<?php
namespace Application\Library;

/**
 * 删除
 * Class DeleteBuilder
 * @package Application\Library
 */
class DeleteBuilder
{
    public $conn; //数据库连接
    public int $type; //删除类型：1无条件删除，2有条件删除
    public string $sql; //sql语句
    public string $fieldsType; //字段类型
    public array $key; //字段值
    public bool $res; //删除结果

    /**
     * 删除：1无条件统计，2有条件统计,sql语句，字段类型，字段值
     * @param int $type
     * @param string $sql
     * @param string $types
     * @param array $key
     * @return bool
     */
    public function run(int $type,string $sql,string $types="",array $key=array()) :bool
    {
        $this->setParameter($type,$sql,$types,$key);
        $this->delete();
        return $this->res;
    }

    /** 执行删除 */
    public function delete()
    {
        if ($this->type==1)
        {
            /** 无条件删除 */

        } else {
            /** 有条件删除 */
            $stmt = $this->conn->prepare($this->sql);
            $stmt->bind_param($this->fieldsType, ...$this->key);
            $stmt->execute();
            $stmt->close();
            $this->res =true;
        }
    }

    /**
     * 写入参数
     * @param int $type
     * @param string $sql
     * @param string $types
     * @param array $key
     */
    public function setParameter(int $type,string $sql,string $types,array $key)
    {
        $this->conn=(new Connection())->conn();
        $this->type=$type;
        $this->sql=$sql;
        $this->fieldsType=$types;
        $this->key=$key;

    }




}

