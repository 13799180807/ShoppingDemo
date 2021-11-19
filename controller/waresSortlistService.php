<?php
require_once './../DAOmysqli/listDAO.php';
header("Content-type:application/json;charset=utf-8");

if(isset($_POST['Sortlist'])){
    $json=sortWaresimpl();
    echo $json;
}