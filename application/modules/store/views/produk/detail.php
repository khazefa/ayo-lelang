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
						<img src="<?= base_url('uploads/products/' . $rs_produk[0]['gambar']); ?>" class="img-responsive">
						<br>
						<div class="btn-ground text-center">
							<button type="button" class="btn btn-block btn-success btn-bin" data-id="<?= $rs_produk[0]['id']; ?>" <?= $rs_produk[0]['status'] === 'end' ? "disabled" : ""; ?>><span class="glyphicon glyphicon-shopping-cart"></span> Buy It Now!</button>
							<button type="button" class="btn btn-block btn-danger btn-bid" data-toggle="modal" data-target="#modal-bid" data-id="<?= $rs_produk[0]['id']; ?>" data-price="0" <?= $rs_produk[0]['status'] === 'end' ? "disabled" : ""; ?>><span class="glyphicon glyphicon-hand-up"></span> Bid Now!</button>
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
						<h4><?= $rs_produk[0]['nama']; ?></h4>
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
								<?php
									foreach ($rs_bid as $rb) {
										echo '<tr>';
										echo '<td><i class="fa fa-hand-o-right"> '.$rb['user'].' '.$rb['bid_type'].' item <strong>'.$rb['bid_price'].'</strong> at '.$rb['bid_time'].' <label class="label label-info"> '.$rb['bid_status'].'</label></td>';
										echo '</tr>';
									}
								?>
							</tbody>
						</table>
					</div>
				</div>
				<!-- row -->

			</div>
		</div>
	</section>
