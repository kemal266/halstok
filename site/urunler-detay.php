
<?php include 'header.php';


$urunsor=$db->prepare("SELECT * FROM urun where urun_id=:urun_id");
$urunsor->execute(array(
	'urun_id' => $_GET['urun_id']
	));
	

$uruncek=$urunsor->fetch(PDO::FETCH_ASSOC);
$say=$urunsor->rowCount();

if ($say==0) {
	
	header("Location:index.php?durum=oynasma");
	exit;
}

?>
	<div class="container">
	
	<div class="clearfix"></div>
	<div class="lines"></div>
</div>

<div class="container">
	<div class="row">

	</div>
		<div class="row">
			<div class="col-md-9"><!--Main content-->
				<div class="title-bg">
					<div class="title"><?php echo $uruncek['urun_ad']?></div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="dt-img">
							<div class="detpricetag"><div class="inner"><?php echo $uruncek['urun_fiyat']?></div></div>
							<a class="fancybox" href="<?php echo $uruncek['urun_resim']?>" data-fancybox-group="gallery" title="Cras neque mi, semper leon"><img src="<?php echo $uruncek['urun_resim']?>" alt="" class="img-responsive"></a>
						</div>
						<div class="thumb-img">
							<a class="fancybox" href="images\sample-4.jpg" data-fancybox-group="gallery" title="Cras neque mi, semper leon"><img src="images\sample-4.jpg" alt="" class="img-responsive"></a>
						</div>
						<div class="thumb-img">
							<a class="fancybox" href="images\sample-5.jpg" data-fancybox-group="gallery" title="Cras neque mi, semper leon"><img src="images\sample-5.jpg" alt="" class="img-responsive"></a>
						</div>
						<div class="thumb-img">
							<a class="fancybox" href="images\sample-1.jpg" data-fancybox-group="gallery" title="Cras neque mi, semper leon"><img src="images\sample-1.jpg" alt="" class="img-responsive"></a>
						</div>
					</div>
					<div class="col-md-6 det-desc">
					<div class="productdata">
						<div class="infospan">Ürün Kodu <span><?php echo $uruncek['urun_id']; ?></span></div>
						<div class="infospan">Ürün Fiyat <span><?php echo $uruncek['urun_fiyat']; ?></span></div>




						<div class="clearfix"></div>
						<hr>


						<form action="../neadmin/netting/islem.php" method="POST">

						<div class="form-group">
							<label for="qty" class="col-sm-2 control-label">Miktar</label>
							<div class="col-sm-4">
								<input type="text" class="form-control" value="1" name="urun_adet">
							</div>
							<input type="hidden" name="kullanici_id" value="<?php echo $kullanicicek['kullanici_id'] ?>">

							<input type="hidden" name="urun_id" value="<?php echo $uruncek['urun_id'] ?>">
									<div class="col-sm-4">

										<?php if (isset($_SESSION['userkullanici_mail'])) {?>

										<button type="submit" name="sepetekle" class="btn btn-default btn-red btn-sm"><span class="addchart">Sepete Ekle</span></button>


										<?php  } else { ?>

										<button type="submit" name="sepetekle" disabled class="btn btn-default btn-red btn-sm"><span class="addchart">Giriş Yapın</span></button>

										<?php } ?>




									</div>
							<div class="clearfix"></div>
						</div>

						</form>

							<div class="sharing">
							<div class="share-bt">
								<div class="addthis_toolbox addthis_default_style ">
									<a class="addthis_counter addthis_pill_style"></a>
								</div>
								
								<div class="clearfix"></div>
							</div>


							<div  class="avatock"><span>

								<?php if ($uruncek['urun_stok']>=1) {

									echo "Stok Adeti : ".$uruncek['urun_stok'];
								} else {

									echo "Ürün Kalmadı";
								} ?>

							</span></div>
							
						</div>



					</div>
				</div>
			</div>

			<div class="tab-review">
				<ul id="myTab" class="nav nav-tabs shop-tab">
					
					<li class="active"
						><a href="#desc" data-toggle="tab">Açıklama</a></li>
						<li 

						
						class="active"
					

						<?php 
						$kullanici_id=$kullanicicek['kullanici_id'];
						$urun_id=$uruncek['urun_id'];

						$yorumsor=$db->prepare("SELECT * FROM yorumlar where urun_id=:urun_id");
						$yorumsor->execute(array(
							'urun_id' => $urun_id
							));


							?>
							><a href="#rev" data-toggle="tab">Yorumlar (<?php echo $yorumsor->rowCount(); ?>)</a></li>
							<li class=""><a href="#video" data-toggle="tab">Ürün Video</a></li>
						</ul>




						<div id="myTabContent" class="tab-content shop-tab-ct">
							<div class="tab-pane fade 
								active in
						" id="desc">
								<p>
									<?php echo $uruncek['urun_bilgi'] ?>
								</p>
							</div>


							<div class="tab-pane fade <?php if ($_GET['durum']=="ok") {?>
								active in
								<?php } ?>" id="rev">


								<?php 




								while($yorumcek=$yorumsor->fetch(PDO::FETCH_ASSOC)) {

									$ykullanici_id=$yorumcek['kullanici_id'];

									$ykullanicisor=$db->prepare("SELECT * FROM kullanici where kullanici_id=:id");
									$ykullanicisor->execute(array(
										'id' => $ykullanici_id
										));

									$ykullanicicek=$ykullanicisor->fetch(PDO::FETCH_ASSOC);
									?>



									<!-- Yorumları Dökeceğiz -->
									<p class="dash">
										<span><?php echo $ykullanicicek['kullanici_adsoyad'] ?></span> (<?php echo $yorumcek['yorum_zaman'] ?>)<br><br>
										<?php echo $yorumcek['yorum_detay'] ?>
									</p>

									<!-- Yorumları Dökeceğiz -->

									<?php } ?>

							<h4>Yorum Yazın</h4>

									<?php if (isset($_SESSION['userkullanici_mail'])) {?>

									<form action="../neadmin/netting/islem.php" method="POST" role="form">




										<div class="form-group">
											<textarea name="yorum_detay" class="form-control" placeholder="Lütfen yorumunuzu buraya yazınız..." id="text"></textarea>
										</div>

										<input type="hidden" name="kullanici_id" value="<?php echo $kullanicicek['kullanici_id'] ?>">

										<input type="hidden" name="urun_id" value="<?php echo $uruncek['urun_id'] ?>">

										<input type="hidden" name="gelen_url" value="<?php 
										echo "http://".$_SERVER['HTTP_HOST']."".$_SERVER['REQUEST_URI'].""; 

										?>">

										

										<button type="submit" name="yorumkaydet" class="btn btn-default btn-red btn-sm">Yorumu Gönder</button>
									</form>

									<?php } else {?>

									Yorum yazabilmek için <a style="color:red" href="register">kayıt</a> olmalı yada üyemizseniz giriş yapmalısınız...

									<?php } ?>



								</div>
					</div>
				</div>
				
				<div id="title-bg">
							<div class="title">Benzer Ürünler</div>
						</div>
						<div class="row prdct"><!--Products-->


							<?php 

							$firma_id=$uruncek['firma_id'];

							$urunaltsor=$db->prepare("SELECT * FROM urun where firma_id=:firma_id order by  rand() limit 3");
							$urunaltsor->execute(array(
								'firma_id' => $firma_id
								));

							while($urunaltcek=$urunaltsor->fetch(PDO::FETCH_ASSOC)) {

								?>

								<div class="col-md-4">
									<div class="productwrap">
										<div class="pr-img">
											<div class="hot"></div>
											<a href="urun-<?=seo($urunaltcek["urun_ad"]).'-'.$urunaltcek["urun_id"]?>"><img src="<?php echo $urunaltcek['urun_resim']?>" alt="" class="img-responsive"></a>
											<div class="pricetag on-sale"><div class="inner on-sale"><span class="onsale"><span class="oldprice"><?php echo $urunaltcek['urun_fiyat']*1.50 ?> TL</span><?php echo $urunaltcek['urun_fiyat'] ?> TL</span></div></div>
										</div>
										<span class="smalltitle"><a href="product.htm"><?php echo $urunaltcek['urun_ad'] ?></a></span>
										<span class="smalldesc">Ürün Kodu.: <?php echo $urunaltcek['urun_id'] ?></span>
									</div>
								</div>

								<?php } ?>


							</div><!--Products-->
							<div class="spacer"></div>
						</div><!--Main content-->>
        <?php  include 'sidebar.php'?>
    </div>
   

    </div>
    </div>
    <?php include 'footer.php';?>