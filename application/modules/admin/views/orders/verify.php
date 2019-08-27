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
				<form class="form-horizontal" action="<?php echo base_url('admin/kota/create'); ?>" method="POST" role="form">
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
							<label class="col-sm-3 control-label">Tgl. Order</label>
							<div class="col-sm-6">
								<input type="text" class="form-control" value="<?= date('d/m/Y H:i:s', strtotime($records[0]['order_date'])); ?>" readonly="readonly">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Item</label>
							<div class="col-sm-6">
								<input type="text" class="form-control" value="<?= $records[0]['item_name']; ?>" readonly="readonly">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Order Total (Rp.)</label>
							<div class="col-sm-6">
								<input type="text" class="form-control" value="<?= $records[0]['order_total']; ?>" readonly="readonly">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">No. Rek / Nama Bank</label>
							<div class="col-sm-6">
								<input type="text" class="form-control" value="<?= $records[0]['confirmation']['no_rek'] . ' / ' . $records[0]['confirmation']['nama_bank']; ?>" readonly="readonly">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Atas Nama</label>
							<div class="col-sm-6">
								<input type="text" class="form-control" value="<?= $records[0]['confirmation']['atas_nama']; ?>" readonly="readonly">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Jumlah Transfer (Rp.)</label>
							<div class="col-sm-6">
								<input type="text" class="form-control" value="<?= $records[0]['confirmation']['nominal']; ?>" readonly="readonly">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Tgl. Transfer</label>
							<div class="col-sm-6">
								<input type="text" class="form-control" value="<?= date('d/m/Y H:i:s', strtotime($records[0]['confirmation']['tgl_transfer'])); ?>" readonly="readonly">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">No. Rek Tujuan</label>
							<div class="col-sm-6">
								<input type="text" class="form-control" value="<?= $records[0]['confirmation']['bank_tujuan']; ?>" readonly="readonly">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Bukti Transfer</label>
							<?php
							$proof_img = $records[0]['confirmation']['file_konfirmasi'];
							?>
							<div class="col-sm-6">
								<a href="<?= base_url('/uploads/bukti_transfer/' . $proof_img); ?>" target="_blank"><i class="fa fa-image"></i> Bukti Transfer</a>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">&nbsp;</label>
							<div class="col-sm-6">
								<button type="button" class="btn btn-block btn-info" onclick="location.href='<?= base_url('admin/orders/verify-paid/'.$records[0]['confirmation']['notrans_order']); ?>'">Set Paid</button>
							</div>
						</div>
					</div>
					<!-- /.box-body -->
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
