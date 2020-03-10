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

if(isset($_POST["submite"])){
    $adi=$_POST["adi"];
    $soyadi=$_POST["soyadi"];
    $username=$_POST["username"];
    $password=$_POST["password"];
    $tel=$_POST["tel"];
    $adres=$_POST["adres"];

    $ekle = "INSERT INTO tbl_kullanici(adi, soyadi, username, password, tel, adres )
                                        VALUES('$adi','$soyadi','$username','$password','$tel','$adres')";
       if($conn->query($ekle) == TRUE){
        echo "Kayıt eklendi...";
        header("Refresh:3; url=kayitol.php");
    } else {
        echo $conn->error;
    }
    
}
 
?>
      <form method="post" action="">
            <div class="form">
                <input type="text" name="adi" required placeholder="Adınızı giriniz."> <br>
                <input type="text" name="soyadi" required placeholder="Soyadinizi giriniz."> <br>
                <input type="text" name="username" required placeholder="Mail adresinizi giriniz."> <br>
                <input type="password" name="password" required placeholder="Şifrenizi giriniz."> <br>
                <input type="text" name="tel" required placeholder="Telefon Numaranızı Giriniz."> <br>
                <input type="text" name="adres" required placeholder="Adres."> <br>
                <input type="submit" class="bttn" name="submite" value="Kayıt Ol">
             
                </div>
        </form>
        
</body>
</html>