<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<!-- Default box -->
			<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title"><?= $contentTitle; ?></h3>

					<div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
							<i class="fa fa-minus"></i>
						</button>
					</div>
				</div>

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

					<div class="table-responsive">
						<table id="data-bid" class="table table-bordered table-hover">
							<thead>
								<tr>
									<th>Order Num</th>
									<th>Order Date</th>
									<th>Item</th>
									<th>Order Total</th>
									<th>Bidder</th>
									<th>Auctioner</th>
									<th>Status</th>
									<th>&nbsp;</th>
								</tr>
							</thead>
							<tbody>
								<?php
								foreach ($records as $r) {
									$id = (int) $r['id'];
									$confirm_id = (int) $r['confirm_id'];
									$order_num = $r['order_num'];
									$order_date = date('d/m/Y H:i:s', strtotime($r['order_date']));
									$peserta_id = (int) $r['peserta_id'];
									$item_id = (int) $r['item_id'];
									$item_name = "<a href='" . base_url('produk/detail/' . $r['item_id']) . "' target='_blank'>" . $r['item_name'] . "</a>";
									$item_img = $r['item_img'];
									$foto = '<img src="' . base_url() . '/uploads/products/' . $item_img . '" width="100px">';
									$item_status = $r['item_status'];
									$bid_type = strtoupper($r['bid_type']);
									$bidder = strtoupper($r['bidder']);
									$auctioner = strtoupper($r['auctioner']);
									$order_total = (int) $r['order_total'];
									$order_total_rp = "Rp. " . format_rupiah($order_total);
									$order_status = strpos($r['order_status'], '_') !== false ? strtoupper(str_replace('_', ' ', $r['order_status'])) : strtoupper($r['order_status']);

									$button = '<div class="btn-group" role="group">';
									$button .= '<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									Action
									<span class="caret"></span>
									</button>';
									$button .= '<ul class="dropdown-menu">';
									if ( strtolower($order_status) === 'order' || strtolower($order_status) === 'verify pay' ) {
										$button .= '<li><a href="' . base_url('admin/orders/verify/') . $order_num . '"><i class="fa fa-circle-o-notch"></i> Verify Payment</a></li>';
									} elseif (strtolower($order_status) === 'paid') {
										$button .= '<li><a href="' . base_url('admin/orders/verify/') . $order_num . '"><i class="fa fa-circle-o-notch"></i> Paid to Auctioner</a></li>';
									} else {
										$button .= '<li><a href="#"><i class="fa fa-bars"></i></a></li>';
									}
									$button .= '</ul>';
									$button .= '</div>';

									echo '<tr>';
									echo '<td>' . $order_num . '</td>';
									echo '<td>' . $order_date . '</td>';
									echo '<td>' . $item_name . '</td>';
									echo '<td>' . $order_total_rp . '</td>';
									echo '<td>' . $bidder . '</td>';
									echo '<td>' . $auctioner . '</td>';
									echo '<td>' . $order_status . '</td>';
									echo '<td>' . $button . '</td>';
									echo '</tr>';
								}
								?>
							</tbody>
						</table>
					</div>
				</div>
			</div>

		</div>
	</div>
</section>
<!-- /.content -->
