<!-- Main content -->
<section class="content">
	<div class="col-md-2">
		<div class="list-group">
			<a href="<?= base_url('peserta/profil'); ?>" class="list-group-item"><i class="fa fa-user"></i> Profil</a>
			<a href="<?= base_url('peserta/status-bid'); ?>" class="list-group-item active">
				<i class="fa fa-gavel"></i> Status Bid
			</a>
			<a href="<?= base_url('peserta/invoice'); ?>" class="list-group-item"><i class="fa fa-file-text-o"></i> Invoice</a>
			<a href="<?= base_url('signout'); ?>" class="list-group-item"><i class="fa fa-sign-out"></i> Logout</a>
		</div>
	</div>

	<div class="col-md-10">
		<div class="box box-solid">
			<div class="box-header with-border text-center">
				<h3 class="box-title"><?= $contentTitle; ?></h3>
			</div>
			<div class="box-body">
				<div class="col-md-12">

					<div class="shopping_cart">
						<form class="form-horizontal" role="form" action="" method="post" id="payment-form">
							<div class="panel-group" id="accordion">
								<div class="panel panel-default">
									<div class="panel-heading">
										<h4 class="panel-title">
											<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Review
												Your Order</a>
										</h4>
									</div>
									<div id="collapseOne" class="panel-collapse collapse in">
										<div class="panel-body">
											<div class="items">
												<div class="col-md-9">
													<table class="table table-striped">
														<?php
														$item_name =
															$records_produk[0]['nama_lelang'];
														$item_price = $records_bid[0]['jumlah_tawaran'];
														$item_price_rp = "Rp. " . format_rupiah($item_price);
														?>
														<tr>
															<td colspan="2">
																<!--
																<a class="btn btn-warning btn-sm pull-right" href="#" title="Cancel Item">X</a>
																-->
																<strong>
																	Detail Order</strong>
															</td>
														</tr>
														<tr>
															<td>
																<?= $item_name; ?>
															</td>
															<td>
																<strong>
																	<?= $item_price_rp; ?>
																</strong>
															</td>
														</tr>
													</table>
													<table class="table table-striped">
														<tr>
															<td colspan="2">
																<strong>Shipping Detail</strong>
															</td>
														</tr>
														<tr>
															<td>
																<?php
																echo nl2br($records_peserta[0]['alamat_peserta']);
																echo "<br>";
																echo $records_kota[0]['nama_kota'];
																echo "<br>";

																$ongkir = $records_ongkir[0]['jumlah_biaya_kirim'];
																$ongkir_rp = format_rupiah($ongkir);
																?>
															</td>
															<td>
																Shipping Fee<br>
																<strong>Rp. <?= $ongkir_rp; ?></strong>
															</td>
														</tr>
													</table>

												</div>
												<div class="col-md-3">
													<div style="text-align: center;">
														<?php
														$total = $item_price + $ongkir;
														$total_rp = "Rp. " . format_rupiah($total);
														?>
														<h3>Order Total</h3>
														<h3><span style="color:green;"><?= $total_rp; ?></span></h3>
													</div>
												</div>
											</div>
										<button type="submit" class="btn btn-success btn-lg" style="width:100%;">Checkout
										</button>
										</div>
									</div>

								</div>
							</div>

							<!--
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
											<b>Payment Information</b>
										</a>
									</h4>
								</div>
								<div id="collapseThree" class="panel-collapse collapse">
									<div class="panel-body">
										<span class='payment-errors'></span>
										<fieldset>
											<legend>Bank Transfer</legend>
											<p>
												Kami menerima pembayaran dari berbagai Bank di Indonesia dengan melalui berbagai cara, diantaranya adalah melalui Internet Banking, Transfer ATM, m-Banking, SMS Banking, Setoran Tunai maupun Phone Banking. Semua pembayaran produk lelang dapat dilakukan melalui rekening bank berikut:
											</p>

											<div class="row">
												<!- - 
													Panel Bank Transfer Info
												- ->
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

												<!- - 
													Panel Bank Transfer Info
												- ->
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
												<!- - 
												Panel Bank Transfer Info
												- ->
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

												<!- - 
												Panel Bank Transfer Info
												- ->
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
										<button type="submit" class="btn btn-success btn-lg" style="width:100%;">Checkout
										</button>
										<br />
										<div style="text-align: left;"><br />
											Setelah melakukan pembayaran, silahkan konfirmasi pembayaran melalui Invoice Area > List Order > Pilih Tombol Konfirmasi pada Order Anda. Kami akan memproses order Anda setelah konfirmasi dilakukan.
										</div>
									</div>
								</div>
							</div>
							-->
						</form>
					</div>

				</div>
			</div>
		</div>
	</div>

</section>
