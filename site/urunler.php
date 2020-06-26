<?php include 'header.php';
 
 $urunsor=$db->prepare("SELECT * FROM urun where firma_id=:firma_id order by urun_id DESC");
 $urunsor->execute(array(
     'firma_id' => $_GET['firma_id']
     ));
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
	
	<div class="clearfix"></div>
	<div class="lines"></div>
</div>

<div class="container">
	<div class="row">

	</div>
		<div class="row">
			<div class="col-md-9"><!--Main content-->
				<div class="title-bg">
					<div class="title">Ürünler</div>
					
				</div>
                <div class="row prdct"><!--Products-->
                
                <?php
                           
                      

                           while($uruncek=$urunsor->fetch(PDO::FETCH_ASSOC)) {
                           ?>
					<div class="col-md-4">
						<div class="productwrap">
							<div class="pr-img">
								<div class="hot"></div>
								<a href="urun-<?=seo($uruncek["urun_ad"]).'-'.$uruncek["urun_id"]?>"><img src="<?php echo $uruncek['urun_resim']?>" alt="" class="img-responsive"></a>
								<div class="pricetag on-sale"><div class="inner on-sale"><span class="onsale"><span class="oldprice">$314</span><?php echo $uruncek['urun_fiyat']?></span></div></div>
							</div>
							<span class="smalltitle"><a href="product.htm"><?php echo $uruncek['urun_ad']?></a></span>
							<span class="smalldesc"><b><?php echo $uruncek['urun_stok']?></span>
						</div>
                    </div>

                    <?php  }  ?>

				</div><!--Products-->
			

			</div>
		
        <div class="spacer"></div>
        <?php  include 'sidebar.php'?>
    </div>
   

    </div>
    </div>
    <?php include 'footer.php';?>