<?php include 'header.php';
 include '../netting/baglan.php';

if (isset($_POST['arama'])) {

  $aranan=$_POST['aranan'];

  $firmasor=$db->prepare("select * from firma where firma_ad LIKE '%$aranan%' order by firma_durum DESC, firma_sira ASC limit 25");
  $firmasor->execute();
  $say=$firmasor->rowCount();
  

} else{
  $firmasor=$db->prepare("select * from firma order by firma_durum DESC, firma_sira ASC limit 25");
  $firmasor->execute();
  $say=$firmasor->rowCount();
 
}
?>
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Firma İşlemleri

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
                  <div align="left" class="col-md-6">
                    <h2>Firmalar <small>
                    <?php 
                    echo $say."   Kayıt Bulundu...";
                    

if (@$_GET['durum']=='ok') {?>


<b style="color:green"> İşlem Başarılı...</b>

<?php }elseif (@$_GET['durum']=='no'){?>

  <b style="color:red"> İşlem Yapılamadı...</b>


<?php } ?> </small>
                    </h2>
                    </div>
                    <div align="right" class="col-md-6">
                    <a href="firma-ekle.php"><button style="Width:150px; height:30px; " class="btn btn-danger btn-xs"><i class=" fa fa-plus" hidden="true"></i>Yeni Ekle</button></a>
                    </div>
                    
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                       <div class="table-responsive">
                      <table class="table table-striped jambo_table bulk_action">
                        <thead>
                          <tr class="headings">
                            <th>
                             
                            </th>
                            <th class="column-title">Firma Resim </th>
                            <th class="column-title""text-center">Firma Ad </th>
                            <th class="column-title""text-center">Firma Şifre </th>
                            <th class="column-title""text-center">Firma mail </th>
                            <th class="column-title""text-center">Firma Adres </th>
                            <th class="column-title""text-center">Firma Tel </th>
                            <th class="column-title""text-center">Firma sıra </th>
                            <th class="column-title""text-center">Firma Durum </th>
                 
                            <th width="80" class="column-title"> </th>
                            <th width="80" class="column-title"> </th>
                           
                          </tr>
                        </thead>

                        <tbody>

                        <?php
                           
                      

                        while($firmacek=$firmasor->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                          <tr>
                            <td class="a-center ">
                              
                            </td>
                            <td class=" "><img width="150"height="100" src="../<?php echo $firmacek['firma_resimyol']?>"></td>
                            <td class="text-center"><b><?php echo $firmacek['firma_ad']?></b></td>
                            <td class="text-center"><b><?php echo $firmacek['firma_sifre']?></b></td>
                            <td class="text-center"><b><?php echo $firmacek['firma_mail']?></b></td>
                            <td class="text-center"><b><?php echo $firmacek['firma_adres']?></b></td>
                            <td class="text-center"><b><?php echo $firmacek['firma_tel']?></b></td>
                            <td class="text-center"><b><?php echo $firmacek['firma_sira']?></b></td>
                            <td class="text-center"><b><?php
                            
                            if ($firmacek['firma_durum']=="1") {

                              echo "Açık";
                            }else {

                              echo "Kapalı";
                            }
                            
                            ?></b></td>


                            <td class="text-center"><a href="firma-duzenle.php?firma_id=<?php echo $firmacek['firma_id']?>"><button style="width:80px;" class="btn btn-primary btn-xs"> <i class=" fa fa-pencil" hidden="true"></i>Düzenle</button></td>

                            <td class="text-center"><a href="../netting/islem.php?firmasil=ok&firma_id=<?php echo $firmacek['firma_id']?>"><button style="width:80px;" class="btn btn-danger btn-xs"><i class=" fa fa-trash" hidden="true"></i>Sil</button></a> </td>
                           
                            </td>
                          </tr>

                        <?php  }  ?>
                        
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

 <?php include 'footer.php';?>
      