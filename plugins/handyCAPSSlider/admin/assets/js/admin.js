(function ( $ ) {
	"use strict";

	$(function () {


		var handyCAPSUploader,
		attachment,
		clickedSlider,
		i = 0;

		var imgDiv = "<div class='slide-wrap'><img src='' alt='' class='preview-image'><div class='slider-caption'></div></div>";

		$('.add-media').on('click', function(e){
			e.preventDefault();
			clickedSlider = this.id;
			handyCAPSUploader = wp.media.frames.file_frame = wp.media({
				title: 'Choose media',
				button: {
					text:'Add to slider',
				},
				multiple: true
			});

			handyCAPSUploader.on('select', function(event) {
				attachment = handyCAPSUploader.state().get('selection').first().toJSON();

				console.log($('#' + clickedSlider).siblings());

				var sliderId = $('#' + clickedSlider).siblings('.sliderId').val();

				i++;

				var data = {
					action: 'save_slide',
					att_id: attachment.id,
					slider_id: sliderId
				};

				$.post(ajaxurl, data, function(response) {
					console.log(response);
					$('.slider-wrapper').html(response);
				});

			});

			handyCAPSUploader.open();
		});



	});

}(jQuery));