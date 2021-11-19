<?php


function imgWareslist($rows){
    $i=0;
    foreach ($rows as $row){
        $c=new imgWares($row[0],$row[1]);
        $userList[$i]=$c;
        $i++;
    }
    $a=array("wareslist"=>$userList);
    return $a;
}

/***
 * Class imgWares
 */
class imgWares
{
    public $sp_uid;  //商品UID
    public $sp_Path; //商品图片地址

    /**
     * imgWares constructor.
     * @param $sp_uid
     * @param $sp_Path
     */
    public function __construct($sp_uid, $sp_Path)
    {
        $this->sp_uid = $sp_uid;
        $this->sp_Path = $sp_Path;
    }


    /**
     * @return mixed
     */
    public function getSpUid()
    {
        return $this->sp_uid;
    }

    /**
     * @param mixed $sp_uid
     */
    public function setSpUid($sp_uid): void
    {
        $this->sp_uid = $sp_uid;
    }

    /**
     * @return mixed
     */
    public function getSpPath()
    {
        return $this->sp_Path;
    }

    /**
     * @param mixed $sp_Path
     */
    public function setSpPath($sp_Path): void
    {
        $this->sp_Path = $sp_Path;
    } //商品图片地址



}