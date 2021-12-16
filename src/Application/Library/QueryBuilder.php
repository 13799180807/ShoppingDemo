<?php
namespace Application\Library;

class QueryBuilder
{

    public $conn;   //数据库连接
    public int $type; //查询类型 1无条件查询 2有条件查询
    public string $sql;  //数据库语句
    public string $fieldsType;  //字段类型
    public array $key;   //字段值
    public array $res; //查询结果

    /**
     * 统一查询 传入type sql,字符类型,绑定的值
     * type: 1无条件查询 2有条件查询
     * @param int $type
     * @param string $sql
     * @param string $types
     * @param array $key
     * @return array
     */
    public function run(int $type, string $sql,string $types="",array $key=array()): array
    {
        $this->setParameter($type,$sql,$types,$key);
        $this->list();
        return $this->res;
    }

    /** 执行查询 */
    public function list()
    {
        if ($this->type==1)
        {
            /** 没有条件查询 */
            $stmt = $this->conn->stmt_init();
            $stmt->prepare($this->sql);
            $stmt->execute();
            $result=$stmt->get_result();
            $this->res=$result->fetch_all(1);
            $stmt->free_result();
            $stmt->close();

        }  else{
            /** 有条件查询 */
            $stmt = $this->conn->prepare($this->sql);
            $stmt->bind_param($this->fieldsType, ...$this->key);
            $stmt->execute();
            $result=$stmt->get_result();
            $this->res=$result->fetch_all(1);
            $stmt->free_result();
            $stmt->close();
        }

    }

    /**
     * 写入参数
     * @param int $type
     * @param string $sql
     * @param string $types
     * @param array $key
     */
    public function setParameter(int $type,string $sql, string $types,array $key)
    {
        $this->conn=(new Connection())->conn();
        $this->type=$type;
        $this->sql=$sql;
        $this->fieldsType=$types;
        $this->key=$key;
    }

}
