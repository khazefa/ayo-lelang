<!-- Main content -->
<section class="content">
	<div class="box box-solid">
		<div class="box-header with-border text-center">
			<h3 class="box-title"><?= $contentTitle; ?></h3>
		</div>
		<div class="box-body">
			<div class="row">
				<?php
				if (count($rs_produk) > 0) {
					foreach ($rs_produk as $rp) {
						$id = (int) $rp['id'];
						?>
						<script>
							arr_id.push(<?= $id; ?>);
						</script>
						<?php
						$short_desc = text_shorter($rp['keterangan'], 75);
						$price = (int) $rp['harga_awal'];
						$price_idr = format_rupiah($price);
						// $end_time = date('d/m/Y H:i:s', strtotime($rp['waktu_selesai']));

						$current_date = date('Y-m-d H:i:s');
						$start_time  = date_create() >= date_create($rp['waktu_mulai']) ? date_create() : date_create($rp['waktu_mulai']);
						$end_time = date_create($rp['waktu_selesai']); // waktu sekarang
						$diff  = date_diff($start_time, $end_time);

						$is_expired = false;
						if (($rp['waktu_mulai'] > $current_date) || ($current_date > $rp['waktu_selesai'])) {
							$is_expired = true;
						}

						if (!$is_expired) {
							?>
							<div class="col-md-3">
								<div class="box box-warning box-solid">
									<div class="box-header with-border">
										<h3 class="box-title wrapping-text"><?= $rp['nama']; ?></h3>
										<!-- /.box-tools -->
									</div>
									<!-- /.box-header -->
									<div class="box-body">
										<a href="<?= base_url('produk/detail/' . $rp['id']); ?>">
											<img class="img-responsive img-carbox" src="<?= base_url('uploads/products/' . $rp['gambar']); ?>" alt="<?= $rp['nama']; ?>">
										</a>
										<p class="text-center">
											<?php
											if ((int) $diff->d >= 1) {
												echo '<strong>Tinggal ' . $diff->d . ' hari ' . $diff->h . ' Jam lagi!</strong>';
											} else {
												echo '<strong>Tinggal ' . $diff->h . ' Jam ' . $diff->i . ' Menit lagi!</strong>';
											}
											?>
										</p>
										<p class="text-center">
											Lihat <a href="<?= base_url('produk/detail/' . $rp['id']); ?>"> detail</a> untuk selengkapnya
										</p>
										<div class="price">
											<h5>Mulai dari <strong class="text-danger"><?= $price_idr; ?></strong></h5>
										</div>
									</div>
									<div class="box-footer">
										<div class="pull-left">
											<button type="button" class="btn btn-success btn-block btn-bin" data-id="<?= $id; ?>">Buy It Now!</button>
											<center><span class="text-info total-bin-<?= $id; ?>">0 buyer</span></center>
										</div>
										<div class="pull-right">
											<button type="button" class="btn btn-danger btn-block btn-bid" data-toggle="modal" data-target="#modal-bid" data-id="<?= $id; ?>" data-price="<?= $price; ?>">Bid Now!</button>
											<center><span class="text-warning total-bid-<?= $id; ?>">0 bidder</span></center>
										</div>
									</div>
									<!-- /.box-body -->
								</div>
								<!-- /.box -->
							</div>
							<!-- /.col -->
						<?php
						}
					}
				} else {
					?>
					<div class="col-md-12">
						<div class="alert alert-info">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							Maaf belum ada produk untuk dilelang pada kategori ini.
						</div>

					</div>
				<?php
				}
				?>
			</div>
			<!-- Paginate -->
			<div class="row">
				<div class="col">
					<!--Tampilkan pagination-->
					<?php 
						echo $pagination; 
					?>
				</div>
			</div>
		</div>
		<!-- /.box-body -->
	</div>
	<!-- /.box -->
</section>
<!-- /.content -->
</div>
<!-- /.container -->
