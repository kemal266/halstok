<?php include 'header.php'; 

?>

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="page-title-wrap">
				<div class="page-title-inner">
					<div class="row">
						<div class="col-md-12">
							<div class="bigtitle">Sipariş Bilgilerim</div>
							<p >Vermiş olduğunuz siparişlerinizi listeliyorsunuz</p>
						</div>
						
					</div>
				</div>
			</div>
		</div>
	</div>

	<form action="nedmin/netting/islem.php" method="POST" class="form-horizontal checkout" role="form">
		<div class="row">
			<div class="col-md-12">
				<div class="title-bg">
					<div class="title">Sipariş Bilgileri</div>
				</div>

				<div class="table-responsive">
					<table class="table table-bordered chart">
						<thead>
							<tr>
						
								<th>Sipariş No</th>
								<th>Tarih</th>
								<th>Tutar</th>
								<th>Ödeme Tip</th>
								<th>Banka Tip</th>
								<th>Ürün</th>
								<th>Firma</th>
								<th>Ürün Bilgi</th>
								<th>Ürün Adet</th>
								
							</tr>
						</thead>
						<tbody>

							<?php 
							$say=1;
							 $kullanici_id=$kullanicicek['kullanici_id'];
							$siparissor=$db->prepare("SELECT * FROM siparis where kullanici_id=:id");
							$siparissor->execute(array(
								'id' => $kullanici_id
								
								));
								

								while($sipariscek=$siparissor->fetch(PDO::FETCH_ASSOC)) {

									$urun_id=$sipariscek['urun_id'];
					$urunsor=$db->prepare("SELECT * FROM siparis_detay where urun_id=:urun_id");
					$urunsor->execute(array(
						'urun_id' => $urun_id
						));

					$uruncek=$urunsor->fetch(PDO::FETCH_ASSOC);

									?>
								<tr>

									<td><?php echo $say++ ?></td>
									<td><?php echo $sipariscek['siparis_zaman']; ?></td>
									<td><?php echo $sipariscek['siparis_toplam']; ?></td>
									<td><?php echo $sipariscek['siparis_tip']; ?></td>
									<td><?php echo $sipariscek['siparis_banka']; ?></td>
									<td><?php
									
									 $adcek = $db->query("select urun_ad from urun where urun_id=" . $sipariscek['urun_id'])->fetch();
						echo $adcek['urun_ad']; ?>
									 </td>
									<td><?php  $adcek = $db->query("select firma_ad from firma where firma_id=" . $sipariscek['firma_id'])->fetch();
						echo $adcek['firma_ad']; ?></td>

									<td><?php
									
									$adcek = $db->query("select urun_bilgi from urun where urun_id=" . $sipariscek['urun_id'])->fetch();
					   echo $adcek['urun_bilgi']; ?></td>
					   	<td><?php echo $uruncek['urun_adet']; ?></td>
								</tr>
							
								<?php } ?>

							</tbody>
						</table>
					</div>











				</div>

			</div>
		</div>
	</form>
	<div class="spacer"></div>
</div>

<?php include 'footer.php'; ?>