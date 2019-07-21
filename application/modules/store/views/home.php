<section class="content-header">
	<div id="myCarousel" class="carousel slide" data-ride="carousel">
		<!-- Indicators -->
		<ol class="carousel-indicators">
			<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
			<li data-target="#myCarousel" data-slide-to="1"></li>
			<li data-target="#myCarousel" data-slide-to="2"></li>
		</ol>

		<!-- Wrapper for slides -->
		<div class="carousel-inner">

			<div class="item active">
				<img src="https://picsum.photos/728/240?random=1" alt="Los Angeles" style="width:100%;">
				<div class="carousel-caption">
					<h3>Los Angeles</h3>
					<p>LA is always so much fun!</p>
				</div>
			</div>

			<div class="item">
				<img src="https://picsum.photos/728/240?random=2" alt="Chicago" style="width:100%;">
				<div class="carousel-caption">
					<h3>Chicago</h3>
					<p>Thank you, Chicago!</p>
				</div>
			</div>

			<div class="item">
				<img src="https://picsum.photos/728/240?random=3" alt="New York" style="width:100%;">
				<div class="carousel-caption">
					<h3>New York</h3>
					<p>We love the Big Apple!</p>
				</div>
			</div>

		</div>

		<!-- Left and right controls -->
		<a class="left carousel-control" href="#myCarousel" data-slide="prev">
			<span class="glyphicon glyphicon-chevron-left"></span>
			<span class="sr-only">Previous</span>
		</a>
		<a class="right carousel-control" href="#myCarousel" data-slide="next">
			<span class="glyphicon glyphicon-chevron-right"></span>
			<span class="sr-only">Next</span>
		</a>
	</div>
</section>
<!-- Main content -->
<section class="content">
	<div class="box box-solid">
		<div class="box-header with-border text-center">
			<h3 class="box-title">Katalog Lelang Hari Ini</h3>
		</div>
		<div class="box-body">
			<div class="row">
				<?php
				if (count($rs_produk) > 0) {
					foreach ($rs_produk as $rp) {
						$id = (int) $rp['id_lelang'];
						$short_desc = text_shorter($rp['keterangan'], 75);
						$price = (int) $rp['harga_awal'];
						$price_idr = format_rupiah($price);
						?>
						<div class="col-md-3">
							<div class="box box-warning box-solid">
								<div class="box-header with-border">
									<h3 class="box-title wrapping-text"><?= $rp['nama_lelang']; ?></h3>
									<!-- /.box-tools -->
								</div>
								<!-- /.box-header -->
								<div class="box-body">
									<a href="<?= base_url('produk/detail/' . $rp['id_lelang']); ?>">
										<img class="img-responsive img-carbox" src="<?= base_url('uploads/products/' . $rp['gambar_produk']); ?>" alt="<?= $rp['nama_lelang']; ?>">
									</a>
									<p class="text-default"><?= $short_desc; ?></p>
									<div class="price">
										<h5>Mulai dari <strong class="text-danger"><?= $price_idr; ?></strong></h5>
									</div>
								</div>
								<div class="box-footer">
									<div class="pull-left">
										<button type="button" class="btn btn-success btn-block btn-bin" data-id="<?= $id; ?>">Buy It Now!</button>
									</div>
									<div class="pull-right">
										<button type="button" class="btn btn-danger btn-block btn-bid" data-toggle="modal" data-target="#modal-bid" data-id="<?= $id; ?>" data-price="<?= $price; ?>">Bid Now!</button>
									</div>
								</div>
								<!-- /.box-body -->
							</div>
							<!-- /.box -->
						</div>
						<!-- /.col -->
					<?php
					}
				} else {
					?>
					<div class="col-md-12">
						<div class="alert alert-info">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							Maaf belum ada produk untuk dilelang pada hari ini.
						</div>

					</div>
				<?php
				}
				?>
			</div>
			<!-- Paginate -->
			<div class="row">
				<div class="col">
					<!--Tampilkan pagination-->
					<?php echo $pagination; ?>
				</div>
			</div>
		</div>
		<!-- /.box-body -->
	</div>
	<!-- /.box -->
</section>
<!-- /.content -->
</div>
<!-- /.container -->

<script type="text/javascript">
	// A $( document ).ready() block.
	/*
	$(document).ready(function() {
		$('#pagination').on('click', 'a', function(e) {
			e.preventDefault();
			var pageno = $(this).attr('data-ci-pagination-page');
			loadPagination(pageno);
		});

		loadPagination(0);

		function loadPagination(pagno) {
			$.ajax({
				url: '/home/list_json/' + pagno,
				type: 'get',
				dataType: 'json',
				success: function(response) {
					$('#pagination').html(response.pagination);
					createTable(response.result, response.row);
				}
			});
		}

		function createTable(result, sno) {
			sno = Number(sno);
			$('#postsList tbody').empty();
			for (index in result) {
				var id = result[index].id;
				var title = result[index].title;
				var content = result[index].slug;
				content = content.substr(0, 60) + " ...";
				var link = result[index].slug;
				sno += 1;

				var tr = "<tr>";
				tr += "<td>" + sno + "</td>";
				tr += "<td><a href='" + link + "' target='_blank' >" + title + "</a></td>";
				tr += "</tr>";
				$('#postsList tbody').append(tr);

			}
		}
	});
	*/
</script>
