<?php
ob_start();
include 'baglan.php';

if(isset($_POST['genelayarkaydet'])) 
{
$ayarkaydet=$db->prepare("UPDATE ayar SET
ayar_siteurl=:siteurl,
ayar_title=:title,
ayar_description=:description,
ayar_keywords=:keywords,
ayar_author=:author
WHERE ayar_id=0");
$update=$ayarkaydet->execute(array(

     'siteurl'=>$_POST['ayar_siteurl'],
     'title'=>$_POST['ayar_title'],
     'description'=>$_POST['ayar_description'],
     'keywords'=>$_POST['ayar_keywords'],
     'author'=>$_POST['ayar_author']
 ));
if ($update){
     Header("Location:../production/genel-ayar.php?durum=ok");
}else{
    Header("Location:../production/genel-ayar.php?durum=no");
    }
}

if(isset($_POST['iletisimayarkaydet'])) 
{
$ayarkaydet=$db->prepare("UPDATE ayar SET
ayar_tel=:tel,
ayar_gsm=:gsm,
ayar_faks=:faks,
ayar_mail=:mail,
ayar_adres=:adres,
ayar_ilce=:ilce,
ayar_il=:il

WHERE ayar_id=0");
$update=$ayarkaydet->execute(array(

     'tel'=>$_POST['ayar_tel'],
     'gsm'=>$_POST['ayar_gsm'],
     'faks'=>$_POST['ayar_faks'],
     'mail'=>$_POST['ayar_mail'],
     'adres'=>$_POST['ayar_adres'],
     'ilce'=>$_POST['ayar_ilce'],
     'il'=>$_POST['ayar_il']
 ));

if ($update){
    Header("Location:../production/iletisim-ayar.php?durum=ok");
}else{
     Header("Location:../production/iletisim-ayar.php?durum=no");
    }
}

if(isset($_POST['apiayarkaydet'])) 
{
$ayarkaydet=$db->prepare("UPDATE ayar SET
ayar_recapctha=:recapctha,
ayar_goooglemap=:goooglemap,
ayar_analystic=:analystic

WHERE ayar_id=0");
$update=$ayarkaydet->execute(array(

     'recapctha'=>$_POST['ayar_recapctha'],
     'goooglemap'=>$_POST['ayar_goooglemap'],
     'analystic'=>$_POST['ayar_analystic']

 ));
if ($update){
     Header("Location:../production/api-ayar.php?durum=ok");
}else{
    Header("Location:../production/api-ayar.php?durum=no");
    }
}

if(isset($_POST['sosyelayarkaydet'])) 
{
$ayarkaydet=$db->prepare("UPDATE ayar SET
ayar_facebook=:facebook,
ayar_twitter=:twitter,
ayar_youtube=:youtube,
ayar_google=:google

WHERE ayar_id=0");
$update=$ayarkaydet->execute(array(

     'facebook'=>$_POST['ayar_facebook'],
     'twitter'=>$_POST['ayar_twitter'],
     'youtube'=>$_POST['ayar_youtube'],
     'google'=>$_POST['ayar_google']

 ));
if ($update){
     Header("Location:../production/sosyalmedya-ayar.php?durum=ok");
}else{
    Header("Location:../production/sosyalmedya-ayar.php?durum=no");
    }
}

if(isset($_POST['mailayarkaydet'])) 
{
$ayarkaydet=$db->prepare("UPDATE ayar SET
ayar_smtphost=:smtphost,
ayar_smtpuser=:smtpuser,
ayar_smtppassword=:smtppassword,
ayar_smtpport=:smtpport

WHERE ayar_id=0");
$update=$ayarkaydet->execute(array(

     'smtphost'=>$_POST['ayar_smtphost'],
     'smtpuser'=>$_POST['ayar_smtpuser'],
     'smtppassword'=>$_POST['ayar_smtppassword'],
     'smtpport'=>$_POST['ayar_smtpport']

 ));
if ($update){
     Header("Location:../production/mail-ayar.php?durum=ok");
}else{
    Header("Location:../production/mail-ayar.php?durum=no");
    }
}

if(isset($_POST['hakkimizdakaydet'])) 
{
$ayarkaydet=$db->prepare("UPDATE hakkimizda SET
hakkimizda_baslik=:baslik,
hakkimizda_icerik=:icerik,
hakkimizda_vizyon=:vizyon,
hakkimizda_misyon=:misyon

WHERE hakkimizda_id=0");
$update=$ayarkaydet->execute(array(

     'baslik'=>$_POST['hakkimizda_baslik'],
     'icerik'=>$_POST['hakkimizda_icerik'],
     'vizyon'=>$_POST['hakkimizda_vizyon'],
     'misyon'=>$_POST['hakkimizda_misyon']

 ));
if ($update){
     Header("Location:../production/hakkimizda.php?durum=ok");
}else{
    Header("Location:../production/hakkimizda.php?durum=no");
    }
}


if(isset($_POST['firmakaydet'])) 
{
    $uploads_dir ='../../dimg/firma';
    @$tmp_name =$_FILES['firma_resimyol']["tmp_name"];
    @$name =$_FILES['firma_resimyol']["name"];
    $benzersizsayi1=rand(20000,32000);
    $benzersizsayi2=rand(20000,32000);
    $benzersizsayi3=rand(20000,32000);
    $benzersizsayi4=rand(20000,32000);
    $benzersizad=$benzersizsayi1.$benzersizsayi2.$benzersizsayi3.$benzersizsayi4;
    $refimgyol=substr($uploads_dir,3)."/".$benzersizad.$name;
    @move_uploaded_file($tmp_name,"$uploads_dir/$benzersizad$name");

$kaydet=$db->prepare("INSERT INTO firma SET
firma_ad=:ad,
firma_sifre=:sifre,
firma_adres=:adres,
firma_tel=:tel,
firma_sira=:sira,
firma_link=:link,
firma_durum=:durum,
firma_resimyol=:resimyol
");
$insert=$kaydet->execute(array(

     'ad'=>$_POST['firma_ad'],
     'sifre'=>$_POST['firma_sifre'],
     'adres'=>$_POST['firma_adres'],
     'tel'=>$_POST['firma_tel'],
     'sira'=>$_POST['firma_sira'],
     'link'=>$_POST['firma_link'],
     'durum'=>$_POST['firma_durum'],
     'resimyol'=>$refimgyol
     ));
if ($insert){
     Header("Location:../production/firmalar.php?durum=ok");
}else{
    Header("Location:../production/firmalar.php?durum=no");
    }
}

if ($_GET['firmasil']=="ok") {
    $sil=$db->prepare("DELETE from firma  where firma_id=:firma_id");
    $kontrol=$sil->execute(array(
        'firma_id' => $_GET['firma_id']
    ));
    if ($kontrol){
        Header("Location:../production/firmalar.php?durum=ok");
   }else{
       Header("Location:../production/firmalar.php?durum=no");
       }
   }

   if(isset($_POST['firmaduzenle'])) 
{

        if ($_FILES['firma_resimyol']["size"] >0) {
           
            $uploads_dir ='../../dimg/firma';
            @$tmp_name =$_FILES['firma_resimyol']["tmp_name"];
            @$name =$_FILES['firma_resimyol']["name"];
            $benzersizsayi1=rand(20000,32000);
            $benzersizsayi2=rand(20000,32000);
            $benzersizsayi3=rand(20000,32000);
            $benzersizsayi4=rand(20000,32000);
            $benzersizad=$benzersizsayi1.$benzersizsayi2.$benzersizsayi3.$benzersizsayi4;
            $refimgyol=substr($uploads_dir,3)."/".$benzersizad.$name;
            @move_uploaded_file($tmp_name,"$uploads_dir/$benzersizad$name");

            $duzenle=$db->prepare("UPDATE firma SET
            firma_ad=:ad,
            firma_sifre=:sifre,
            firma_adres=:adres,
            firma_tel=:tel,
            firma_sira=:sira,
            firma_link=:link,
            firma_durum=:durum,
            firma_resimyol=:resimyol
            WHERE firma_id={$_POST['firma_id']}");
            $update=$duzenle->execute(array(
            
                 'ad'=>$_POST['firma_ad'],
                 'sifre'=>$_POST['firma_sifre'],
                 'adres'=>$_POST['firma_adres'],
                 'tel'=>$_POST['firma_tel'],
                 'sira'=>$_POST['firma_sira'],
                 'link'=>$_POST['firma_link'],
                 'durum'=>$_POST['firma_durum'],
                 'resimyol'=>$refimgyol
             ));
            
             $firma_id=$_POST['firma_id'];
            if ($update){
                $resimisilunlink=$_POST['firma_resimyol'];
                unlink("../$resimisilunlink");
                 Header("Location:../production/firma-duzenle.php?firma_id=$firma_id&durum=ok");
            }else{
                Header("Location:../production/firma-duzenle.php?durum=no");
                }

  }else{
    $duzenle=$db->prepare("UPDATE firma SET
    firma_ad=:ad,
    firma_sifre=:sifre,
    firma_adres=:adres,
    firma_tel=:tel,
    firma_sira=:sira,
    firma_link=:link,
    firma_durum=:durum
    WHERE firma_id={$_POST['firma_id']}");
    $update=$duzenle->execute(array(
    
         'ad'=>$_POST['firma_ad'],
         'sifre'=>$_POST['firma_sifre'],
         'adres'=>$_POST['firma_adres'],
         'tel'=>$_POST['firma_tel'],
         'sira'=>$_POST['firma_sira'],
         'link'=>$_POST['firma_link'],
         'durum'=>$_POST['firma_durum']
     ));
    
     $firma_id=$_POST['firma_id'];
    if ($update){
         Header("Location:../production/firma-duzenle.php?firma_id=$firma_id&durum=ok");
    }else{
        Header("Location:../production/firma-duzenle.php?durum=no");
        }
  }
}


?>