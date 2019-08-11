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

					<div class="table-responsive">
						<table id="grid_status_bid" class="table table-bordered table-hover">
							<thead>
								<tr>
									<th>&nbsp;</th>
									<th>Item</th>
									<th>Bid Price</th>
									<th>Bid Time</th>
									<th>Bid Type</th>
									<th>Bid Status</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
								<?php
								foreach ($records_bid as $r) {
									$id = (int) $r['id'];
									$peserta_id = (int) $r['peserta_id'];
									$item_id = (int) $r['item_id'];
									$item_name = "<a href='" . base_url('produk/detail/' . $r['item_id']) ."'>". $r['item_name']."</a>";
									$item_img = $r['item_img'];
									$foto = '<img src="' . base_url() . '/uploads/products/' . $item_img . '" width="100px">';
									$bid_type = strtoupper($r['bid_type']);
									$bid_price = (int) $r['bid_price'];
									$bid_price_rp = "Rp. " . format_rupiah($bid_price);
									$bid_time = date('d/m/Y H:i:s', strtotime($r['bid_time']));
									$bid_status = strtoupper($r['bid_status']);

									$bid_button = "";
									$bid_button .= '<a class="btn btn-danger btn-sm" href="' . base_url('bid/delete/') . $id . '"><i class="fa fa-trash"></i> Del</a>';

									if ($bid_type === "BIN") {
										if ($bid_status === "ACCEPTED") {
											$bid_button .= ' <a class="btn btn-success btn-sm" href="' . base_url('bid/pay/') . $id . '"><i class="fa fa-money"></i> Pay</a>';
										}
									} elseif ($bid_type === "BID") {
										if ($bid_status === "REJECTED") {

										}
										elseif ($bid_status === "ACCEPTED") {
											$bid_button .= ' <a class="btn btn-success btn-sm" href="' . base_url('bid/pay/') . $id . '"><i class="fa fa-money"></i> Pay</a>';
										}
										else
										{
											$bid_button .= ' <a class="btn btn-warning btn-sm btn-up-bid" data-toggle="modal" data-target="#modal-up-bid" data-id="' . $id . '" data-item-id="' . $r['item_id'] . '" data-price="' . $bid_price . '"><i class="fa fa-hand-o-up"></i> Up</a>';
										}
									}

									echo '<tr>';
									echo '<td>' . $foto . '</td>';
									echo '<td>' . $item_name . '</td>';
									echo '<td>' . $bid_price_rp . '</td>';
									echo '<td>' . $bid_time . '</td>';
									echo '<td>' . $bid_type . '</td>';
									echo '<td>' . $bid_status . '</td>';
									echo '<td>' . $bid_button . '</td>';
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
