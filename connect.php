<?php
$connection = mysqli_connect('localhost', 'root', '');
if (!$connection){
    die("veritabani baglanti hatasi" . mysqli_error($connection));
}
$select_db = mysqli_select_db($connection, 'halstok');
if (!$select_db){
    die("boyle bir veritabani yok" . mysqli_error($connection));
}