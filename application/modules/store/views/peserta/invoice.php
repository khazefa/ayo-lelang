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
			</div>
			<div class="box-body">
				<div class="col-md-12">

					<div class="table-responsive">
						<table id="grid_invoice" class="table table-bordered table-hover">
							<thead>
								<tr>
									<th>Order Num</th>
									<th>Order Date</th>
									<th>Item</th>
									<th>Order Total</th>
									<th>Status</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
								<?php
								foreach ($records_order as $r) {
									$id = (int) $r['id'];
									$order_num = $r['order_num'];
									$order_date = date('d/m/Y H:i:s', strtotime($r['order_date']));
									$peserta_id = (int) $r['peserta_id'];
									$item_id = (int) $r['item_id'];
									$item_name = "<a href='" . base_url('produk/detail/' . $r['item_id']) . "'>" . $r['item_name'] . "</a>";
									$item_img = $r['item_img'];
									$foto = '<img src="' . base_url() . '/uploads/products/' . $item_img . '" width="100px">';
									$item_status = $r['item_status'];
									$bid_type = strtoupper($r['bid_type']);
									$order_total = (int) $r['order_total'];
									$order_total_rp = "Rp. " . format_rupiah($order_total);
									$order_status = strpos($r['order_status'], '_') !== false ? strtoupper( str_replace('_', ' ', $r['order_status']) ) : strtoupper($r['order_status']);

									$order_button = "";
									if ( $r['order_status'] === 'paid' || $r['order_status'] === 'received') {
										$order_button = "-";
									} elseif ( $r['order_status'] === 'sent' ) {
										$order_button .= '<a class="btn btn-warning btn-sm" href="' . base_url('peserta/view-airwaybill/' . $order_num) . '"><i class="fa fa-truck"></i> Lihat Resi</a>';
									} else {
										$order_button .= '<a class="btn btn-warning btn-sm" href="' . base_url('peserta/pay-order/' . $order_num) . '"><i class="fa fa-money"></i> Pay</a>';
									}

									echo '<tr>';
									echo '<td>' . $order_num . '</td>';
									echo '<td>' . $order_date . '</td>';
									echo '<td>' . $item_name . '</td>';
									echo '<td>' . $order_total_rp . '</td>';
									echo '<td>' . $order_status . '</td>';
									echo '<td>' . $order_button . '</td>';
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
