  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer">
  	<!-- To the right -->
  	<div class="pull-right hidden-xs">
	  <?= SITE_NAME; ?>
  	</div>
  	<!-- Default to the left -->
  	<strong>Copyright &copy; 2019 <a href="#">Salman</a>.</strong> All rights reserved.
  </footer>

  </div>
  <!-- ./wrapper -->

  <div class="modal fade modal-change-password" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Ganti kata sandi Anda?</h4>
			</div>
			<div class="modal-body">
				<p id="forgot_msg">
					Input kata sandi baru Anda.
				</p>
				<div class="form-group has-feedback">
					<input type="password" name="change_pass" class="form-control" placeholder="Ganti Kata Sandi" required="required">
					<span class="glyphicon glyphicon-asterisk form-control-feedback"></span>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" id="btn_change_pass" class="btn btn-primary">Kirim</button>
			</div>
		</div>
	</div>
</div>
<!-- /.modal-forgot-password -->

  <!-- REQUIRED JS SCRIPTS -->

<!-- DataTables -->
<script src="<?= base_url('assets/datatables.net/js/jquery.dataTables.min.js');?>"></script>
<script src="<?= base_url('assets/datatables.net-bs/js/dataTables.bootstrap.min.js');?>"></script>
<!-- DataTables Buttons -->
<script src="<?= base_url('assets/datatables.net-buttons/js/dataTables.buttons.min.js');?>"></script>
<script src="<?= base_url('assets/datatables.net-buttons/js/buttons.html5.min.js');?>"></script>
<script src="<?= base_url('assets/datatables.net-buttons/js/buttons.print.min.js');?>"></script>
<!-- DataTables Responsive -->
<script src="<?= base_url('assets/datatables.net-responsive/js/dataTables.responsive.min.js');?>"></script>
<!-- JSZip -->
<script src="<?= base_url('assets/jszip/jszip.min.js');?>"></script>
<!-- PDF Make -->
<script src="<?= base_url('assets/pdfmake/vfs_fonts.js');?>"></script>
<script src="<?= base_url('assets/pdfmake/pdfmake.min.js');?>"></script>
<!-- SlimScroll -->
<script src="<?= base_url('assets/jquery-slimscroll/jquery.slimscroll.min.js');?>"></script>
<!-- FastClick -->
<script src="<?= base_url('assets/fastclick/lib/fastclick.js');?>"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('assets/js/adminlte.min.js'); ?>"></script>

<!-- Optionally, you can add Slimscroll and FastClick plugins.
	Both of these plugins are recommended to enhance the
	user experience. -->
</body>

</html>
