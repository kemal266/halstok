<?php
ob_start();
session_start();

if (isset($_SESSION['firma_mail'])) {

    header("location:production");
}else{


    header("location:production/login.php");
}







?>