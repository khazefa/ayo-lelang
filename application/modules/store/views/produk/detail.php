	<!-- Main content -->
	<section class="content">
		<div class="box box-solid">
			<!--
			<div class="box-header with-border text-center">
				<h3 class="box-title"><?= $contentTitle; ?></h3>
			</div>
			-->
			<div class="box-body">
				<!-- row -->
				<div class="row">
					<div class="col-md-4 product_img">
						<img src="<?= base_url('uploads/products/' . $rs_produk[0]['gambar_produk']); ?>" class="img-responsive">
						<br>
						<div class="btn-ground text-center">
							<button type="button" class="btn btn-block btn-success btn-bin" data-id="<?= $rs_produk[0]['id_lelang']; ?>" <?= $rs_produk[0]['status_lelang'] === 'end' ? "disabled" : ""; ?>><span class="glyphicon glyphicon-shopping-cart"></span> Buy It Now!</button>
							<button type="button" class="btn btn-block btn-danger btn-bid" data-toggle="modal" data-target="#modal-bid" data-id="<?= $rs_produk[0]['id_lelang']; ?>" data-price="<?= $rs_produk[0]['harga_maksimal']; ?>" <?= $rs_produk[0]['status_lelang'] === 'end' ? "disabled" : ""; ?>><span class="glyphicon glyphicon-hand-up"></span> Bid Now!</button>
						</div>
						<br>
						<table class="table table-striped">
							<tbody>
								<tr>
									<td align="center"><i class="fa fa-user"></i> <?= $rs_pelelang[0]['nama_pelelang']; ?></td>
									<td align="center"><i class="fa fa-home"> <?= $rs_kota[0]['nama_kota']; ?></td>
								</tr>
							</tbody>
						</table>
					</div>
					<div class="col-md-8 product_content">
						<h3 id="prd_price" class="cost">Mulai dari - <span class="text-bold">IDR</span> <?= format_rupiah($rs_produk[0]['harga_awal']); ?></h3>
						<hr>
						<h4><?= $rs_produk[0]['nama_lelang']; ?></h4>
						<h4>Kategori: <span><?= $rs_kategori[0]['nama_kategori']; ?></span></h4>
						<!-- <h4>Product Id: <span>51526</span></h4> -->
						<!--
						<div class="rating">
							<span class="glyphicon glyphicon-star"></span>
							<span class="glyphicon glyphicon-star"></span>
							<span class="glyphicon glyphicon-star"></span>
							<span class="glyphicon glyphicon-star"></span>
							<span class="glyphicon glyphicon-star"></span>
							(10 reviews)
						</div>
						-->
						<p><?= $rs_produk[0]['keterangan']; ?></p>
						<table class="table table-bordered">
							<tbody>
								<tr>
									<td><i class="fa fa-hand-o-right"> A telah BIN item CLOSED!</td>
								</tr>
								<tr>
									<td><i class="fa fa-hand-o-right"> B telah BID 2.100.000 12:00</td>
								</tr>
								<tr>
									<td><i class="fa fa-hand-o-right"> C telah BID 2.300.000 13:00</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				<!-- row -->

			</div>
		</div>
	</section>
