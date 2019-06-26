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
				<form class="form-horizontal" action="<?php echo base_url('admin/akun/update'); ?>" method="POST" role="form">
					<input type="hidden" name="fid" id="fid" value="<?= $records[0]['nama_akun']; ?>">
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
							<label class="col-sm-3 control-label">Username</label>
							<div class="col-sm-6">
								<input type="text" class="form-control" id="fusername" name="fusername" value="<?= $records[0]['nama_akun']; ?>" readonly="readonly">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Ubah Password</label>
							<div class="col-sm-6">
								<input type="password" class="form-control" id="fpassword" name="fpassword" palceholder="Ubah Password">
								<p class="help-block">Input jika ingin mengganti password/kata sandi</p>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Nama</label>
							<div class="col-sm-6">
								<input type="text" class="form-control" id="fnama" name="fnama" value="<?= $records[0]['nama_lengkap_akun']; ?>" required="required">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Email</label>
							<div class="col-sm-6">
								<input type="email" class="form-control" id="femail" name="femail" value="<?= $records[0]['email_akun']; ?>" required="required">
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
