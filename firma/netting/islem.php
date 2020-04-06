<?php
ob_start();
session_start();
include 'baglan.php';

if(isset($_POST['loggin'])){

     $firma_ad=$_POST['firma_ad'];
     $firma_sifre=md5($_POST['firma_sifre']);

    if ($firma_ad && $firma_sifre) {

        $kullanicisor=$db->prepare("SELECT * FROM firma where firma_ad=:ad 
        and firma_sifre=:password");
        $kullanicisor->execute(array(
          'ad' => $firma_ad,
          'password' => $firma_sifre
        ));
      $say=$kullanicisor->rowCount();
      $say2=$kullanicisor->fetch();
      $_SESSION['firma_id']=$say2['firma_id'];

      if ($say>0) {
        
        $_SESSION['firma_ad']=$firma_ad;
        

        header('location:../production/index.php');

      }else{
        header('location:../production/login.php?durum=no');
      }

        
    }
}


if(isset($_POST['urunkaydet'])) 
{
    $uploads_dir ='../../dimg/firma/urun';
    @$tmp_name =$_FILES['urun_resim']["tmp_name"];
    @$name =$_FILES['urun_resim']["name"];
    $benzersizsayi1=rand(20000,32000);
    $benzersizsayi2=rand(20000,32000);
    $benzersizsayi3=rand(20000,32000);
    $benzersizsayi4=rand(20000,32000);
    $benzersizad=$benzersizsayi1.$benzersizsayi2.$benzersizsayi3.$benzersizsayi4;
    $refimgyol=substr($uploads_dir,3)."/".$benzersizad.$name;
    @move_uploaded_file($tmp_name,"$uploads_dir/$benzersizad$name");

$kaydet=$db->prepare("INSERT INTO urun SET
urun_ad=:ad,
urun_fiyat=:fiyat,
urun_bilgi=:bilgi,
urun_stok=:stok,
urun_sira=:sira,
urun_durum=:durum,
urun_resim=:resim,
firma_id=:firma_id
");
$insert=$kaydet->execute(array(

     'ad'=>$_POST['urun_ad'],
     'fiyat'=>$_POST['urun_fiyat'],
     'bilgi'=>$_POST['urun_bilgi'],
     'stok'=>$_POST['urun_stok'],
     'sira'=>$_POST['urun_sira'],
    'firma_id'=>$_SESSION['firma_id'],
     'durum'=>$_POST['urun_durum'],
     'resim'=>$refimgyol
     ));
if ($insert){
     Header("Location:../production/urun.php?durum=ok");
}else{
    Header("Location:../production/urun.php?durum=no");
    }
}

if ($_GET['urunsil']=="ok") {
    $sil=$db->prepare("DELETE from urun  where urun_id=:urun_id");
    $kontrol=$sil->execute(array(
        'urun_id' => $_GET['urun_id']
    ));
    if ($kontrol){
        Header("Location:../production/urun.php?durum=ok");
   }else{
       Header("Location:../production/urun.php?durum=no");
       }
   }

   if(isset($_POST['urunduzenle'])) 
{

        if ($_FILES['urun_resim']["size"] >0) {
           
            $uploads_dir ='../../dimg/firma/urun';
            @$tmp_name =$_FILES['urun_resim']["tmp_name"];
            @$name =$_FILES['urun_resim']["name"];
            $benzersizsayi1=rand(20000,32000);
            $benzersizsayi2=rand(20000,32000);
            $benzersizsayi3=rand(20000,32000);
            $benzersizsayi4=rand(20000,32000);
            $benzersizad=$benzersizsayi1.$benzersizsayi2.$benzersizsayi3.$benzersizsayi4;
            $refimgyol=substr($uploads_dir,3)."/".$benzersizad.$name;
            @move_uploaded_file($tmp_name,"$uploads_dir/$benzersizad$name");

            $duzenle=$db->prepare("UPDATE urun SET
            urun_ad=:ad,
            urun_fiyat=:fiyat,
            urun_bilgi=:bilgi,
            urun_stok=:stok,
            urun_sira=:sira,
            urun_durum=:durum,
            urun_resim=:resim
            WHERE urun_id={$_POST['urun_id']}");
            $update=$duzenle->execute(array(
            
                 'ad'=>$_POST['urun_ad'],
                 'fiyat'=>$_POST['urun_fiyat'],
                 'bilgi'=>$_POST['urun_bilgi'],
                 'stok'=>$_POST['urun_stok'],
                 'sira'=>$_POST['urun_sira'],
                 'durum'=>$_POST['urun_durum'],
                 'resim'=>$refimgyol
             ));
            
             $urun_id=$_POST['urun_id'];
            if ($update){
                $resimisilunlink=$_POST['urun_resim'];
                unlink("../$resimisilunlink");
                 Header("Location:../production/urun-duzenle.php?urun_id=$urun_id&durum=ok");
            }else{
                Header("Location:../production/urun-duzenle.php?durum=no");
                }

  }else{
    $duzenle=$db->prepare("UPDATE urun SET
    urun_ad=:ad,
    urun_fiyat=:fiyat,
    urun_bilgi=:bilgi,
    urun_stok=:stok,
    urun_sira=:sira,
    urun_durum=:durum
    WHERE urun_id={$_POST['urun_id']}");
    $update=$duzenle->execute(array(
    
         'ad'=>$_POST['urun_ad'],
         'fiyat'=>$_POST['urun_fiyat'],
         'bilgi'=>$_POST['urun_bilgi'],
         'stok'=>$_POST['urun_stok'],
         'sira'=>$_POST['urun_sira'],
         'durum'=>$_POST['urun_durum']
     ));
    
     $urun_id=$_POST['urun_id'];
    if ($update){
         Header("Location:../production/urun-duzenle.php?urun_id=$urun_id&durum=ok");
    }else{
        Header("Location:../production/urun-duzenle.php?durum=no");
        }
  }
}


?>