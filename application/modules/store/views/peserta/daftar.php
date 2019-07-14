	<!-- Main content -->
	<section class="content">
		<div class="box box-solid">
			<div class="box-header with-border text-center">
				<h3 class="box-title"><?= $contentTitle; ?></h3>
			</div>
			<div class="box-body">

				<div class="col-md-6">
					<p class="login-box-msg">
						<?= empty($this->session->flashdata('success')) ? '' : '<span class="text-success">' . $this->session->flashdata('success') . '</span>'; ?>
						<?= empty($this->session->flashdata('error')) ? '' : '<span class="text-danger">' . $this->session->flashdata('error') . '</span>'; ?>
					</p>
					<!-- form start -->
					<form method="POST" action="<?= base_url('peserta/submit'); ?>" class="form-horizontal">
						<div class="box-body">
							<div class="form-group">
								<label for="reg_nama" class="col-sm-3 control-label">Nama Lengkap <span class="text-danger">*</span></label>

								<div class="col-sm-9">
									<input type="text" class="form-control" id="reg_nama" name="reg_nama" placeholder="Nama Lengkap" required="required">
								</div>
							</div>
							<div class="form-group">
								<label for="reg_email" class="col-sm-3 control-label">Email <span class="text-danger">*</span></label>

								<div class="col-sm-9">
									<input type="email" class="form-control" id="reg_email" name="reg_email" placeholder="Email" required="required">
								</div>
							</div>
							<div class="form-group">
								<label for="reg_username" class="col-sm-3 control-label">Username <span class="text-danger">*</span></label>

								<div class="col-sm-9">
									<input type="text" class="form-control" id="reg_username" name="reg_username" placeholder="Username" required="required">
								</div>
							</div>
							<div class="form-group">
								<label for="reg_password" class="col-sm-3 control-label">Password <span class="text-danger">*</span></label>

								<div class="col-sm-9">
									<input type="password" class="form-control" id="reg_password" name="reg_password" placeholder="Password">
								</div>
							</div>
							<div class="form-group">
								<label for="reg_address" class="col-sm-3 control-label">Alamat Lengkap</label>

								<div class="col-sm-9">
									<textarea id="reg_address" name="reg_address" class="form-control" rows="3" placeholder="Alamat Lengkap"></textarea>
								</div>
							</div>
							<div class="form-group">
								<label for="reg_phone" class="col-sm-3 control-label">No. Telepon</label>

								<div class="col-sm-9">
									<input type="number" class="form-control" id="reg_phone" name="reg_phone" placeholder="No. Telepon">
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-offset-3 col-sm-9">
									<div class="checkbox">
										<label>
											<input type="checkbox" id="reg_tnc" name="reg_tnc"> Syarat &amp; Ketentuan
										</label>
									</div>
								</div>
							</div>
						</div>
						<!-- /.box-body -->
						<div class="box-footer">
							<button type="reset" class="btn btn-default">Cancel</button>
							<button type="submit" class="btn btn-info pull-right">Submit</button>
						</div>
						<!-- /.box-footer -->
					</form>
				</div>

				<div class="col-md-6">
					<h3>Ketentuan Registrasi</h3>
					<p>
						rehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3
						wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum
						eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla
						assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred
						nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer
						farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus
						labore sustainable VHS.
					</p>
				</div>

			</div>
		</div>
	</section>
