<?php
include "base/header.php";

if(isset($_SESSION['id'])){
    header('Location: home.php');
    exit();
}else{
    
    include "car-list.php";
}

?>