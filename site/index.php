<?php include 'header.php';


?>
	<div class="container">

	
		<div class="clearfix"></div>
		<div class="lines"></div>
		<div class="main-slide">
			<div id="sync1" class="owl-carousel">
				<div class="item">
					<div class="slide-desc">
						<div class="inner">
							<h1></h1>
							<p>
								
							</p>
							
						</div>
						
					</div>
					<div class="slide-type-1">
						<img src="images\firma1.jpg" alt="" class="img-responsive">
					</div>
				</div>
				<div class="item">
					<div class="slide-desc">
						<div class="inner">
							<h1></h1>
							<p>
							</p>
						
						</div>
						<div class="inner">
							<div class="pro-pricetag big-deal">
								<div class="inner">
									
								</div>
							</div>
						</div>
					</div>
					<div class="slide-type-1">
						<img src="images\firma1.jpg" alt="" class="img-responsive">
					</div>
				</div>
				<div class="item">
					<div class="slide-desc">
						<div class="inner">
							<h1></h1>
							<p>
							</p>
							<button class="btn btn-default btn-red btn-lg"></button>
						</div>
						<div class="inner">
							<div class="pro-pricetag big-deal">
								<div class="inner">
										<span class="oldprice"></span>
										<span></span>
										<span class="ondeal"></span>
								</div>
							</div>
						</div>
					</div>
					<div class="slide-type-1">
						<img src="images\firma1.jpg" alt="" class="img-responsive">
					</div>
				</div>
				<div class="item">
					<div class="slide-desc">
						<div class="inner">
							<h1></h1>
							<p>
							</p>
							<button class="btn btn-default btn-red btn-lg"></button>
						</div>
						<div class="inner">
							<div class="pro-pricetag big-deal">
								<div class="inner">
										<span class="oldprice"></span>
										<span></span>
										<span class="ondeal"></span>
								</div>
							</div>
						</div>
					</div>
					<div class="slide-type-1">
						<img src="images\firma1.jpg" alt="" class="img-responsive">
					</div>
				</div>
				<div class="item">
					<div class="slide-desc">
						<div class="inner">
							<h1></h1>
							<p>
							
							</p>
						
						</div>
		

					<div class="slide-type-1">
						<img src="images\firma1.jpg" alt="" class="img-responsive">
					</div>
				</div>
				
			</div>
		</div>
		<br>
	<div class="f-widget featpro">
		<div class="container">
			<div class="title-widget-bg">
				<div class="title-widget">Çok Satan Ürünler</div>
				<div class="carousel-nav">
					<a class="prev"></a>
					<a class="next"></a>
				</div>
			</div>
			<div id="product-carousel" class="owl-carousel owl-theme">
			<?php 
			$urunsor=$db->prepare("SELECT * FROM urun where urun_durum=:urun_durum");
			$urunsor->execute(array(
				'urun_durum' => 1
				));

			
			while($uruncek=$urunsor->fetch(PDO::FETCH_ASSOC)) {
				?>



				<div class="item">
					<div class="productwrap">
						<div class="pr-img">
							<div class="hot"></div>
							<a href="urun-<?=seo($uruncek["urun_ad"]).'-'.$uruncek["urun_id"]?>"><img src="<?php echo $uruncek['urun_resim']?>" alt="" class="img-responsive"></a>
							<div class="pricetag blue"><div class="inner"><span><?php echo $uruncek['urun_fiyat'] ?> TL</span></div></div>
						</div>
						<span class="smalltitle"><a href="urun-<?=seo($uruncek["urun_ad"]).'-'.$uruncek["urun_id"]?>"><?php echo $uruncek['urun_ad'] ?></a></span>
						<span class="smalldesc">Ürün Kodu.: <?php echo $uruncek['urun_id'] ?></span>
					</div>
				</div>

				<?php } ?>

			</div>
		</div>
	</div>

	<div class="container">
		<div class="row">
			<div class="col-md-9"><!--Main content-->
			<div class="title-bg">
					<div class="title">Hakkımızda Bilgi</div>
				</div>
				<p class="ct">
					<?php 
					$hakkimizdasor=$db->prepare("SELECT * FROM hakkimizda where hakkimizda_id=:id");
					$hakkimizdasor->execute(array(
						'id' => 0
						));
					$hakkimizdacek=$hakkimizdasor->fetch(PDO::FETCH_ASSOC);

					echo substr($hakkimizdacek['hakkimizda_icerik'],0,1000) ?>
				</p>

				<a href="hakimizda" class="btn btn-default btn-red btn-sm">Devamını Oku</a>

				<div class="title-bg">
				
				
				</div><!--Products-->
				<div class="spacer"></div>
			</div><!--Main content-->
		<?php  include 'sidebar.php'?>
		</div>
	</div>
	
<?php include 'footer.php';?>