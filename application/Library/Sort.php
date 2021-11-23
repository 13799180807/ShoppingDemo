<?php

class Sort{
    public $sort_name;

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