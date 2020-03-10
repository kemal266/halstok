<?php include("baglan.php");?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="style.css">
     

        <meta charset="utf-8">
        <title>Hal Stok Sistemi</title>
    </head>
    <body>
    <?php

if(isset($_POST["submit"])){
    $username=$_POST["username"];
    $password=$_POST["password"];
    $sql = "INSERT INTO tbl_kullanici(username , password)
                                        VALUES('$username','$password')";
    if($conn->query($sql) == TRUE){
        echo "Kayıt eklendi...";
        header("Refresh:3; url=kayit.php");
    } else {
        echo $conn->error;
    }
    
}

?>

        <form method="post" action="">
            <div class="form">
                <input type="text" name="username" required placeholder="Kullanıcı adınızı giriniz."> <br>
                <input type="password" name="password" required placeholder="Şifrenizi giriniz."> <br>
                <input type="submit" class="btn" name="submit" value="Giriş Yap">
                <input type="button" onclick="location.href='kayitol.php' " class="btnn" name="submitt" value="Üye Ol">
               
            </div>
        </form>
        
</body>

</html>
