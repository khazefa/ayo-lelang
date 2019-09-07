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
						<form class="form-horizontal" role="form" action="<?= base_url('peserta/finish-order'); ?>" method="post" id="payment-info">
							<input type="hidden" name="id" value="<?= $no_order; ?>" readonly="readonly">
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
											<b>Shipping Information</b>
										</a>
									</h4>
								</div>
								<div id="collapseThree" class="panel-collapse collapse in">
									<div class="panel-body">
										<span class='payment-errors'></span>
										<fieldset>
											<legend>No Resi Pesanan Anda: <strong><?= $order[0]['order_no_resi']; ?></strong></legend>
											<p>
												Anda dapat mengecek resi pengiriman Anda jika menggunakan JNE dengan meng-klik Link berikut:
												<a href="https://cekresi.com/cek-jne-express-logistic2.php?noresi=<?= $order[0]['order_no_resi']; ?>" target="_blank">Cek Resi</a>
											</p>

											<div class="col-md-12">
												<h4>
													Apakah barang yang Anda pesan sudah Anda terima ?
												</h4>
												<div class="radio">
													<label>
														<input type="radio" name="order_accept" id="order_accept" value="received" checked="checked">
														Yes
													</label>
												</div>
												<br>
											</div>

										</fieldset>
										<button type="submit" id="btn_finish_order" class="btn btn-success btn-lg" style="width:100%;" disabled="disabled">Finish Order
										</button>
										<br />
										<div style="text-align: left;"><br />
											Terimakasih telah ber-belanja barang lelang di website Kami. Semoga Anda berkenan.
										</div>
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
