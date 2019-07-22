	<!-- Main content -->
	<section class="content">
		<div class="box box-solid">
			<div class="box-header with-border text-center">
				<h3 class="box-title"><?= $contentTitle; ?></h3>
			</div>
			<div class="box-body">

				<div class="row">
					<div class="col-md-4 product_img">
						<img src="<?= base_url('uploads/products/' . $rs_produk[0]['gambar_produk']); ?>" class="img-responsive">
					</div>
					<div class="col-md-8 product_content">
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
						<h3 class="cost">Mulai dari - <span class="text-bold">IDR</span> <?= format_rupiah($rs_produk[0]['harga_awal']); ?></h3>
						<div class="space-ten"></div>
						<div class="btn-ground">
							<button type="button" class="btn btn-success btn-bin" data-id="<?= $rs_produk[0]['id_lelang']; ?>"><span class="glyphicon glyphicon-shopping-cart"></span> Buy It Now!</button>
							<button type="button" class="btn btn-danger btn-bid" data-toggle="modal" data-target="#modal-bid" data-id="<?= $rs_produk[0]['id_lelang']; ?>" data-price="<?= $rs_produk[0]['harga_maksimal']; ?>"><span class="glyphicon glyphicon-hand-up"></span> Bid Now!</button>
						</div>
					</div>
				</div>

			</div>
		</div>
	</section>
