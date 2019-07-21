$(function () {
	'use strict'
	var request;

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
		$("#modal-bid .modal-body #mdl_bid_price").attr({
			"min" : price	//set minimal price by data
		 });
	});

	/**
	 * Open modal input up bid price
	 */
	$(".btn-up-bid").on('click', function (e) {
		e.preventDefault();
		let id = $(this).data('id');
		let price = $(this).data('price');
		$("#modal-up-bid .modal-body #mdl_up_bid_id").attr({
			"value": id
		});
		$("#modal-up-bid .modal-body #mdl_up_bid_price").attr({
			"min": price	//set minimal price by data
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
