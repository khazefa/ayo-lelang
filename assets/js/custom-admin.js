$(document).ready(function () {
	$.fn.dataTable.moment('DD/MM/YYYY');

	$('#data-produk').dataTable({
		"dom": "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
			"<'row'<'col-sm-12'tr>>" +
			"<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
		"responsive": true,
		"order": [[1, "asc"]]
	});

	$('#data-bid').dataTable({
		"dom": "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
			"<'row'<'col-sm-12'tr>>" +
			"<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
		"responsive": true,
		"order": [[4, "asc"]]
	});

	$('#data-saldo').dataTable({
		"dom": "<'row'<'col-sm-12 col-md-6'Bl><'col-sm-12 col-md-6'f>>" +
			"<'row'<'col-sm-12'tr>>" +
			"<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
		"responsive": true,
		"lengthChange": false,
		"buttons": ['copy', 'excel', 'pdf', 'print'],
		"order": [[1, "asc"]]
	});

	function load_total_saldo() {
		$.ajax({
			url: base_url + 'admin/orders/total-saldo',
			type: 'get',
			dataType: 'json',
			success: function (response) {
				// $('.product-price-' + id).html(response.current_bid_price);
				$('#total-saldo').html(response.total);
			}
		});
	};
});
