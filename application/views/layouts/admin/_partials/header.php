<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?= empty($pageTitle) ? SITE_NAME : $pageTitle . ' - ' . SITE_NAME; ?></title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="stylesheet" href="<?= base_url('assets/bootstrap/dist/css/bootstrap.min.css'); ?>">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="<?= base_url('assets/font-awesome/css/font-awesome.min.css'); ?>">
	<!-- Ionicons -->
	<link rel="stylesheet" href="<?= base_url('assets/Ionicons/css/ionicons.min.css'); ?>">
	<!-- DataTables -->
	<link rel="stylesheet" href="<?= base_url('assets/datatables.net-bs/css/dataTables.bootstrap.css'); ?>">
	<!-- Bootstrap Datetime Picker -->
	<link rel="stylesheet" href="<?= base_url('assets/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css'); ?>">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?= base_url('assets/css/AdminLTE.min.css'); ?>">
	<!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect. -->
	<link rel="stylesheet" href="<?= base_url('assets/css/skins/skin-blue.min.css'); ?>">

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
	<!-- Moment JS -->
	<script src="<?= base_url('assets/moment-js/moment.js'); ?>"></script>
	<!-- Bootstrap Transition JS -->
	<script src="<?= base_url('assets/bootstrap/js/transition.js'); ?>"></script>
	<!-- Bootstrap Collapse JS -->
	<script src="<?= base_url('assets/bootstrap/js/collapse.js'); ?>"></script>
	<!-- Bootstrap 3.3.7 -->
	<script src="<?= base_url('assets/bootstrap/dist/js/bootstrap.min.js'); ?>"></script>
	<!-- Bootstrap Datetime Picker -->
	<script src="<?= base_url('assets/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js'); ?>"></script>

	<script>
		var base_url = "<?= base_url(); ?>";
	</script>

	<script src="<?= base_url('assets/js/custom-admin.js'); ?>" type="text/javascript"></script>
</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->

<body class="hold-transition skin-blue sidebar-mini">
	<div class="wrapper">

		<!-- Main Header -->
		<header class="main-header">

			<!-- Logo -->
			<a href="<?= base_url('admin/dashboard'); ?>" class="logo">
				<!-- mini logo for sidebar mini 50x50 pixels -->
				<span class="logo-mini"><b>A</b>LE</span>
				<!-- logo for regular state and mobile devices -->
				<span class="logo-lg"><b>Ayo</b>Lelang</span>
			</a>

			<!-- Header Navbar -->
			<nav class="navbar navbar-static-top" role="navigation">
				<!-- Sidebar toggle button-->
				<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
					<span class="sr-only">Toggle navigation</span>
				</a>
				<!-- Navbar Right Menu -->
				<div class="navbar-custom-menu">
					<ul class="nav navbar-nav">
						<!-- User Account Menu -->
						<li class="dropdown user user-menu">
							<!-- Menu Toggle Button -->
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<!-- The user image in the navbar-->
								<img src="<?= base_url('assets/img/user2-160x160.jpg'); ?>" class="user-image" alt="User Image">
								<!-- hidden-xs hides the username on small devices so only the image appears. -->
								<span class="hidden-xs"><?= $this->session->userdata('accName'); ?></span>
							</a>
							<ul class="dropdown-menu">
								<!-- The user image in the menu -->
								<li class="user-header">
									<img src="<?= base_url('assets/img/user2-160x160.jpg'); ?>" class="img-circle" alt="User Image">

									<p>
										<?= $this->session->userdata('accName'); ?>
									</p>
								</li>
								<!-- Menu Footer-->
								<li class="user-footer">
									<div class="pull-left">
										<?php
										if ($this->session->userdata('accRole') === "admin") {
											echo '<a href="' . base_url("admin/akun/profil/") . $this->session->userdata("accKey") . '" class="btn btn-default btn-flat">Profile</a>';
										} else {
											echo '<a href="' . base_url("admin/pelelang/profil/") . $this->session->userdata("accKey") . '" class="btn btn-default btn-flat">Profile</a>';
										}
										?>
									</div>
									<div class="pull-right">
										<a href="<?= base_url('admin/signout'); ?>" class="btn btn-default btn-flat">Sign out</a>
									</div>
								</li>
							</ul>
						</li>
						<!-- Control Sidebar Toggle Button -->
						<li>
							<a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
						</li>
					</ul>
				</div>
			</nav>
		</header>
		<!-- Left side column. contains the logo and sidebar -->
		<aside class="main-sidebar">

			<!-- sidebar: style can be found in sidebar.less -->
			<section class="sidebar">

				<!-- Sidebar user panel (optional) -->
				<div class="user-panel">
					<div class="pull-left image">
						<img src="<?= base_url('assets/img/user2-160x160.jpg'); ?>" class="img-circle" alt="User Image">
					</div>
					<div class="pull-left info">
						<p><?= $this->session->userdata('accName'); ?></p>
						<!-- Status -->
						<a href="#"><i class="fa fa-circle text-success"></i> Online</a>
					</div>
				</div>

				<!-- Sidebar Menu -->
				<ul class="sidebar-menu" data-widget="tree">
					<li class="header">NAVIGATION</li>
					<!-- Optionally, you can add icons to the links -->
					<li><a href="<?= base_url('admin/dashboard'); ?>"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
					<li class="treeview">
						<a href="#"><i class="fa fa-database"></i> <span>Produk</span>
							<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<?php
							if ($role === "auctioner") {
								?>
								<li><a href="<?= base_url('admin/produk'); ?>">Produk Lelang</a></li>
							<?php
							} else {
								?>
								<li><a href="<?= base_url('admin/kategori'); ?>">Kategori Produk Lelang</a></li>
							<?php
							}
							?>
						</ul>
					</li>
					<?php
					if ($role === "admin") {
						?>
						<li class="treeview">
							<a href="#"><i class="fa fa-truck"></i> <span>Pengiriman</span>
								<span class="pull-right-container">
									<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li><a href="<?= base_url('admin/kota'); ?>">Kota</a></li>
								<li><a href="<?= base_url('admin/biaya-kirim'); ?>">Biaya Kirim</a></li>
							</ul>
						</li>
						<li><a href="<?= base_url('admin/orders'); ?>"><i class="fa fa-money"></i> <span>Daftar Transaksi</span></a></li>
						<li><a href="<?= base_url('admin/pelelang'); ?>"><i class="fa fa-users"></i> <span>Daftar Pelelang</span></a></li>
						<li><a href="<?= base_url('admin/peserta'); ?>"><i class="fa fa-users"></i> <span>Daftar Peserta</span></a></li>
					<?php
					} elseif ($role === "auctioner") {
						?>
						<li class="treeview">
							<a href="#"><i class="fa fa-gavel"></i> <span>Bid</span>
								<span class="pull-right-container">
									<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li><a href="<?= base_url('admin/bid'); ?>">Daftar Penawaran</a></li>
								<li><a href="<?= base_url('admin/bid/orders'); ?>">Daftar Terjual</a></li>
							</ul>
						</li>
					<?php
					}
					?>
				</ul>
				<!-- /.sidebar-menu -->
			</section>
			<!-- /.sidebar -->
		</aside>

		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<section class="content-header">
				<h1>
					<?= $contentHeader; ?>
					<!-- <small>it all starts here</small> -->
				</h1>
				<!-- Use breadcrumb later
					<ol class="breadcrumb">
						<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
						<li><a href="#">Examples</a></li>
						<li class="active">Blank page</li>
					</ol>
					-->
			</section>
