<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?= empty($pageTitle) ? SITE_NAME : $pageTitle . ' - ' . SITE_NAME; ?></title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<!-- Bootstrap 3.3.7 -->
	<link rel="stylesheet" href="<?= base_url('assets/bootstrap/dist/css/bootstrap.min.css'); ?>">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="<?= base_url('assets/font-awesome/css/font-awesome.min.css'); ?>">
	<!-- Ionicons -->
	<link rel="stylesheet" href="<?= base_url('assets/Ionicons/css/ionicons.min.css'); ?>">
	<!-- DataTables -->
	<link rel="stylesheet" href="<?= base_url('assets/datatables.net-bs/css/dataTables.bootstrap.css'); ?>">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?= base_url('assets/css/AdminLTE.min.css'); ?>">
	<link rel="stylesheet" href="<?= base_url('assets/css/custom.css'); ?>">
	<!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
	<link rel="stylesheet" href="<?= base_url('assets/css/skins/_all-skins.min.css'); ?>">

	<link rel="shortcut icon" href="<?= base_url('assets/img/ic-auction.png'); ?>">

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

	<!-- Google Font -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
	<!-- jQuery 3 -->
	<script src="<?= base_url('assets/jquery/dist/jquery.min.js'); ?>"></script>
	<!-- Bootstrap 3.3.7 -->
	<script src="<?= base_url('assets/bootstrap/dist/js/bootstrap.min.js'); ?>"></script>
	<script>
		var base_url = "<?= base_url(); ?>";
		var request;
		var arr_id = [];
	</script>
	<script src="<?= base_url('assets/js/custom-store.js'); ?>" type="text/javascript"></script>
	<script src="<?= base_url('assets/js/custom-store-el.js'); ?>" ></script>
</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->

<body class="hold-transition skin-green layout-top-nav">
	<div class="wrapper">

		<header class="main-header">
			<nav class="navbar navbar-static-top">
				<div class="container">
					<div class="navbar-header">
						<a href="<?= base_url(); ?>" class="navbar-brand"><b>Ayo</b>Lelang</a>
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
							<i class="fa fa-bars"></i>
						</button>
					</div>

					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse pull-left" id="navbar-collapse">
						<ul class="nav navbar-nav">
							<li><a href="<?= base_url('tata-cara-lelang'); ?>">Tata Cara Lelang</a></li>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">Kategori Lelang <span class="caret"></span></a>
								<ul class="dropdown-menu" role="menu">
									<?php
									foreach ($categories as $rk) {
										echo '<li><a href="' . base_url() . 'kategori/' . $rk['alias_kategori'] . '">' . $rk['nama_kategori'] . '</a></li>';
									}
									?>
								</ul>
							</li>
						</ul>
						<form class="navbar-form navbar-left" role="search">
							<div class="form-group">
								<input type="text" class="form-control" id="navbar-search-input" placeholder="Search">
							</div>
						</form>
					</div>
					<!-- /.navbar-collapse -->
					<!-- Navbar Right Menu -->
					<div class="navbar-custom-menu">
						<!--
						<ul class="nav navbar-nav">
						<li class="dropdown notifications-menu">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<i class="fa fa-shopping-cart"></i>
								<span class="label label-warning">10</span>
							</a>
							<ul class="dropdown-menu">
								<li class="header">You have 10 items</li>
								<li>
									<ul class="menu">
										<li>
											<a href="#">
												<i class="fa fa-check text-aqua"></i> Xiaomi A2
											</a>
										</li>
									</ul>
								</li>
								<li class="footer"><a href="#">View all</a></li>
							</ul>
						</li>
						</ul>
						-->
						<ul class="nav navbar-nav">
							<?php
							if ($this->session->userdata('signed_in')) {
								?>
								<li class="dropdown notifications-menu">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown"><b><?= $name; ?></b> <span class="caret"></span></a>
									<ul id="login-dp" class="dropdown-menu">
										<li class="header">Your access link</li>
										<li>
											<ul class="menu">
												<li>
													<a href="<?= base_url('peserta/profil'); ?>">
														<i class="fa fa-user text-aqua"></i> Profil
													</a>
												</li>
												<li>
													<a href="<?= base_url('peserta/status-bid'); ?>">
														<i class="fa fa-gavel text-aqua"></i> Status Bid
													</a>
												</li>
												<li>
													<a href="<?= base_url('peserta/list-invoice'); ?>">
														<i class="fa fa-file-text-o text-aqua"></i> Invoice
													</a>
												</li>
												<li>
													<a href="<?= base_url('signout'); ?>">
														<i class="fa fa-sign-out text-aqua"></i> Logout
													</a>
												</li>
											</ul>
										</li>
									</ul>
								</li>
							<?php
							} else {
								?>
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown"><b>Login</b> <span class="caret"></span></a>
									<ul id="login-dp" class="dropdown-menu">
										<li>
											<div class="row">
												<div class="col-md-12">
													<form class="form" role="form" method="post" action="<?= base_url('signin'); ?>" accept-charset="UTF-8" id="login-nav">
														<div class="form-group">
															<label class="sr-only" for="login_email">Email</label>
															<input type="email" class="form-control" id="login_email" name="login_email" placeholder="Email" required="required">
														</div>
														<div class="form-group">
															<label class="sr-only" for="login_password">Password</label>
															<input type="password" class="form-control" id="login_password" name="login_password" placeholder="Password" required="required">
														</div>
														<div class="form-group">
															<button type="submit" class="btn btn-primary btn-block">Sign in</button>
														</div>
														<div class="checkbox">
															<label>
																<input type="checkbox" name="login_remember"> tetap login
															</label>
														</div>
													</form>
												</div>
												<div class="bottom text-center">
													Belum bergabung ? <a href="<?= base_url('peserta/registrasi'); ?>"><b>Registrasi</b></a>
												</div>
											</div>
										</li>
									</ul>
								</li>
							<?php
							}
							?>
						</ul>
					</div>
					<!-- /.navbar-custom-menu -->
				</div>
				<!-- /.container-fluid -->
			</nav>
		</header>
		<!-- Full Width Column -->
		<div class="content-wrapper">
			<div class="container">
				<!-- Content Header (Page header) -->
				<section class="content-header">
					<?= empty($this->session->flashdata('success')) ? '' : '<div class="alert alert-success alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' . $this->session->flashdata('success') . '</div>'; ?>
					<?= empty($this->session->flashdata('error')) ? '' : '<div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' . $this->session->flashdata('error') . '</div>'; ?>
				</section>
