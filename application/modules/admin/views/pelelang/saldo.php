<?php
$show_btn_bank = empty($records_akun_bank) ? true : false;
$id = empty($records_akun_bank[0]['id_akun_bank']) ? '' : $records_akun_bank[0]['id_akun_bank'];
$norek = empty($records_akun_bank[0]['no_akun_bank']) ? '' : $records_akun_bank[0]['no_akun_bank'];
$nama = empty($records_akun_bank[0]['nama_akun_bank']) ? '' : $records_akun_bank[0]['nama_akun_bank'];
$bank = empty($records_akun_bank[0]['bank_akun_bank']) ? '' : $records_akun_bank[0]['bank_akun_bank'];
?>
<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-md-8">
			<div class="box box-default">
				<div class="box-header with-border">
					<a href="javascript: history.go(-1)"><i class="fa fa-reply"></i></a>
					<h3 class="box-title"><?= $contentTitle; ?></h3>

					<div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
					</div>
				</div>
				<!-- /.box-header -->
				<form class="form-horizontal" action="<?php echo base_url('admin/saldo/request_withdrawal'); ?>" method="POST" role="form">
					<input type="hidden" name="fid" id="fid" value="<?= $id; ?>">
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
							<label class="col-sm-3 control-label">Jumlah Saldo</label>
							<div class="col-sm-6">
								<input type="number" class="form-control" id="fsaldo" name="fsaldo" placeholder="Minimal Rp. 50.000" min="50000" max="100000000" required="required">
								<p class="help-block">Jumlah saldo yang ingin Anda tarik</p>
								<?php
								if ($show_btn_bank) { // tombol ini akan muncul jika pelelang belum melengkapi akun bank untuk penarikan dana
									?>
									<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalBtnBank">
										Tambah Akun Bank
									</button>
								<?php
								}
								?>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">No Rekening Tujuan</label>
							<div class="col-sm-6">
								<input type="number" class="form-control" id="fnorek" name="fnorek" value="<?= $norek; ?>" readonly="readonly">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Bank Tujuan</label>
							<div class="col-sm-6">
								<input type="text" class="form-control" id="fbank" name="fbank" value="<?= $bank; ?>" readonly="readonly">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Nama Pemilik Rekening</label>
							<div class="col-sm-6">
								<input type="text" class="form-control" id="fnama" name="fnama" value="<?= $nama; ?>" readonly="readonly">
							</div>
						</div>
					</div>
					<!-- /.box-body -->
					<div class="box-footer">
						<button type="submit" class="btn btn-info pull-right">Request</button>
					</div>
					<!-- /.box-footer -->
				</form>
				<!-- /.form -->
			</div>
		</div>
		<div class="col-md-4">
			<div class="box box-default">
				<div class="box-header with-border">
					<i class="fa fa-money"></i>
					<h3 class="box-title">Total Saldo Penjualan</h3>
					<div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
					</div>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<label for="total-order" class="col-sm-12">
						<span class="text-success">Total Order</span>
						<h2 id="total-order">0</h2>
					</label>
					<hr>
					<label for="total-saldo" class="col-sm-12">
						<span class="text-danger">Total Penarikan</span>
						<h2 id="total-saldo">0</h2>
					</label>
				</div>
				<!-- /.box-body -->
			</div>
		</div>
	</div>

</section>

<!-- Modal -->
<div class="modal fade" id="modalBtnBank" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Form Akun Bank</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<p>Harap mengisi data akun Bank Anda untuk tujuan pengiriman dana yang akan Anda tarik</p>
				<form class="form-horizontal" id="frmModalBank" action="#" method="POST" role="form">
					<div class="form-group">
						<label class="col-sm-3 control-label">No Rekening Tujuan</label>
						<div class="col-sm-6">
							<input type="number" class="form-control" id="fMnorek" name="fMnorek" required="required">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">Bank Tujuan</label>
						<div class="col-sm-6">
							<input type="text" class="form-control" id="fMbank" name="fMbank" required="required">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">Nama Pemilik Rekening</label>
						<div class="col-sm-6">
							<input type="text" class="form-control" id="fMnama" name="fMnama" required="required">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label"></label>
						<div class="col-sm-6">
							<button type="submit" class="btn btn-primary">Submit</button>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function() {
		let total_saldo = function load_total_saldo() {
			$.ajax({
				url: base_url + 'admin/orders/total-saldo',
				type: 'get',
				dataType: 'json',
				success: function(response) {
					$('#total-order').html(response.total_rp);
					$('#total-saldo').html(response.saldo_rp);
				}
			});
		};

		total_saldo();

		$('#frmModalBank').on('submit', function(e) {
			e.preventDefault();
			let norek = $('#fMnorek').val();
			let bank = $('#fMbank').val();
			let nama = $('#fMnama').val();

			$.ajax({
				url: base_url + 'admin/bank/create',
				type: 'POST',
				dataType: 'JSON',
				data: {
					fnorek: norek,
					fbank: bank,
					fnama: nama
				},
				success: function(data) {
					if (data === 'success') {
						$('modalBtnBank').modal('hide');
						window.location.href = "<?= base_url('admin/saldo/withdraw'); ?>";
					} else {
						alert('There is an error while saving data');
					}
				},
				error: function(jqXHR, textStatus, errorThrown) {
					console.log('ERRORS: ' + textStatus + ' - ' + errorThrown);
				}
			});
		});
	});
</script>
