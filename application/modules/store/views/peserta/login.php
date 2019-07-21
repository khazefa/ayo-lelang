	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<div class="box box-solid">
					<div class="box-header with-border text-center">
						<h3 class="box-title"><?= $contentTitle; ?></h3>
					</div>
					<div class="box-body">

						<p class="session-box-msg text-center">
							<?= empty($this->session->flashdata('error_login')) ? '' : '<span class="text-danger">' . $this->session->flashdata('error_login') . '</span>'; ?>
						</p>
						<!-- form start -->
						<form method="POST" action="<?= base_url('signin'); ?>" class="form-horizontal">
							<div class="box-body">
								<div class="form-group">
									<label for="" class="col-sm-3 control-label">Email <span class="text-danger">*</span></label>

									<div class="col-sm-9">
										<input type="email" class="form-control" name="login_email" placeholder="Email" required="required">
									</div>
								</div>
								<div class="form-group">
									<label for="" class="col-sm-3 control-label">Password <span class="text-danger">*</span></label>

									<div class="col-sm-9">
										<input type="password" class="form-control" name="login_password" placeholder="Password">
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-offset-3 col-sm-9">
										<div class="checkbox">
											<label>
												<input type="checkbox" name="login_remember"> Tetap login
											</label>
										</div>
									</div>
								</div>
							</div>
							<!-- /.box-body -->
							<div class="box-footer">
								Belum bergabung ? <a href="<?= base_url('peserta/registrasi'); ?>"><b>Registrasi</b></a>
								<button type="submit" class="btn btn-info pull-right">Sign in</button>
							</div>
							<!-- /.box-footer -->
						</form>

					</div>
				</div>
			</div>
		</div>
	</section>
