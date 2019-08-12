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
									<th>Foto Barang</th>
									<th>Nama Barang</th>
									<th>Peserta</th>
									<th>Jumlah Tawaran</th>
									<th>Waktu Tawaran</th>
									<th>Tipe Tawaran</th>
									<th>Status</th>
									<th>&nbsp;</th>
								</tr>
							</thead>
							<tbody>
								<?php
								foreach ($records as $r) {
									$id = $r['id'];
									$item_img = '<img src="' . base_url() . '/uploads/products/' . $r['item_img'] . '" width="100px">';
									$item_id = $r['item_id'];
									$item_name = $r['item_name'];
									$bidder_name = $r['bidder_name'];
									$bid_price = $r['bid_price'];
									$bid_price_rp = "Rp. " . format_rupiah($bid_price);
									$bid_time = date('d/m/Y H:i:s', strtotime($r['bid_time']));
									$bid_type = strtoupper($r['bid_type']);
									$bid_status = strtoupper($r['bid_status']);

									$button = '<div class="btn-group" role="group">';
									$button .= '<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									Action
									<span class="caret"></span>
									</button>';
									$button .= '<ul class="dropdown-menu">';
									if ( strtolower($bid_status) === 'rejected' ) 
									{

									}elseif ( strtolower($bid_status) === 'accepted' ) 
									{
										$button .= '<li><a href="' . base_url('admin/bid/reject/') . $id . '"><i class="fa fa-ban"></i> Reject</a></li>';
									} else
									{
										$button .= '<li><a href="' . base_url('admin/bid/accept/'. $id .'/'. $item_id). '"><i class="fa fa-check-circle-o"></i> Accept</a></li>';
										$button .= '<li><a href="' . base_url('admin/bid/reject/') . $id . '"><i class="fa fa-ban"></i> Reject</a></li>';
									}
									$button .= '</ul>';
									$button .= '</div>';

									echo '<tr>';
									echo '<td>' . $item_img . '</td>';
									echo '<td>' . $item_name . '</td>';
									echo '<td>' . $bidder_name . '</td>';
									echo '<td>' . $bid_price_rp . '</td>';
									echo '<td>' . $bid_time . '</td>';
									echo '<td>' . $bid_type . '</td>';
									echo '<td>' . $bid_status . '</td>';
									echo '<td>' . $button .'</td>';
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
