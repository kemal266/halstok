<?php 

include 'header.php'; 

//Belirli veriyi seçme işlemi



?>

<div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Siparişler Detay

                </h3>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                <form action="" method="POST">
                  <div class="input-group">
                    <input type="text" class="form-control"name="aranan" placeholder="Anahtar Kelimeler...">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="submit" name="arama">Ara!</button>
                    </span>
                  </div>
                  </form>
                </div>
              </div>
            </div>


    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Siparişler<small>,

              <?php 

              if (@$_GET['durum']=="ok") {?>

              <b style="color:green;">İşlem Başarılı...</b>

              <?php } elseif (@$_GET['durum']=="no") {?>

              <b style="color:red;">İşlem Başarısız...</b>

              <?php }

              ?>


            </small></h2>
         
            <div class="clearfix"></div>
          </div>
          <div class="x_content">


            <!-- Div İçerik Başlangıç -->

            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
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



$siparisdetaysor=$db->prepare("SELECT * FROM siparis where siparis_id=:siparis_id");

$siparisdetaysor->execute(array(

'siparis_id' => $siparis_id,



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

            <!-- Div İçerik Bitişi -->


          </div>
        </div>
      </div>
    </div>




  </div>
</div>
<!-- /page content -->

<?php include 'footer.php'; ?>
