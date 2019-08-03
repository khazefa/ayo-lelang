<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-8 offset-md-4">
            <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">
					<button type="button" class="btn btn-default" onclick="location.href='<?php echo base_url('admin/kategori/add');?>'" title="Add New">
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
									<th>Deskripsi</th>
									<th>&nbsp;</th>
								</tr>
                            </thead>
                            <tbody>
								<?php
									foreach ($records as $r) {
										$id = $r['id_kategori'];

										$button = '<div class="btn-group" role="group">';
										$button .= '<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
																		Action
																		<span class="caret"></span>
																		</button>';
										$button .= '<ul class="dropdown-menu">';
										$button .= '<li><a href="' . base_url('admin/kategori/edit/') . $id . '"><i class="fa fa-edit"></i> Edit</a></li>';
										$button .= '<li><a href="' . base_url('admin/kategori/delete/') . $id . '"><i class="fa fa-trash"></i> Remove</a></li>';
										$button .= '</ul>';
										$button .= '</div>';

										echo '<tr>';
											echo '<td>'.$r['nama_kategori'].'</td>';
											echo '<td>'.$r['alias_kategori'].'</td>';
											echo '<td>'.$r['deskripsi_kategori'].'</td>';
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
