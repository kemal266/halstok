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
								<th>Toplam Tip</th>
								<th>Ödeme Tip</th>
								<th>Banka Tip</th>
							
								
								
								<th></th>
								
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
								
									 </td>
									
						<input type="hidden" name="firma_id" value="<?php echo $sipariscek['firma_id'] ?>">
						<input type="hidden" name="kullanici_id" value="<?php echo $sipariscek['kullanici_id'] ?>">

<td><a href="siparisdetay.php?siparis_id=<?php echo $sipariscek['siparis_id']; ?>"><button type="submit" class="btn btn-primary btn-xs">Detaylar</button></a></td>
								</tr>
								


								<?php } ?>

							</tbody>
						</table>
					</div>











				</div>

			</div>
		</div>
	
	<div class="spacer"></div>
</div>

<?php include 'footer.php'; ?>