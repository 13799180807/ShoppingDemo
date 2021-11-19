<?php


/**
 * @param $rows
 * @return array[]
 */
function sortWareslist($rows){
    $i=0;
    foreach ( $rows as $row){
        $c=new sortWares($row[1]);
        $userList[$i]=$c;
        $i++;
    }
    $a=array("wareslist"=>$userList);
    return $a;
}
/**
 * Class sortWares
 */
class sortWares{
    public $sort_name;

    /**
     * sortWares constructor.
     * @param $sort_name
     */
    public function __construct($sort_name)
    {
        $this->sort_name = $sort_name;
    }

    /**
     * @return mixed
     */
    public function getSortName()
    {
        return $this->sort_name;
    }

    /**
     * @param mixed $sort_name
     */
    public function setSortName($sort_name): void
    {
        $this->sort_name = $sort_name;
    }


}
