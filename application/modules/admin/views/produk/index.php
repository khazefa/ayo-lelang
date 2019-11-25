<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<!-- Default box -->
			<div class="box">
				<div class="box-header with-border">
					<button type="button" class="btn btn-default" onclick="location.href='<?php echo base_url('admin/produk/add'); ?>'" title="Add New">
						<i class="fa fa-plus-circle"></i> Tambah
					</button>
					<!-- <h3 class="box-title"><?= $contentTitle; ?></h3> -->

					<div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
							<i class="fa fa-minus"></i>
						</button>
					</div>
				</div>

				<div class="box-body">
					<p class="text-success text-center">
						<?php
						$error = $this->session->flashdata('error');
						if ($error) {
							?>
							<div class="alert alert-danger alert-dismissable" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
								<?php echo $error; ?>
							</div>
						<?php
					}
					$success = $this->session->flashdata('success');
					if ($success) {
						?>
							<div class="alert alert-success alert-dismissable">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
								<?php echo $success; ?>
							</div>
						<?php } ?>
					</p>

					<div class="table-responsive">
						<table id="data-produk" class="table table-bordered table-hover">
							<thead>
								<tr>
									<th>Foto Barang</th>
									<th>Nama Barang</th>
									<th>Kategori</th>
									<th>Harga Awal</th>
									<th>Harga Maksimal</th>
									<th>Waktu Mulai</th>
									<th>Waktu Selesai</th>
									<th>Status</th>
									<th>&nbsp;</th>
								</tr>
							</thead>
							<tbody>
								<?php
								foreach ($records as $r) {
									$id = $r['id_lelang'];
									$foto = '<img src="' . base_url() . '/uploads/products/' . $r['gambar_produk'] . '" width="100px">';
									$nama = $r['nama_lelang'];
									$kategori = $r['nama_kategori'];
									$harga_awal = $r['harga_awal'];
									$harga_awal_rp = "Rp. " . format_rupiah($harga_awal);
									$harga_akhir = $r['harga_maksimal'];
									$harga_akhir_rp = "Rp. " . format_rupiah($harga_akhir);
									$waktu_mulai = indonesian_date($r['waktu_mulai']);
									$waktu_selesai = indonesian_date($r['waktu_selesai']);
									$keterangan = $r['keterangan'];
									$status = $r['status_lelang'] === "active" ? "Active" : "End";

									$button = '<div class="btn-group" role="group">';
									$button .= '<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									Action
									<span class="caret"></span>
									</button>';
									$button .= '<ul class="dropdown-menu">';
									if ( $r['status_lelang'] === 'active') {
										$button .= '<li><a href="' . base_url('admin/produk/edit/') . $id . '"><i class="mdi mdi-pencil mr-2 text-muted font-18 vertical-middle"></i> Edit</a></li>';
									}
									$button .= '<li><a href="' . base_url('admin/produk/delete/') . $id . '"><i class="mdi mdi-delete mr-2 text-muted font-18 vertical-middle"></i> Remove</a></li>';
									$button .= '</ul>';
									$button .= '</div>';

									echo '<tr>';
									echo '<td>' . $foto . '</td>';
									echo '<td>' . $nama . '</td>';
									echo '<td>' . $kategori . '</td>';
									echo '<td>' . $harga_awal_rp . '</td>';
									echo '<td>' . $harga_akhir_rp . '</td>';
									echo '<td>' . $waktu_mulai . '</td>';
									echo '<td>' . $waktu_selesai . '</td>';
									echo '<td>' . $status . '</td>';
									echo '<td>' . $button .'</td>';
									echo '</tr>';
								}
								?>
							</tbody>
						</table>
					</div>
				</div>
			</div>

		</div>
	</div>
</section>
<!-- /.content -->
