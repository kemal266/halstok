<?php include 'header.php' ?>

<div class="container">

	<div class="clearfix"></div>
	<div class="lines"></div>
</div>

<div class="container">
	<div class="row">
		<div class="col-md-12">
			
		</div>
	</div>
	<div class="title-bg">
		<div class="title">Ödeme Sayfası</div>
	</div>

	<div class="table-responsive">
		<table class="table table-bordered chart">
			<thead>
				<tr>
					<th>Ürün Resim</th>
					<th>Ürün ad</th>
					<th>Ürün Kodu</th>
					<th>Adet</th>
					<th>Toplam Fiyat</th>
				</tr>
			</thead>
			<tbody>


				<?php 
				$kullanici_id=$kullanicicek['kullanici_id'];
				$sepetsor=$db->prepare("SELECT * FROM sepet where kullanici_id=:id");
				$sepetsor->execute(array(
					'id' => $kullanici_id
					));

				while($sepetcek=$sepetsor->fetch(PDO::FETCH_ASSOC)) {

					$urun_id=$sepetcek['urun_id'];
					$urunsor=$db->prepare("SELECT * FROM urun where urun_id=:urun_id");
					$urunsor->execute(array(
						'urun_id' => $urun_id
						));

					$uruncek=$urunsor->fetch(PDO::FETCH_ASSOC);
					//$toplam_fiyat+=$uruncek['urun_fiyat']*$sepetcek['urun_adet'];
					?>

					<tr>
						<td><img src=<?php echo $uruncek['urun_resim'] ?> width="100" alt=""></td>
						<td><?php echo $uruncek['urun_ad'] ?></td>
						<td><?php echo $uruncek['urun_id'] ?></td>
						<td><form><?php echo $sepetcek['urun_adet'] ?></form></td>
						<td><?php echo $uruncek['urun_fiyat'] ?></td>
					</tr>
					<?php } ?>

				</tbody>
			</table>
		</div>
		<div class="row">
			<div class="col-md-6">


			</div>
			<div class="col-md-3 col-md-offset-3">
				<div class="subtotal-wrap">
					<!--<div class="subtotal">
						<<p>Toplam Fiyat : $26.00</p>
						<p>Vat 17% : $54.00</p>
					</div>-->
					<div class="total">Toplam Fiyat : <span class="bigprice"><?php echo @$toplam_fiyat ?> TL</span></div>
					<div class="clearfix"></div>
					<!-- <a href="" class="btn btn-default btn-yellow">Ödeme Sayfası</a> -->
				</div>
				<div class="clearfix"></div>
			</div>
		</div>

		<div class="tab-review">
			<ul id="myTab" class="nav nav-tabs shop-tab">

				<li class="active"><a href="#desc" data-toggle="tab">Kredi Kartı</a></li>
				<li><a href="#rev" data-toggle="tab">Banka Havalesi </a></li>
			</ul>




			<div id="myTabContent" class="tab-content shop-tab-ct">
				

				<div class="tab-pane fade active in" id="desc">
					<p>
						Entegrasyon Tamamlanmadı.
					</p>
				</div>


				<div class="tab-pane fade " id="rev">

					<form action="../neadmin/netting/islem.php" method="POST">

						<p>Ödeme yapacağınız hesap numarasını seçerek işlemi tamamlayınız.</p>


						<?php 

						$bankasor=$db->prepare("SELECT * FROM banka order by banka_id ASC");
						$bankasor->execute();

						while($bankacek=$bankasor->fetch(PDO::FETCH_ASSOC)) { ?>

						
						<input type="radio" name="banka_id" value="<?php echo $bankacek['banka_id'] ?>">
						<?php echo $bankacek['banka_ad']; echo " ";?><br>


						

						<?php } ?>
						<hr>
						<button class="btn btn-success" type="submit" name="sipariskaydet">Sipariş Ver</button>

					</form>

				</div>


			</div>
		</div>
		<div class="spacer"></div>
	</div>

	<?php include 'footer.php' ?>