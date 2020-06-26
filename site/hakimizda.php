<?php

include 'header.php';

$hakkimizdasor=$db->prepare("select * from hakkimizda where hakkimizda_id=?");
$hakkimizdasor->execute(array(0));
$hakkimizdacek=$hakkimizdasor->fetch(PDO::FETCH_ASSOC);

?>

	
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="page-title-wrap">
					<div class="page-title-inner">
					<div class="row">
						<div class="col-md-4">
							<div class="bigtitle "style="margin-left:380px;">Hakkımızda</div>
						</div>
					
					</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-9"><!--Main content-->
				<div class="title-bg">
					<div class="title"><?php echo $hakkimizdacek['hakkimizda_baslik']; ?></div>
				</div>
				<div class="page-content">
					<p>
					<?php echo $hakkimizdacek['hakkimizda_icerik']; ?>
					</p>
				
				</div>
				<div class="title-bg">
					<div class="title">Vizyon</div>
				</div>
				<blockquote><?php echo $hakkimizdacek['hakkimizda_vizyon']; ?></blockquote>
				<div class="title-bg">
					<div class="title">Misyon</div>
				</div>
				<blockquote><?php echo $hakkimizdacek['hakkimizda_misyon']; ?></blockquote>
			</div>
			<?php  include 'sidebar.php'?>
	
		</div>
		<div class="spacer"></div>
	</div>
	
	<?php
	include 'footer.php';
	?>