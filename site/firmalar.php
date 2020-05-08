<?php include 'header.php';
 if (isset($_GET['sef'])) {


	$firmasor=$db->prepare("SELECT * FROM firma where firma_ad=:ad order by firma_durum DESC, firma_sira ASC");
	$firmasor->execute(array(
		'ad' => $_GET['sef']
		));



	 $firma_id=$firmacek['firma_id'];


	$urunsor=$db->prepare("SELECT * FROM urun where firma_id=:firma_id");
	$urunsor->execute(array(
		'firma_id' => $firma_id
		));

	$say=$urunsor->rowCount();

} else {

	$firmasor=$db->prepare("SELECT * FROM firma order by firma_durum DESC, firma_sira ASC");
	$firmasor->execute();

}


?>

	<div class="container">
		
		<div class="clearfix"></div>
		<div class="lines"></div>
	</div>
	
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="page-title-wrap">
					<div class="page-title-inner">
					<div class="row">
						<div class="col-md-4">
							<div class="bigtitle">Firmalar</div>
						</div>
						<div class="col-md-3 col-md-offset-5">
						</div>
					</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-9"><!--Main content-->
				<div class="title-bg">
					<div class="title">Firmalar</div>
					
				</div>
                <div class="row prdct"><!--Products-->
                
                <?php
                           
                      

                           while($firmacek=$firmasor->fetch(PDO::FETCH_ASSOC)) {
                           ?>
					<div class="col-md-4">
						<div class="productwrap">
							<div class="pr-img">
								<div class="hot"></div>
								<a href="firma-<?=seo($firmacek["firma_ad"]).'-'.$firmacek["firma_id"]?>"><img src="<?php echo $firmacek['firma_resimyol']?>" alt="" class="img-responsive"></a>
								
							</div>
							<span class="smalltitle"><a href="product.htm"><?php echo $firmacek['firma_ad']?></a></span>
							<span class="smalldesc"><?php echo $firmacek['firma_tel']?></span>
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