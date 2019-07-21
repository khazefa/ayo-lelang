		</div>
		<!-- /.container -->
		</div>
		<!-- /.content-wrapper -->
		<footer class="main-footer">
			<div class="container">
				<div class="pull-right hidden-xs">
					<?= SITE_NAME; ?>
				</div>
				<strong>Copyright &copy; 2019 <a href="#">Salman</a>.</strong> All rights reserved.
			</div>
			<!-- /.container -->
		</footer>
		</div>
		<!-- ./wrapper -->

		<div class="modal fade" id="modal-bid">
			<div class="modal-dialog modal-sm">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">Input Harga Bid Anda!</h4>
					</div>
					<div class="modal-body">
						<form action="<?= base_url('bid/add'); ?>" id="mdl_bid_form" method="POST" class="form-inline" role="form">
							<input type="hidden" id="mdl_bid_id" name="mdl_bid_id" value="0">
							<div class="form-group">
								<label class="sr-only" for="">Harga Bid</label>
								<input type="number" class="form-control" id="mdl_bid_price" name="mdl_bid_price" min="5000" required="required" placeholder="Harga Bid">
							</div>
							<button type="submit" class="btn btn-primary">Submit</button>
						</form>

					</div>
				</div>
				<!-- /.modal-content -->
			</div>
			<!-- /.modal-dialog -->
		</div>
		<!-- /.modal -->

		<div class="modal fade" id="modal-up-bid">
			<div class="modal-dialog modal-sm">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">Input Harga Bid Anda!</h4>
					</div>
					<div class="modal-body">
						<form action="<?= base_url('bid/up'); ?>" id="mdl_bid_form" method="POST" class="form-inline" role="form">
							<input type="hidden" id="mdl_up_bid_id" name="mdl_up_bid_id" value="0">
							<div class="form-group">
								<label class="sr-only" for="">Harga Bid</label>
								<input type="number" class="form-control" id="mdl_up_bid_price" name="mdl_up_bid_price" min="5000" required="required" placeholder="Harga Bid">
							</div>
							<button type="submit" class="btn btn-primary">Submit</button>
						</form>

					</div>
				</div>
				<!-- /.modal-content -->
			</div>
			<!-- /.modal-dialog -->
		</div>
		<!-- /.modal -->

		<!-- DataTables -->
		<script src="<?= base_url('assets/datatables.net/js/jquery.dataTables.min.js'); ?>"></script>
		<script src="<?= base_url('assets/datatables.net-bs/js/dataTables.bootstrap.min.js'); ?>"></script>
		<!-- SlimScroll -->
		<script src="<?= base_url('assets/jquery-slimscroll/jquery.slimscroll.min.js'); ?>"></script>
		<!-- FastClick -->
		<script src="<?= base_url('assets/fastclick/lib/fastclick.js'); ?>"></script>
		<!-- AdminLTE App -->
		<script src="<?= base_url('assets/js/adminlte.min.js'); ?>"></script>
		<script>
			var base_url = "<?= base_url(); ?>";
		</script>
		<script src="<?= base_url('assets/js/custom.js'); ?>"></script>
		</body>

		</html>
