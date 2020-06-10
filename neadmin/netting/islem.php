<?php
ob_start();
session_start();
include 'baglan.php';
include '../production/fonksiyon.php';

if (isset($_POST['kullanicigiris'])) {

	echo $kullanici_mail=htmlspecialchars($_POST['kullanici_mail']); 
	echo $kullanici_password=md5($_POST['kullanici_password']); 

    $kullanicisor=$db->prepare("select * from kullanici where kullanici_mail=:mail and kullanici_yetki=:yetki
     and kullanici_password=:password and kullanici_durum=:durum");
	$kullanicisor->execute(array(
		'mail' => $kullanici_mail,
		'yetki' => 1,
		'password' => $kullanici_password,
		'durum' => 1
		));

	$say=$kullanicisor->rowCount();
	if ($say==1) {

		echo $_SESSION['userkullanici_mail']=$kullanici_mail;

		header("Location:../../site/");
		exit;
	} else {
	header("Location:../../site/?durum=basarisizgiris");

	}
}

if (isset($_POST['kullanicikaydet'])) {

	echo $kullanici_adsoyad=htmlspecialchars($_POST['kullanici_adsoyad']); echo "<br>";
	echo $kullanici_mail=htmlspecialchars($_POST['kullanici_mail']); echo "<br>";
    echo $kullanici_passwordtwo=htmlspecialchars($_POST['kullanici_tel']); echo "<br>";
	echo $kullanici_passwordone=trim($_POST['kullanici_passwordone']); echo "<br>";
    echo $kullanici_passwordtwo=trim($_POST['kullanici_passwordtwo']); echo "<br>";

	if ($kullanici_passwordone==$kullanici_passwordtwo) {

		if (strlen($kullanici_passwordone)>=6) {
// Başlangıç

			$kullanicisor=$db->prepare("select * from kullanici where kullanici_mail=:mail");
			$kullanicisor->execute(array(
				'mail' => $kullanici_mail
				));

			//dönen satır sayısını belirtir
			$say=$kullanicisor->rowCount();

			if ($say==0) {

				//md5 fonksiyonu şifreyi md5 şifreli hale getirir.
				$password=md5($kullanici_passwordone);

				$kullanici_yetki=1;

			//Kullanıcı kayıt işlemi yapılıyor...
				$kullanicikaydet=$db->prepare("INSERT INTO kullanici SET
					kullanici_adsoyad=:kullanici_adsoyad,
					kullanici_mail=:kullanici_mail,
					kullanici_password=:kullanici_password,
                    kullanici_tel=:tel,
					kullanici_yetki=:kullanici_yetki
					");
				$insert=$kullanicikaydet->execute(array(
					'kullanici_adsoyad' => $kullanici_adsoyad,
					'kullanici_mail' => $kullanici_mail,
                    'kullanici_password' => $password,
                    'tel' => $_POST['kullanici_tel'],
					'kullanici_yetki' => $kullanici_yetki
					));

				if ($insert) {
				header("Location:../../site/index.php?durum=loginbasarili");

				//Header("Location:../production/genel-ayarlar.php?durum=ok");

				} else {

					header("Location:../../site/register.php?durum=basarisiz");
				}

			} else {

				header("Location:../../site/register.php?durum=mukerrerkayit");

			}

		} else {

			header("Location:../../site/register.php?durum=eksiksifre");
		}

	} else {

		header("Location:../../site/register.php?durum=farklisifre");
	}
	
}
if(isset($_POST['loggin'])){

     $kullanici_mail=$_POST['kullanici_mail'];
     $kullanici_password=md5($_POST['kullanici_password']);

    if ($kullanici_mail && $kullanici_password) {

        $kullanicisor=$db->prepare("SELECT * FROM kullanici where kullanici_mail=:mail and kullanici_yetki=:yetki
        and kullanici_password=:password");
        $kullanicisor->execute(array(
          'mail' => $kullanici_mail,
          'yetki' =>5,
          'password' => $kullanici_password
        ));
      $say=$kullanicisor->rowCount();

      if ($say>0) {
        
        $_SESSION['kullanici_mail']=$kullanici_mail;

        header('location:../production/index.php');

      }else{
        header('location:../production/login.php?durum=no');
      }

        
    }
}


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
    echo $firma_sifre=md5($_POST['firma_sifre']); 
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

$firma_sifre=md5($_POST['firma_sifre']);
$kaydet=$db->prepare("INSERT INTO firma SET
firma_ad=:ad,
firma_sifre=:sifre,
firma_mail=:mail,
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
     'mail'=>$_POST['firma_mail'],
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
    echo $firma_sifre=md5($_POST['firma_sifre']); 
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
            firma_mail=:mail,
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
                 'mail'=>$_POST['firma_mail'],
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
    firma_mail=:mail,
    firma_adres=:adres,
    firma_tel=:tel,
    firma_sira=:sira,
    firma_link=:link,
    firma_durum=:durum
    WHERE firma_id={$_POST['firma_id']}");
    $update=$duzenle->execute(array(
    
         'ad'=>$_POST['firma_ad'],
         'sifre'=>$_POST['firma_sifre'],
         'mail'=>$_POST['firma_mail'],
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

if(isset($_POST['kullaniciprofilkaydet'])) 
{

    $kullanici_password=md5($_POST['kullanici_password']);
    
$ayarkaydet=$db->prepare("UPDATE kullanici SET
kullanici_adsoyad=:adsoyad,
kullanici_password=:password
WHERE kullanici_id={$_POST['kullanici_id']}");
$update=$ayarkaydet->execute(array(

     'adsoyad'=>$_POST['kullanici_adsoyad'],
     'password'=>$kullanici_password
 ));
if ($update){
     Header("Location:../production/kullanici-profil.php?durum=ok");
}else{
    Header("Location:../production/kullanici-profil.php?durum=no");
    }
}

if (isset($_POST['kullaniciduzenle'])) {

	$kullanici_id=$_POST['kullanici_id'];

	$ayarkaydet=$db->prepare("UPDATE kullanici SET
		kullanici_adsoyad=:kullanici_adsoyad,
		kullanici_durum=:kullanici_durum
		WHERE kullanici_id={$_POST['kullanici_id']}");

	$update=$ayarkaydet->execute(array(
		'kullanici_adsoyad' => $_POST['kullanici_adsoyad'],
		'kullanici_durum' => $_POST['kullanici_durum']
		));


	if ($update) {

		Header("Location:../production/kullanici-duzenle.php?kullanici_id=$kullanici_id&durum=ok");

	} else {

		Header("Location:../production/kullanici-duzenle.php?kullanici_id=$kullanici_id&durum=no");
	}

}


if ($_GET['kullanicisil']=="ok") {

	$sil=$db->prepare("DELETE from kullanici where kullanici_id=:id");
	$kontrol=$sil->execute(array(
		'id' => $_GET['kullanici_id']
		));


	if ($kontrol) {


		header("location:../production/kullanici.php?sil=ok");


	} else {

		header("location:../production/kullanici.php?sil=no");

	}


}



if (isset($_POST['menuduzenle'])) {

	$menu_id=$_POST['menu_id'];

	$menu_seourl=seo($_POST['menu_ad']);

	
	$ayarkaydet=$db->prepare("UPDATE menu SET
		menu_ad=:menu_ad,
		menu_detay=:menu_detay,
		menu_url=:menu_url,
		menu_sira=:menu_sira,
		menu_seourl=:menu_seourl,
		menu_durum=:menu_durum
		WHERE menu_id={$_POST['menu_id']}");

	$update=$ayarkaydet->execute(array(
		'menu_ad' => $_POST['menu_ad'],
		'menu_detay' => $_POST['menu_detay'],
		'menu_url' => $_POST['menu_url'],
		'menu_sira' => $_POST['menu_sira'],
		'menu_seourl' => $menu_seourl,
		'menu_durum' => $_POST['menu_durum']
		));


	if ($update) {

		Header("Location:../production/menu-duzenle.php?menu_id=$menu_id&durum=ok");

	} else {

		Header("Location:../production/menu-duzenle.php?menu_id=$menu_id&durum=no");
	}

}


if ($_GET['menusil']=="ok") {

	$sil=$db->prepare("DELETE from menu where menu_id=:id");
	$kontrol=$sil->execute(array(
		'id' => $_GET['menu_id']
		));


	if ($kontrol) {


		header("location:../production/menu.php?sil=ok");


	} else {

		header("location:../production/menu.php?sil=no");

	}


}


if (isset($_POST['menukaydet'])) {


	$menu_seourl=seo($_POST['menu_ad']);


	$ayarekle=$db->prepare("INSERT INTO menu SET
		menu_ad=:menu_ad,
		menu_detay=:menu_detay,
		menu_url=:menu_url,
		menu_sira=:menu_sira,
		menu_seourl=:menu_seourl,
		menu_durum=:menu_durum
		");

	$insert=$ayarekle->execute(array(
		'menu_ad' => $_POST['menu_ad'],
		'menu_detay' => $_POST['menu_detay'],
		'menu_url' => $_POST['menu_url'],
		'menu_sira' => $_POST['menu_sira'],
		'menu_seourl' => $menu_seourl,
		'menu_durum' => $_POST['menu_durum']
		));


	if ($insert) {

		Header("Location:../production/menu.php?durum=ok");

	} else {

		Header("Location:../production/menu.php?durum=no");
	}

}

if (isset($_POST['logoduzenle'])) {

	

	$uploads_dir = '../../dimg';

	@$tmp_name = $_FILES['ayar_logo']["tmp_name"];
	@$name = $_FILES['ayar_logo']["name"];

	$benzersizsayi4=rand(20000,32000);
	$refimgyol=substr($uploads_dir, 6)."/".$benzersizsayi4.$name;

	@move_uploaded_file($tmp_name, "$uploads_dir/$benzersizsayi4$name");

	
	$duzenle=$db->prepare("UPDATE ayar SET
		ayar_logo=:logo
		WHERE ayar_id=0");
	$update=$duzenle->execute(array(
		'logo' => $refimgyol
		));



	if ($update) {

		$resimsilunlink=$_POST['eski_yol'];
		unlink("../../$resimsilunlink");

		Header("Location:../production/genel-ayar.php?durum=ok");

	} else {

		Header("Location:../production/genel-ayar.php?durum=no");
	}

}

if (isset($_POST['yorumkaydet'])) {


	$gelen_url=$_POST['gelen_url'];

	$ayarekle=$db->prepare("INSERT INTO yorumlar SET
		yorum_detay=:yorum_detay,
		kullanici_id=:kullanici_id,
		urun_id=:urun_id	
		
		");

	$insert=$ayarekle->execute(array(
		'yorum_detay' => $_POST['yorum_detay'],
		'kullanici_id' => $_POST['kullanici_id'],
		'urun_id' => $_POST['urun_id']
		
		));


	if ($insert) {

		Header("Location:$gelen_url?durum=ok");

	} else {

		Header("Location:$gelen_url?durum=no");
	}

}

if (isset($_POST['sepetekle'])) {


	$ayarekle=$db->prepare("INSERT INTO sepet SET
		urun_adet=:urun_adet,
		kullanici_id=:kullanici_id,
     
		urun_id=:urun_id	
		
		");

	$insert=$ayarekle->execute(array(
		'urun_adet' => $_POST['urun_adet'],
        'kullanici_id' => $_POST['kullanici_id'],
       
		'urun_id' => $_POST['urun_id']
		
		));


	if ($insert) {

		Header("Location:../../site/sepet.php?durum=ok");

	} else {

		Header("Location:../../site/sepet.php?durum=no");
	}

}

if ($_GET['yorumsil']=="ok") {
	
	$sil=$db->prepare("DELETE from yorumlar where yorum_id=:yorum_id");
	$kontrol=$sil->execute(array(
		'yorum_id' => $_GET['yorum_id']
		));

	if ($kontrol) {

		
		Header("Location:../production/yorum.php?durum=ok");

	} else {

		Header("Location:../production/yorum.php?durum=no");
	}

}
if (isset($_POST['bankaekle'])) {

	$kaydet=$db->prepare("INSERT INTO banka SET
		banka_ad=:ad,
		banka_durum=:banka_durum,	
		banka_hesapadsoyad=:banka_hesapadsoyad,
		banka_iban=:banka_iban
		");
	$insert=$kaydet->execute(array(
		'ad' => $_POST['banka_ad'],
		'banka_durum' => $_POST['banka_durum'],
		'banka_hesapadsoyad' => $_POST['banka_hesapadsoyad'],
		'banka_iban' => $_POST['banka_iban']		
		));

	if ($insert) {

		Header("Location:../production/banka.php?durum=ok");

	} else {

		Header("Location:../production/banka.php?durum=no");
	}

}


if (isset($_POST['bankaduzenle'])) {

	$banka_id=$_POST['banka_id'];

	$kaydet=$db->prepare("UPDATE banka SET

		banka_ad=:ad,
		banka_durum=:banka_durum,	
		banka_hesapadsoyad=:banka_hesapadsoyad,
		banka_iban=:banka_iban
		WHERE banka_id={$_POST['banka_id']}");
	$update=$kaydet->execute(array(
		'ad' => $_POST['banka_ad'],
		'banka_durum' => $_POST['banka_durum'],
		'banka_hesapadsoyad' => $_POST['banka_hesapadsoyad'],
		'banka_iban' => $_POST['banka_iban']		
		));

	if ($update) {

		Header("Location:../production/banka-duzenle.php?banka_id=$banka_id&durum=ok");

	} else {

		Header("Location:../production/banka-duzenle.php?banka_id=$banka_id&durum=no");
	}


	

}


if ($_GET['bankasil']=="ok") {
	
	$sil=$db->prepare("DELETE from banka where banka_id=:banka_id");
	$kontrol=$sil->execute(array(
		'banka_id' => $_GET['banka_id']
		));

	if ($kontrol) {

		
		Header("Location:../production/banka.php?durum=ok");

	} else {

		Header("Location:../production/banka.php?durum=no");
	}

}
if ($_GET['sepetsil']=="ok") {

	$sil=$db->prepare("DELETE from sepet where sepet_id=:id");
	$kontrol=$sil->execute(array(
		'id' => $_GET['sepet_id']
		));


	if ($kontrol) {


		header("location:../../site/sepet.php?sil=ok");


	} else {

		header("location:../../site/sepet.php?sil=no");

	}


}
if (isset($_POST['kullanicibilgiguncelle'])) {

	$kullanici_id=$_POST['kullanici_id'];

	$ayarkaydet=$db->prepare("UPDATE kullanici SET
		kullanici_adsoyad=:kullanici_adsoyad,
		kullanici_tel=:kullanici_tel,
		kullanici_mail=:kullanici_mail
		WHERE kullanici_id={$_POST['kullanici_id']}");

	$update=$ayarkaydet->execute(array(
		'kullanici_adsoyad' => $_POST['kullanici_adsoyad'],
		'kullanici_tel' => $_POST['kullanici_tel'],
		'kullanici_mail' => $_POST['kullanici_mail']
		));


	if ($update) {

		Header("Location:../../site/hesabim.php?durum=ok");

	} else {

		Header("Location:../../site/hesabim?durum=no");
	}

}


if (isset($_POST['kullanicisifreguncelle'])) {

	echo $kullanici_eskipassword=trim($_POST['kullanici_eskipassword']); echo "<br>";
	echo $kullanici_passwordone=trim($_POST['kullanici_passwordone']); echo "<br>";
	echo $kullanici_passwordtwo=trim($_POST['kullanici_passwordtwo']); echo "<br>";

	$kullanici_password=md5($kullanici_eskipassword);


	$kullanicisor=$db->prepare("select * from kullanici where kullanici_password=:password");
	$kullanicisor->execute(array(
		'password' => $kullanici_password
		));

			//dönen satır sayısını belirtir
	$say=$kullanicisor->rowCount();



	if ($say==0) {

		header("Location:../../site/sifre-guncelle?durum=eskisifrehata");



	} else {



	//eski şifre doğruysa başla


		if ($kullanici_passwordone==$kullanici_passwordtwo) {


			if (strlen($kullanici_passwordone)>=6) {


				//md5 fonksiyonu şifreyi md5 şifreli hale getirir.
				$password=md5($kullanici_passwordone);

				$kullanici_yetki=1;

				$kullanicikaydet=$db->prepare("UPDATE kullanici SET
					kullanici_password=:kullanici_password
					WHERE kullanici_id={$_POST['kullanici_id']}");

				
				$insert=$kullanicikaydet->execute(array(
					'kullanici_password' => $password
					));

				if ($insert) {


					header("Location:../../site/sifre-guncelle.php?durum=sifredegisti");


				//Header("Location:../production/genel-ayarlar.php?durum=ok");

				} else {


					header("Location:../../site/sifre-guncelle.php?durum=no");
				}





		// Bitiş



			} else {


				header("Location:../../site/sifre-guncelle.php?durum=eksiksifre");


			}



		} else {

			header("Location:../../site/sifre-guncelle?durum=sifreleruyusmuyor");

			exit;


		}


	}

	exit;

	if ($update) {

		header("Location:../../site/sifre-guncelle?durum=ok");

	} else {

		header("Location:../../site/sifre-guncelle?durum=no");
	}

}
if (isset($_POST['bankasiparisekle'])) {


	$siparis_tip="Banka Havalesi";


	$kaydet=$db->prepare("INSERT INTO siparis SET
		kullanici_id=:kullanici_id,
		firma_id=:firma_id,
		urun_id=:urun_id,
		siparis_tip=:siparis_tip,	
		siparis_banka=:siparis_banka,
		siparis_toplam=:siparis_toplam
		");
	$insert=$kaydet->execute(array(
		'kullanici_id' => $_POST['kullanici_id'],
		'firma_id' => $_POST['firma_id'],
		'urun_id' => $_POST['urun_id'],
		'siparis_tip' => $siparis_tip,
		'siparis_banka' => $_POST['siparis_banka'],
		'siparis_toplam' => $_POST['siparis_toplam']		
		));
		if ($insert) {

			//Sipariş başarılı kaydedilirse...
	
			echo $siparis_id = $db->lastInsertId();
	
			echo "<hr>";
	
	
			$kullanici_id=$_POST['kullanici_id'];
			$sepetsor=$db->prepare("SELECT * FROM sepet where kullanici_id=:id");
			$sepetsor->execute(array(
				'id' => $kullanici_id
				));
	
			while($sepetcek=$sepetsor->fetch(PDO::FETCH_ASSOC)) {
	
				$urun_id=$sepetcek['urun_id']; 
				$urun_adet=$sepetcek['urun_adet'];
	
				$urunsor=$db->prepare("SELECT * FROM urun where urun_id=:id");
				$urunsor->execute(array(
					'id' => $urun_id
					));
	
				$uruncek=$urunsor->fetch(PDO::FETCH_ASSOC);
				
				echo $urun_fiyat=$uruncek['urun_fiyat'];
	
	
				
				$kaydet=$db->prepare("INSERT INTO siparis_detay SET
					
					siparis_id=:siparis_id,
					urun_id=:urun_id,	
					urun_fiyat=:urun_fiyat,
					urun_adet=:urun_adet
					");
				$insert=$kaydet->execute(array(
					'siparis_id' => $siparis_id,
					'urun_id' => $urun_id,
					'urun_fiyat' => $urun_fiyat,
					'urun_adet' => $urun_adet
	
					));
	
	
			}
	
			if ($insert) {
	
				
	
				//Sipariş detay kayıtta başarıysa sepeti boşalt
	
				$sil=$db->prepare("DELETE from sepet where kullanici_id=:kullanici_id");
				$kontrol=$sil->execute(array(
					'kullanici_id' => $kullanici_id
					));
	
				
				Header("Location:../../site/siparislerim.php?durum=ok");
				exit;
	
	
			}
	
			
	
	
	
	
		} else {
	
			echo "başarısız";
	
			//Header("Location:../production/siparis.php?durum=no");
		}
	
	
	
	}


?>


