(function ( $ ) {
	"use strict";

	$(function () {

		var dialog = $('.addsliderwrapper').dialog({
			modal: true,
			autoOpen: false
		});

		function listenForAdd() {

			$('.addslider-button').on('click', function() {

				$('.addsliderwrapper').dialog('open');

				$('.addsliderwrapper').dialog('option','title', 'New Slider');
			});
			
			$('#submit-sliderform').on('click', function(e) {

				e.preventDefault();

				$('.addsliderwrapper').dialog('close');

				var data = {
					action: 'new_slider',
					newSliderNonce: $(_wpnonce).val(),
					formdata: $('#addslider-form').serialize()
				}

				$.post(ajaxurl, data, function(response) {
					$('#wpbody-content').html(response);
					$('.addsliderwrapper').dialog({
						modal: true,
						autoOpen: false
					});
					listenForAdd();
				});

				// console.log();
			});
		}

		$('.slider-wrapper').each(function() {

			$('[data-sliderid="' + $(this).attr('data-sliderid') + '"]').sortable({
				change: function() {

					var sortedA = $(this).sortable('toArray', {
						attribute: 'data-slideid'
					}).map(function(index, value) {
						return [index,value];
					});

					var fullArray = sortedA;

					console.log(sortedA);
				}
			});
		});




		var handyCAPSUploader,
		attachment,
		sliderId;

		var imgDiv = "<div class='slide-wrap'><img src='' alt='' class='preview-image'><div class='slider-caption'></div></div>";

		$('.add-media').on('click', function(e){

			e.preventDefault();

			var addNonce = $(e.currentTarget).parent('.handycapsslider').attr('data-wpnonce');
			var sliderId = $(e.currentTarget).parent('.handycapsslider').attr('data-sliderid');


			handyCAPSUploader = wp.media.frames.file_frame = wp.media({
				title: 'Choose media',
				button: {
					text:'Add to slider',
				},
				multiple: false
			});

			handyCAPSUploader.on('select', function(event) {

				attachment = handyCAPSUploader.state().get('selection').first().toJSON();

				var data = {
					action: 'save_slide',
					att_id: attachment.id,
					addNonce: addNonce,
					slider_id: sliderId
				};

				$.post(ajaxurl, data, function(response) {

					$('[data-sliderid="' + sliderId + '"] .slider-wrapper').html(response);

					listenForDelete();
				});

			});

			handyCAPSUploader.open();
		});

		function listenForDelete() {

			$('.delete').on('click', function(e) {

				var slideId = $(e.currentTarget).attr('data-slideid'),
				deleteNonce = $(e.currentTarget).attr('data-wpnonce'),
				sliderId = $(e.currentTarget).parents('.handycapsslider').attr('data-sliderid');

				var data = {
					action: 'delete_slide',
					slideId: slideId,
					deleteNonce: deleteNonce,
					sliderId: sliderId
				};

				$.post(ajaxurl, data, function(response) {
					$('[data-sliderid="' + sliderId + '"] .slider-wrapper').html(response);
					listenForDelete();
				});
			});
		}

		listenForDelete();

		listenForAdd();




	});

}(jQuery));