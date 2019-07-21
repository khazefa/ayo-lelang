<?php
$name = "";
$email = "";
$username = "";
$address = "";
$phone = "";

foreach ($records_peserta as $rp) {
	$name = $rp['nama_peserta'];
	$email = $rp['email_peserta'];
	$username = $rp['akun_peserta'];
	$address = $rp['alamat_peserta'];
	$phone = $rp['telepon_peserta'];
}
?>
<!-- Main content -->
<section class="content">
	<div class="col-md-3">
		<div class="list-group">
			<a href="<?= base_url('peserta/profil'); ?>" class="list-group-item active"><i class="fa fa-user"></i> Profil</a>
			<a href="<?= base_url('peserta/status-bid'); ?>" class="list-group-item">
				<i class="fa fa-gavel"></i> Status Bid
			</a>
			<a href="<?= base_url('peserta/invoice'); ?>" class="list-group-item"><i class="fa fa-file-text-o"></i> Invoice</a>
			<a href="<?= base_url('signout'); ?>" class="list-group-item"><i class="fa fa-sign-out"></i> Logout</a>
		</div>
	</div>

	<div class="col-md-9">
		<div class="box box-solid">
			<div class="box-header with-border text-center">
				<h3 class="box-title"><?= $contentTitle; ?></h3>
			</div>
			<div class="box-body">

				<div class="col-md-9">
					<!-- form start -->
					<form method="POST" action="<?= base_url('peserta/update'); ?>" class="form-horizontal">
						<div class="box-body">
							<div class="form-group">
								<label for="reg_nama" class="col-sm-3 control-label">Nama Lengkap <span class="text-danger">*</span></label>

								<div class="col-sm-9">
									<input type="text" class="form-control" id="reg_nama" name="reg_nama" value="<?= $name; ?>" required="required">
								</div>
							</div>
							<div class="form-group">
								<label for="reg_email" class="col-sm-3 control-label">Email <span class="text-danger">*</span></label>

								<div class="col-sm-9">
									<input type="email" class="form-control" id="reg_email" name="reg_email" value="<?= $email; ?>" required="required">
								</div>
							</div>
							<div class="form-group">
								<label for="reg_username" class="col-sm-3 control-label">Username <span class="text-danger">*</span></label>

								<div class="col-sm-9">
									<input type="text" class="form-control" id="reg_username" name="reg_username" value="<?= $username; ?>" readonly="readonly">
									<span class="help-block">Kolom ini tidak dapat diubah</span>
								</div>
							</div>
							<div class="form-group">
								<label for="reg_password" class="col-sm-3 control-label">Ubah Password <span class="text-danger">*</span></label>

								<div class="col-sm-9">
									<input type="password" class="form-control" id="reg_password" name="reg_password" placeholder="Ubah Password">
									<span class="help-block">Input jika ingin mengubah password</span>
								</div>
							</div>
							<div class="form-group">
								<label for="reg_address" class="col-sm-3 control-label">Alamat Lengkap</label>

								<div class="col-sm-9">
									<textarea id="reg_address" name="reg_address" class="form-control" rows="3"><?= $address; ?></textarea>
								</div>
							</div>
							<div class="form-group">
								<label for="reg_phone" class="col-sm-3 control-label">No. Telepon</label>

								<div class="col-sm-9">
									<input type="number" class="form-control" id="reg_phone" name="reg_phone" value="<?= $phone; ?>">
								</div>
							</div>
						</div>
						<!-- /.box-body -->
						<div class="box-footer">
							<button type="submit" class="btn btn-info pull-right">Update</button>
						</div>
						<!-- /.box-footer -->
					</form>
				</div>

			</div>
		</div>
	</div>

</section>
