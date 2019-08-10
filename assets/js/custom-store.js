'use strict'

$(document).ready(function () {

	let get_bid_price = function load_bid_price(id) {
		$.ajax({
			url: base_url + 'store/Site/get_max_bid_price/' + id,
			type: 'get',
			dataType: 'json',
			success: function (response) {
				$('.product-price-' + id).html(response.current_bid_price);
			}
		});
	};

	let get_total_offer = function load_total(id) {
		$.ajax({
			url: base_url + 'store/Site/get_current_bidder/' + id,
			type: 'get',
			dataType: 'json',
			success: function (response) {
				$('.total-bin-' + id).html(response.total_bin + ' buyer');
				$('.total-bid-' + id).html(response.total_bid + ' bidder');
			}
		});
	};

	let iterator = arr_id.values();

	for (let elements of iterator) {
		// console.log(elements);
		get_bid_price(elements);
		get_total_offer(elements);
	}
});
