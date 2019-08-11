$(function () {
	'use strict'

	/**
	 * Open modal input bid price
	 */
    $(".btn-bid").on('click', function (e) {
		e.preventDefault();
		let id = $(this).data('id');
		let price = $(this).data('price');
		$("#modal-bid .modal-body #mdl_bid_id").attr({
			"value" : id
		});

		$.ajax({
			url: base_url + 'store/Site/get_current_bid_price/' + id,
			type: 'get',
			dataType: 'json',
			success: function (response) {
				$("#modal-bid .modal-body #mdl_bid_price").attr({
					"min": response.current_bid_price	//set minimal price by data
				});
			}
		});
	});

	/**
	 * Open modal input up bid price
	 */
	$(".btn-up-bid").on('click', function (e) {
		e.preventDefault();
		let id = $(this).data('id');
		let item_id = $(this).data('item-id');
		let price = $(this).data('price');

		$("#modal-up-bid .modal-body #mdl_up_bid_id").attr({
			"value": id
		});

		$.ajax({
			url: base_url + 'store/Site/get_current_bid_price/' + item_id,
			type: 'get',
			dataType: 'json',
			success: function (response) {
				// $('.product-price-' + id).html(response.current_bid_price);
				$('#mdl_up_bid_price_c').html(response.current_bid_price);
				$("#modal-up-bid .modal-body #mdl_up_bid_price").attr({
					"min": response.current_bid_price	//set minimal price by data
				});
			}
		});
	});

	/**
	 * Submit bin
	 */
	$(".btn-bin").on('click', function (e) {
		e.preventDefault();
		let item_id = $(this).data('id');
		let url = base_url + "bid/order";

		// Abort any pending request
		if (request) {
			request.abort();
		}

		// Fire off the request to /form.php
		request = $.ajax({
			url: url,
			type: "POST",
			data: { item_id: item_id }
		});

		// Callback handler that will be called on success
		request.done(function (response, textStatus, jqXHR) {
			if (jqXHR.status === false) {
				window.location.replace(base_url);
			} else {
				window.location.replace(base_url + "peserta/status-bid");
			}
		});

		// Callback handler that will be called on failure
		request.fail(function (jqXHR, textStatus, errorThrown) {
			// Log the error to the console
			console.error(
				"The following error occurred: " +
				textStatus, errorThrown
			);
		});

	});
	
	$("#mdl_bid_forms").on('submit', function (e) { 
		e.preventDefault();
		let id = $("#mdl_bid_id").val();
		let price = $("#mdl_bid_price").val();

		// Abort any pending request
		if (request) {
			request.abort();
		}
		// setup some local variables
		var $form = $(this);

		// Let's select and cache all the fields
		var $inputs = $form.find("input, select, button, textarea");

		// Serialize the data in the form
		var serializedData = $form.serialize();

		// Let's disable the inputs for the duration of the Ajax request.
		// Note: we disable elements AFTER the form data has been serialized.
		// Disabled form elements will not be serialized.
		$inputs.prop("disabled", true);

		// Fire off the request to /form.php
		request = $.ajax({
			url: $(this).attr("action"),
			type: "post",
			data: serializedData
		});

		// Callback handler that will be called on success
		request.done(function (response, textStatus, jqXHR) {
			// Log a message to the console
			console.log("Hooray, it worked!");
		});

		// Callback handler that will be called on failure
		request.fail(function (jqXHR, textStatus, errorThrown) {
			// Log the error to the console
			console.error(
				"The following error occurred: " +
				textStatus, errorThrown
			);
		});

		// Callback handler that will be called regardless
		// if the request failed or succeeded
		request.always(function () {
			// Reenable the inputs
			$inputs.prop("disabled", false);
		});
	});

	function mutate_bidder(id) {
		arr_id.push(id);
	}

	// CountDownTimer("<?php echo $timer->waktu;?>", 'hari', 'jam', 'menit', 'detik');
	function CountDownTimer(dt, id1, id2, id3, id4) {
		var end = new Date(dt);

		var _second = 1000;
		var _minute = _second * 60;
		var _hour = _minute * 60;
		var _day = _hour * 24;
		var timer;

		function showRemaining() {
			var now = new Date();
			var distance = end - now;
			var distance1 = now - end;
			if (distance1 > 0) {
				clearInterval(timer);
				return;
			}
			var days = Math.floor(distance / _day);
			var hours = Math.floor((distance % _day) / _hour);
			var minutes = Math.floor((distance % _hour) / _minute);
			var seconds = Math.floor((distance % _minute) / _second);

			document.getElementById(id1).innerHTML = days + ' Hari';
			document.getElementById(id2).innerHTML = hours + ' Jam';
			document.getElementById(id3).innerHTML = minutes + ' Menit';
			document.getElementById(id4).innerHTML = seconds + ' Detik';
		}

		timer = setInterval(showRemaining, 1000);
	}

	$(document).ready(function () {
		$('#grid_status_bid').DataTable({
			'paging': true,
			'lengthChange': false,
			'searching': false,
			'ordering': true,
			'info': true,
			'autoWidth': false
		});
	});
});
