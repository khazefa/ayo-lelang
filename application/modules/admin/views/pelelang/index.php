<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<!-- Default box -->
			<div class="box">
				<div class="box-header with-border">
					<button type="button" class="btn btn-default" onclick="location.href='<?php echo base_url('admin/pelelang/add'); ?>'" title="Add New">
						<i class="fa fa-plus-circle"></i> Tambah
					</button>
					<!-- <h3 class="box-title"><?= $contentTitle; ?></h3> -->

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
						<table id="data_grid" class="table table-bordered table-hover">
							<thead>
								<tr>
									<th>Nama</th>
									<th>Email</th>
									<th>No Telepon</th>
									<th>Status</th>
									<th>Tgl Daftar</th>
									<th>&nbsp;</th>
								</tr>
							</thead>
							<tbody>
								<?php
								foreach ($records as $r) {
									$id = (int) $r['id_pelelang'];
									$akun = $r['akun_pelelang'];
									$nama = $r['nama_pelelang'];
									$email = $r['email_pelelang'];
									$telepon = $r['telepon_pelelang'];
									$status = (int)$r['status_pelelang'] === 1 ? "Active" : "Deactive";
									$tgl_daftar = indonesian_date($r['tgl_daftar_pelelang']);
									$button = '<div class="btn-group" role="group">';
									$button .= '<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
																																											Action
																																											<span class="caret"></span>
																																											</button>';
									$button .= '<ul class="dropdown-menu">';
									// $button .= '<li><a href="' . base_url('admin/pelelang/edit/') . $akun . '"><i class="fa fa-edit"></i> Edit</a></li>';
									// $button .= '<li><a href="' . base_url('admin/pelelang/delete/') . $akun . '"><i class="fa fa-trash"></i> Remove</a></li>';
									$button .= '<li><a href="' . base_url('admin/pelelang/block/') . $akun . '"><i class="fa fa-ban"></i> Block</a></li>';
									$button .= '</ul>';
									$button .= '</div>';
									echo '<tr>';
									echo '<td>' . $nama . '</td>';
									echo '<td>' . $email . '</td>';
									echo '<td>' . $telepon . '</td>';
									echo '<td>' . $status . '</td>';
									echo '<td>' . $tgl_daftar . '</td>';
									echo '<td>'.$button.'</td>';
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
