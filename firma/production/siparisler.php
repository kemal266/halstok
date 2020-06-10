<?php 

include 'header.php'; 

//Belirli veriyi seçme işlemi
$siparissor=$db->prepare("SELECT * FROM siparis ");
$siparissor->execute();


?>

<div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Siparişler

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
                  <th>Sipariş No</th>
                  <th>Sipariş Zaman</th>
                  <th>Sipariş Toplam</th>
                  <th>Sipariş Tip</th>
                  <th>Banka</th>
                  <th>Kullanıcı Adı</th>
                 
                </tr>
              </thead>

              <tbody>

                <?php 
                

                while($sipariscek=$siparissor->fetch(PDO::FETCH_ASSOC)) {
          
                  ?>


                <tr>
                  <td><?php echo $sipariscek['siparis_id'] ?></td>
                  <td><?php echo $sipariscek['siparis_zaman'] ?></td>
                  <td><?php echo $sipariscek['siparis_toplam'] ?></td>
                  <td><?php echo $sipariscek['siparis_tip'] ?></td>
                  <td><?php echo $sipariscek['siparis_banka'] ?></td>
                  <td><?php
                  $adcek = $db->query("select kullanici_adsoyad from kullanici where kullanici_id=" . $sipariscek['kullanici_id'])->fetch();
					      	echo $adcek['kullanici_adsoyad']; ?></td>

               
                </tr>



                <?php  }

                ?>


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
