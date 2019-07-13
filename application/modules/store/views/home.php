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
				<img src="https://via.placeholder.com/728x240.webp/09f/fff" alt="Los Angeles" style="width:100%;">
				<div class="carousel-caption">
					<h3>Los Angeles</h3>
					<p>LA is always so much fun!</p>
				</div>
			</div>

			<div class="item">
				<img src="https://via.placeholder.com/728x240.webp/09f/fff" alt="Chicago" style="width:100%;">
				<div class="carousel-caption">
					<h3>Chicago</h3>
					<p>Thank you, Chicago!</p>
				</div>
			</div>

			<div class="item">
				<img src="https://via.placeholder.com/728x240.webp/09f/fff" alt="New York" style="width:100%;">
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
			<h3 class="box-title">Katalog Lelang Pekan Ini</h3>
		</div>
		<div class="box-body">
			<div id="postsList">
				<?php
				foreach ($records_produk as $rp) {
					?>
					<div class="col-md-3">
						<div class="box box-warning box-solid">
							<div class="box-header with-border">
								<h3 class="box-title wrapping-text"><?= $rp['nama_lelang']; ?></h3>
								<!-- /.box-tools -->
							</div>
							<!-- /.box-header -->
							<div class="box-body">
								<a href="#">
									<img class="img-responsive img-carbox" src="<?= base_url('uploads/products/' . $rp['gambar_produk']); ?>" alt="<?= $rp['nama_lelang']; ?>">
								</a>
							</div>
							<div class="box-footer">
								<div class="pull-left">
									<button type="button" class="btn btn-success btn-block">Buy It Now!</button>
								</div>
								<div class="pull-right">
									<button type="button" class="btn btn-danger btn-block">Bid Now!</button>
								</div>
							</div>
							<!-- /.box-body -->
						</div>
						<!-- /.box -->
					</div>
					<!-- /.col -->
				<?php
				}
				?>
			</div>
			<!-- Paginate -->
			<div id='pagination'></div>
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
</script>
