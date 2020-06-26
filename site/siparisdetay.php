<?php include 'header.php' ;





$kullanıcisor=$db->prepare("SELECT * FROM kullanici where kullanici_mail=:kullanici_mail");

$kullanıcisor->execute(array(

'kullanici_mail' => $_SESSION['userkullanici_mail']

));

$kullanıcisor=$kullanıcisor->rowCount();



if ($kullanıcisor=="0") {

echo "Yetkisiz erişim";

}



?>



<div class="container">



<div class="clearfix"></div>

<div class="lines"></div>

</div>



<div class="container">

<div class="row">

<div class="col-md-12">

</div>

</div>

<div class="title-bg">

<div class="title">Sipariş Detay</div>

</div>



<div class="table-responsive">

<table class="table table-bordered chart">

<thead>

<tr>

			<th>Ürün Sıra</th>
		

			<th>Ürün ad</th>

			<th>Ürün Kodu</th>

			<th>Adet</th>
			<th>Firma</th>
			<th>Ürün Fiyat</th>

</tr>

</thead>

<tbody>





<?php

$siparis_id=$_GET['siparis_id'];

$kullanici_id=$kullanicicek['kullanici_id'];

$siparisdetaysor=$db->prepare("SELECT * FROM siparis where siparis_id=:siparis_id and kullanici_id=:kullanici_id");

$siparisdetaysor->execute(array(

'siparis_id' => $siparis_id,

'kullanici_id' => $kullanici_id

));



$siparisdetaycek=$siparisdetaysor->fetch(PDO::FETCH_ASSOC);



// echo $siparisdetaycek['siparis_id'];



$siparis_id=$siparisdetaycek['siparis_id'];



$urundetaysor=$db->prepare("SELECT * FROM siparis_detay where siparis_id=:siparis_id");

$urundetaysor->execute(array(

'siparis_id' => $siparis_id

));



while($sepetdetaycek=$urundetaysor->fetch(PDO::FETCH_ASSOC)) {

$say++;

$urun_id=$sepetdetaycek['urun_id'];

$urunsor=$db->prepare("SELECT * FROM urun where urun_id=:urun_id");

$urunsor->execute(array(

'urun_id' => $urun_id

));



$uruncek=$urunsor->fetch(PDO::FETCH_ASSOC);

@$toplam_fiyat+=$uruncek['urun_fiyat']*$sepetdetaycek['urun_adet'];



?>









<tr>

<td><?php echo $say-1 ?></td>

<td style="text-align: left"><?php echo $uruncek['urun_ad'] ?></td>

<td><?php echo $uruncek['urun_id'] ?></td>

<td><form><?php echo $sepetdetaycek['urun_adet'] ?></form></td>
<td><?php  $adcek = $db->query("select firma_ad from firma where firma_id=" . $sepetdetaycek['firma_id'])->fetch();
						echo $adcek['firma_ad']; ?></td>
<td><?php echo $uruncek['urun_fiyat'] ?></td>


</tr>

<?php }  ?>



</tbody>

</table>

</div>

<div class="row">

<div class="col-md-6">





</div>

<div class="col-md-3 col-md-offset-3">

<div class="subtotal-wrap">

<!--<div class="subtotal">

<<p>Toplam Fiyat : $26.00</p>

<p>Vat 17% : $54.00</p>

</div>-->

<div class="total">Toplam Fiyat : <span class="bigprice"><?php echo $toplam_fiyat ?> TL</span></div>

<div class="clearfix"></div>

<!-- <a href="" class="btn btn-default btn-yellow">Ödeme Sayfası</a> -->

</div>

<div class="clearfix"></div>

</div>

</div>





<div class="spacer"></div>

</div>



<?php include 'footer.php' ?>