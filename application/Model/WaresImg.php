<?php


class WaresImg
{
    public $sp_uid;  //商品UID
    public $sp_Path;

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