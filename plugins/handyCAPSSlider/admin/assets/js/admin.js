(function ( $ ) {
	"use strict";

	$(function () {


		var handyCAPSUploader,
		attachment,
		clickedSlider,
		sliderId;

		var imgDiv = "<div class='slide-wrap'><img src='' alt='' class='preview-image'><div class='slider-caption'></div></div>";

		$('.add-media').on('click', function(e){

			e.preventDefault();

			clickedSlider = this.id;
			sliderId = parseInt(clickedSlider.replace(/[^0-9]/g, ''), 10);

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
					slider_id: sliderId
				};

				$.post(ajaxurl, data, function(response) {

					$('.slider' + sliderId + ' .slider-wrapper').html(response);
				});

			});

			handyCAPSUploader.open();
		});

		function listenForDelete() {

			$('.delete').on('click', function(e) {

				var slideId = e.currentTarget.attributes.getNamedItem('data-slideid').value,
				sliderId = $(e.currentTarget).parents('.handycapsslider').attr('data-sliderid');

				console.log(sliderId, slideId);
				var data = {
					action: 'delete_slide',
					slideId: slideId,
					sliderId: sliderId
				};

				$.post(ajaxurl, data, function(response) {
					console.log(response);
					$('.slider' + sliderId + ' .slider-wrapper').html(response);
					listenForDelete();
				});
			});
		}

		listenForDelete();

		


	});

}(jQuery));