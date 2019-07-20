$(function () {
	'use strict'

	/**
	 * Open modal input bid price
	 */
    $(".btn-bid").on('click', function (e) {
		e.preventDefault();
		let price = $(this).data('price');
		$("#modal-bid .modal-body #mdl_bid_price").attr({
			"min" : price	//set minimal price by data
		 });
    });
});
