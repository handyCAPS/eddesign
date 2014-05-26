(function ( $ ) {
	"use strict";

	$(function () {




		function listenForAdd(dialog) {

			$('.addslider-button').on('click', function() {

				dialog.dialog('open');

				dialog.dialog('option','title', 'New Slider');

				listenForSubmit(dialog);
			});


		}

		function listenForSubmit(dialog) {


			$('.addslider').on('submit', function(e) {

				e.preventDefault();

				dialog.dialog('destroy');

				var data = {
					action: 'new_slider',
					newSliderNonce: $('[name="_wpnonce"]').val(),
					formdata: $('#addslider-form').serialize()
				};

				$.post(ajaxurl, data, function(response) {

					$('#wpbody-content').html(response);

					init();
				});
			});
		}

		function makeSortable() {
			$('.slider-wrapper').each(function() {

			$('[data-sliderid="' + $(this).attr('data-sliderid') + '"]').sortable({
					change: function() {

						var sortedA = $(this).sortable('toArray', {
							attribute: 'data-slideid'
						}).map(function(index, value) {
							return [index,value];
						});

						var fullArray = sortedA;

					}
				});
			});

		}

		function addMedia() {
			var handyCAPSUploader,
			attachment,
			sliderId;

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
		}

		function listenForDeleteSlider() {

			$('.delete.slider').on('click', function(e) {

				if (!confirm('Are you sure you want to delete the whole slider ? This can not be undone.')) {
					return;
				}

				var sliderId = $(e.currentTarget).attr('data-sliderid'),
				deleteSliderNonce = $(e.currentTarget).attr('data-wpnonce');

				var data = {
					action: 'delete_slider',
					deleteSliderNonce: deleteSliderNonce,
					sliderId: sliderId
				};

				$.post(ajaxurl, data, function (response) {
					$('#wpbody-content').html(response);

					init();
				});
			});

		}

		function listenForDelete() {

			$('.delete.slide').on('click', function(e) {

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

		function init() {

			var dialog = $('.addsliderwrapper').dialog({
				modal: true,
				autoOpen: false
			});

			addMedia();

			makeSortable();

			listenForDelete();

			listenForDeleteSlider();

			listenForAdd(dialog);

		}

		init();

	});

}(jQuery));