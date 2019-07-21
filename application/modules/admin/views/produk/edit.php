<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-md-8 offset-md-4">
			<div class="box box-default">
				<div class="box-header with-border">
					<a href="javascript: history.go(-1)"><i class="fa fa-reply"></i></a>
					<h3 class="box-title"><?= $contentTitle; ?></h3>

					<div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
					</div>
				</div>
				<!-- /.box-header -->
				<form class="form-horizontal" action="<?php echo base_url('admin/produk/update'); ?>" method="POST" role="form" enctype="multipart/form-data">
					<input type="hidden" name="fid" id="fid" value="<?= $records[0]['id_lelang']; ?>">
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
						<div class="form-group">
							<label class="col-sm-3 control-label">Kategori</label>
							<div class="col-sm-4">
								<select name="fkategori" id="fkategori" class="form-control">
									<option value="" selected>Pilih</option>
									<?php
									foreach ($records_kategori as $rk) {
										if ($rk['id_kategori'] === $records[0]['id_kategori']) {
											echo '<option value="' . $rk['id_kategori'] . '" selected>' . $rk['nama_kategori'] . '</option>';
										} else {
											echo '<option value="' . $rk['id_kategori'] . '">' . $rk['nama_kategori'] . '</option>';
										}
									}
									?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Nama</label>
							<div class="col-sm-6">
								<input type="text" class="form-control" id="fnama" name="fnama" value="<?= $records[0]['nama_lelang']; ?>" required="required">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Harga Awal</label>
							<div class="col-sm-3">
								<input type="number" class="form-control" id="fharga1" name="fharga1" value="<?= $records[0]['harga_awal']; ?>" min="0">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Harga Maksimal</label>
							<div class="col-sm-3">
								<input type="number" class="form-control" id="fharga2" name="fharga2" value="<?= $records[0]['harga_maksimal']; ?>" min="0">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Waktu Mulai</label>
							<div class="col-sm-4">
								<input type="date" class="form-control" id="fwaktu1" name="fwaktu1" value="<?= date('Y-m-d', strtotime($records[0]['waktu_mulai'])); ?>">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Waktu Selesai</label>
							<div class="col-sm-4">
								<input type="date" class="form-control" id="fwaktu2" name="fwaktu2" value="<?= date('Y-m-d', strtotime($records[0]['waktu_selesai'])); ?>">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Keterangan <span class="text-danger">*</span></label>
							<div class="col-sm-6">
								<textarea id="fketerangan" name="fketerangan" class="form-control" rows="5"><?= $records[0]['keterangan']; ?></textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Foto</label>
							<div class="col-sm-6">
								<?php
								if (!empty($records[0]['gambar_produk'])) {
									echo '<img src="' . base_url("uploads/products/") . $records[0]['gambar_produk'] . '" class="img-responsive">';
								} else {
									echo 'No Image';
								}
								?>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Ubah Foto</label>
							<div class="col-sm-6">
								<input type="file" class="form-control" id="fgambar" name="fgambar" placeholder="Upload Foto">
								<p class="help-block">tipe file gambar (jpg, jpeg, png)</p>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Status</label>
							<div class="col-sm-4">
								<select name="fstatus" id="fstatus" class="form-control">
									<option value="" selected>Pilih</option>
									<?php
										$status_a = $records[0]['status_lelang'] === 'active' ? 'selected' : '';
										$status_n = $records[0]['status_lelang'] === 'end' ? 'selected' : '';

										echo '<option value="active" '.$status_a.'>Active</option> ';
										echo '<option value="end" '.$status_n.'>End</option> ';
									?>
								</select>
							</div>
						</div>
					</div>
					<!-- /.box-body -->
					<div class="box-footer">
						<button type="submit" class="btn btn-info pull-right">Submit</button>
					</div>
					<!-- /.box-footer -->
				</form>
				<!-- /.form -->
			</div>
		</div>
	</div>

</section>

<script type="text/javascript">
	$(document).ready(function() {

	});
</script>
