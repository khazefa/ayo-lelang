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
						<form class="form-horizontal" role="form" action="<?= base_url('peserta/confirm-pay'); ?>" method="post" id="payment-info">
						<input type="hidden" name="id" value="<?= $no_order; ?>" readonly="readonly">
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
											<b>Payment Information</b>
										</a>
									</h4>
								</div>
								<div id="collapseThree" class="panel-collapse collapse in">
									<div class="panel-body">
										<span class='payment-errors'></span>
										<fieldset>
											<legend>Bank Transfer</legend>
											<p>
												Kami menerima pembayaran dari berbagai Bank di Indonesia dengan melalui berbagai cara, diantaranya adalah melalui Internet Banking, Transfer ATM, m-Banking, SMS Banking, Setoran Tunai maupun Phone Banking. Semua pembayaran produk lelang dapat dilakukan melalui rekening bank berikut:
											</p>

											<div class="row">
												<!-- 
													Panel Bank Transfer Info
												-->
												<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
													<div class="panel panel-primary">
														<div class="panel-heading text-center">
															<img src="<?= base_url('assets/img/bank/bca.png'); ?>">
														</div>
														<div class="panel-body">
															<ul>
																<li>No. Rekening: 0283116411</li>
																<li>a.n: AYO LELANG</li>
															</ul>
														</div>
													</div>
												</div>

												<!-- 
													Panel Bank Transfer Info
												-->
												<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
													<div class="panel panel-primary">
														<div class="panel-heading text-center">
															<img src="<?= base_url('assets/img/bank/bri.png'); ?>">
														</div>
														<div class="panel-body">
															<ul>
																<li>No. Rekening: 040901000391111</li>
																<li>a.n: AYO LELANG</li>
															</ul>
														</div>
													</div>
												</div>
											</div>

											<div class="row">
												<!-- 
												Panel Bank Transfer Info
											-->
												<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
													<div class="panel panel-primary">
														<div class="panel-heading text-center">
															<img src="<?= base_url('assets/img/bank/bni.png'); ?>">
														</div>
														<div class="panel-body">
															<ul>
																<li>No. Rekening: 3300031111</li>
																<li>a.n: AYO LELANG</li>
															</ul>
														</div>
													</div>
												</div>

												<!-- 
												Panel Bank Transfer Info
											-->
												<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
													<div class="panel panel-primary">
														<div class="panel-heading text-center">
															<img src="<?= base_url('assets/img/bank/mandiri.png'); ?>">
														</div>
														<div class="panel-body">
															<ul>
																<li>No. Rekening: 1030006052222</li>
																<li>a.n: AYO LELANG</li>
															</ul>
														</div>
													</div>
												</div>
											</div>

										</fieldset>
										<button type="submit" class="btn btn-success btn-lg" style="width:100%;">Confirm Payment
										</button>
										<br />
										<div style="text-align: left;"><br />
											Setelah melakukan pembayaran, silahkan konfirmasi pembayaran. Kami akan memproses order Anda setelah konfirmasi dilakukan.
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
