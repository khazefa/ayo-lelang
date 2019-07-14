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
						?>
						<div class="col-md-3">
							<div class="box box-warning box-solid">
								<div class="box-header with-border">
									<h3 class="box-title wrapping-text"><?= $rp['nama_lelang']; ?></h3>
									<!-- /.box-tools -->
								</div>
								<!-- /.box-header -->
								<div class="box-body">
									<a href="<?= base_url('produk/detail/' . $rp['id_lelang']); ?>">
										<img class="img-responsive img-carbox" src="<?= base_url('uploads/products/' . $rp['gambar_produk']); ?>" alt="<?= $rp['nama_lelang']; ?>">
									</a>
								</div>
								<div class="box-footer">
									<div class="pull-left">
										<button type="button" class="btn btn-success btn-block">Buy It Now!</button>
									</div>
									<div class="pull-right">
										<button type="button" class="btn btn-danger btn-block">Bid Now!</button>
									</div>
								</div>
								<!-- /.box-body -->
							</div>
							<!-- /.box -->
						</div>
						<!-- /.col -->
					<?php
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
					<?php echo $pagination; ?>
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
