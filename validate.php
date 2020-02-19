<?php  
require('connect.php');
if (isset($_POST['users_username']) and isset($_POST['users_pass'])){
$users_username = $_POST['users_username'];
$users_pass = $_POST['users_pass'];
$query = "SELECT * FROM `users` WHERE users_username='$users_username' and users_pass='$users_pass'";
$result = mysqli_query($connection, $query) or die(mysqli_error($connection));
$count = mysqli_num_rows($result);
if ($count == 1){
echo "giris basarili";
}else{
echo "giris basarisiz";
}
}
?>
