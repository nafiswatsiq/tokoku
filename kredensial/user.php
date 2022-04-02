<?php
session_start();
if(isset($_SESSION['TID'])){
    // session active
    $id_user = $_SESSION['id_user'];
} else if(isset($_COOKIE['TID'])){
    // $_SESSION['id_user']  = $id_user;
    $id_user = $_COOKIE['TID'];
} else{
    // header('location: login');
};
?>