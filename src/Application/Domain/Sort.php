<?php

class Sort{
    public $id;
    public $sort_name;

    /**
     * Sort constructor.
     * @param $id
     * @param $sort_name
     */
    public function __construct($id="", $sort_name="")
    {
        $this->id = $id;
        $this->sort_name = $sort_name;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
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

    /**
     * @param $rows
     * @return array
     * 显示分类的种类
     */
    public static function sortModel($rows){
        $i=0;
        foreach ($rows as $row){
            $c=new Sort($row[0],$row[1]);
            $dataList[$i]=$c;
            $i++;
        }
        return $dataList;
    }


}