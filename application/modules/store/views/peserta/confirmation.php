<!-- Main content -->
<section class="content">
	<div class="col-md-2">
		<div class="list-group">
			<a href="<?= base_url('peserta/profil'); ?>" class="list-group-item"><i class="fa fa-user"></i> Profil</a>
			<a href="<?= base_url('peserta/status-bid'); ?>" class="list-group-item">
				<i class="fa fa-gavel"></i> Status Bid
			</a>
			<a href="<?= base_url('peserta/list-invoice'); ?>" class="list-group-item active"><i class="fa fa-file-text-o"></i> Invoice</a>
			<a href="<?= base_url('signout'); ?>" class="list-group-item"><i class="fa fa-sign-out"></i> Logout</a>
		</div>
	</div>

	<div class="col-md-10">
		<div class="box box-solid">
			<div class="box-header with-border text-center">
				<h3 class="box-title"><?= $contentTitle; ?></h3>
				<div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="Back" onclick="window.history.go(-1); return false;">
						<i class="fa fa-reply"></i> Back
					</button>
				</div>
			</div>
			<div class="box-body">
				<div class="col-md-12">

					<div class="payment_info">
						<form class="form-horizontal" role="form" action="<?= base_url('peserta/add-pay'); ?>" method="post" enctype="multipart/form-data" id="payment-form">
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
											<b>Payment Confirmation</b>
										</a>
									</h4>
								</div>
								<div id="collapseThree" class="panel-collapse collapse in">
									<div class="panel-body">
										<span class='payment-errors'></span>
										<fieldset>
											<legend>Confirmation Form</legend>
											<p>
												Harap menginput data konfirmasi pembayaran Anda dengan benar dan lengkap agar dapat mempermudah proses konfirmasi pembayaran Order Anda.
											</p>
											<div class="form-group">
												<label for="no_trans" class="col-sm-3 control-label">No. Order</label>

												<div class="col-sm-6">
													<input type="text" class="form-control" id="no_trans" name="no_trans" value="<?= $no_order; ?>" readonly="readonly">
												</div>
											</div>
											<div class="form-group">
												<label for="no_rek" class="col-sm-3 control-label">No. Rekening <span class="text-danger">*</span></label>

												<div class="col-sm-6">
													<input type="text" class="form-control" id="no_rek" name="no_rek" placeholder="No. Rekening" required="required">
												</div>
											</div>
											<div class="form-group">
												<label for="rek_bank" class="col-sm-3 control-label">Nama Bank <span class="text-danger">*</span></label>

												<div class="col-sm-6">
													<input type="text" class="form-control" id="rek_bank" name="rek_bank" placeholder="Nama Bank" required="required">
												</div>
											</div>
											<div class="form-group">
												<label for="rek_nama" class="col-sm-3 control-label">Nama Lengkap <span class="text-danger">*</span></label>

												<div class="col-sm-6">
													<input type="text" class="form-control" id="rek_nama" name="rek_nama" placeholder="<?= $name; ?>" required="required">
												</div>
											</div>
											<div class="form-group">
												<label for="tgl_transfer" class="col-sm-3 control-label">Tgl. Transfer <span class="text-danger">*</span></label>

												<div class="col-sm-4">
													<div class='input-group date datetimepicker1'>
														<input type='text' class="form-control" id="tgl_transfer" name="tgl_transfer" placeholder="2019-01-01 00:00:00" required="required" />
														<span class=" input-group-addon">
															<span class="glyphicon glyphicon-calendar"></span>
														</span>
													</div>
												</div>
											</div>
											<div class="form-group">
												<label for="jml_transfer" class="col-sm-3 control-label">Nominal Transfer <span class="text-danger">*</span></label>

												<div class="col-sm-3">
													<input type="number" class="form-control" id="jml_transfer" name="jml_transfer" min="100" placeholder="100" required="required">
												</div>
											</div>
											<div class="form-group">
												<label for="bank_transfer" class="col-sm-3 control-label">Bank Tujuan Pembayaran <span class="text-danger">*</span></label>

												<div class="col-sm-6">
													<select class="form-control" id="bank_transfer" name="bank_transfer" required="required">
														<option selected>-Bank Tujuan-</option>
														<option value="BCA - 0283116411">BCA - 0283116411</option>
														<option value="BRI - 040901000391111">BRI - 040901000391111</option>
														<option value="BNI - 3300031111">BNI - 3300031111</option>
														<option value="MANDIRI - 1030006052222">MANDIRI - 1030006052222</option>
													</select>
												</div>
											</div>
											<div class="form-group">
												<label for="bukti_transfer" class="col-sm-3 control-label">Upload Bukti Transfer <span class="text-danger">*</span></label>

												<div class="col-sm-3">
													<input type="file" class="form-control" id="bukti_transfer" name="bukti_transfer" required="required">
												</div>
											</div>

										</fieldset>
									</div>
									<!-- /.panel-body -->
									<div class="panel-footer">
										<button type="submit" class="btn btn-block btn-primary">Submit</button>
										<!-- /.panel-footer -->
									</div>
								</div>
							</div>

						</form>
					</div>

				</div>
			</div>
		</div>
	</div>

</section>
