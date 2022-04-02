<?php 
session_start();
session_unset();
session_destroy();

setcookie('TID', '', strtotime(''), '/');
header('location: ../login?m=1');
?>