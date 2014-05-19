(function ( $ ) {
	"use strict";

	$(function () {


		var handyCAPSUploader,
		attachment,
		i = 0;

		var imgDiv = "<div class='slide-wrap'><img src='' alt='' class='preview-image'><div class='slider-caption'></div></div>";

		$('#upload_image_button').on('click', function(e){
			e.preventDefault();
			handyCAPSUploader = wp.media.frames.file_frame = wp.media({
				title: 'Choose media',
				button: {
					text:'Add to slider',
				},
				multiple: true
			});

			handyCAPSUploader.on('select', function() {
				attachment = handyCAPSUploader.state().get('selection').first().toJSON();

				console.log(attachment);

				$('.slider-images').append(imgDiv);

				$('#upload_image').val(attachment.url);

				$('.preview-image')[i].src = attachment.url;

				$('.slider-caption')[i].innerHTML = attachment.caption;

				i++;

				var data = {
					action: 'save_slide',
					imgurl: attachment.url
				};

				$.post(ajaxurl, data, function(response) {
					console.log(response);
				});

			});

			handyCAPSUploader.open();
		});



	});

}(jQuery));