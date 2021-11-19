<?php


class WaresText
{
    public $sp_uid;
    public $spuidtext;

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
    public function getSpuidtext()
    {
        return $this->spuidtext;
    }

    /**
     * @param mixed $spuidtext
     */
    public function setSpuidtext($spuidtext): void
    {
        $this->spuidtext = $spuidtext;
    }
}