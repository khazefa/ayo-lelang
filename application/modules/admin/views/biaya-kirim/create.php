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
				<form class="form-horizontal" action="<?php echo base_url('admin/biaya-kirim/create'); ?>" method="POST" role="form">
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
							<label class="col-sm-3 control-label">Kota Tujuan</label>
							<div class="col-sm-6">
								<select name="fkota" id="fkota" class="form-control">
									<option value="" selected>Pilih</option>
									<?php
									foreach ($records_kota as $rk) {
										echo '<option value="' . $rk['id_kota'] . '">' . $rk['nama_kota'] . '</option>';
									}
									?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Biaya Kirim</label>
							<div class="col-sm-6">
								<input type="number" class="form-control" id="fharga" name="fharga" placeholder="Biaya Kirim" min="0">
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
