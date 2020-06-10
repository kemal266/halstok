<?php 



//Belirli veriyi seçme işlemi
$menusor=$db->prepare("SELECT * FROM menu");
$menusor->execute();


?>

<div class="col-md-3"><!--sidebar-->
				<div class="title-bg">
					<div class="title">Menüler</div>
				</div>
				
				<div class="categorybox">
					<ul>
					<?php 
          

             
		  $menusor=$db->prepare("SELECT * FROM menu where menu_durum=:durum order by menu_sira ASC limit 5");
		  $menusor->execute(array(
		   'durum' => 1
		   ));
	 
		  while($menucek=$menusor->fetch(PDO::FETCH_ASSOC)) {
			?>
	 
	 
			<li><a href="
	 
			 <?php 
	 
			 if (!empty($menucek['menu_url'])) {
	 
			   echo $menucek['menu_url'];
	 
			 } else {
	 
	 
			   echo "sayfa-".seo($menucek['menu_ad']);
	 
			 }
			 ?>
	 
	 
			 "><?php echo $menucek['menu_ad'] ?></a></li>
	 
			 <?php } ?>
					</ul>
				</div>
				
				<div class="ads">
					<a href="product.htm"><img src="images\ads.png" class="img-responsive" alt=""></a>
				</div>
				
			</div><!--sidebar-->