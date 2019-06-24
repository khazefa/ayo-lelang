<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">
					<button type="button" class="btn btn-default" onclick="location.href='<?php echo base_url('admin/produk/add');?>'" title="Add New">
						<i class="fa fa-plus-circle"></i> Tambah
					</button>
                    <!-- <h3 class="box-title"><?= $contentTitle;?></h3> -->

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                                title="Collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                
                <div class="box-body">
                    <p class="text-success text-center">
                        <?php
                        $error = $this->session->flashdata('error');
                        if($error)
                        {
                        ?>
                        <div class="alert alert-danger alert-dismissable" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <?php echo $error; ?>                    
                        </div>
                        <?php
                        }
                        $success = $this->session->flashdata('success');
                        if($success)
                        {
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
									<th>Alias</th>
									<th>Kategori</th>
									<th>Status</th>
									<th>&nbsp;</th>
								</tr>
                            </thead>
                            <tbody>
								<?php
									foreach ($records as $r) {
										$id = $r['id_produk'];
										echo '<tr>';
											echo '<td>'.$r['nama_produk'].'</td>';
											echo '<td>'.$r['alias_produk'].'</td>';
											echo '<td>'.$r['nama_kategori'].'</td>';
											echo '<td>'.(int) $r['status_produk'] === 1 ? "Active" : "Deactive".'</td>';
											echo '<td><a class="btn btn-warning btn-sm" href="' . base_url('admin/produk/edit/') . $id . '"><i class="fa fa-edit"></i> Edit</a> <a class="btn btn-danger btn-sm" href="' . base_url('admin/produk/delete/') . $id . '"><i class="fa fa-trash"></i> Hapus</a></td>';
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
