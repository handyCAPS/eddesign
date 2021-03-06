(function ( $ ) {
	"use strict";

	$(function () {

		var dialog;

		function lbOn(sliderId) {
			$('[data-parent-sliderid="' + sliderId + '"]').addClass('loadbar');
		}

		function lbOff(sliderId) {
			$('[data-parent-sliderid="' + sliderId + '"]').removeClass('loadbar');
		}

		function listenForAdd(dialog) {

			$('.addslider-button').on('click', function() {

				dialog.dialog('open');

				dialog.dialog('option','title', 'New Slider');

				listenForSubmit(dialog);
			});


		}

		function listenForEdit() {
			$('.editslider').on('click', function() {

				var sliderId = $(this).attr('data-sliderid'),
				editNonce = $(this).attr('data-wpEditnonce');

				lbOn(sliderId);

				var data = {
					action: 'edit_single_slider',
					editNonce: editNonce,
					sliderId: sliderId
				};

				$.post(ajaxurl, data, function(response) {
					console.log(response);

					lbOff(sliderId);
				});
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

				var sliderId = $(this).attr('data-sliderid');

				$('[data-sliderid="' + sliderId + '"]').sortable({
						update: function() {

							lbOn(sliderId);

							var sortedA = $(this).sortable('toArray', {
								attribute: 'data-slideid'
							});

							var sortNonce = $(this).attr('data-wpSortnonce');

							var data = {
								action: 'sort_all_slides',
								sliderId: sliderId,
								sortNonce: sortNonce,
								orderArray: sortedA
							};

							$.post(ajaxurl, data, function(response) {
								lbOff(sliderId);
							});


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
				var sliderId = $(e.currentTarget).parent('.handycapsslider').attr('data-parent-sliderid');


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

							$('[data-parent-sliderid="' + sliderId + '"] .slider-wrapper').html(response);

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

				lbOn(sliderId);

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
				sliderId = $(e.currentTarget).parents('.handycapsslider').attr('data-parent-sliderid');

				lbOn(sliderId);

				var data = {
					action: 'delete_slide',
					slideId: slideId,
					deleteNonce: deleteNonce,
					sliderId: sliderId
				};

				$.post(ajaxurl, data, function(response) {

					$('[data-parent-sliderid="' + sliderId + '"] .slider-wrapper').html(response);

					listenForDelete();

					lbOff(sliderId);
				});
			});
		}

		function init() {

			dialog = $('.addsliderwrapper').dialog({
				modal: true,
				autoOpen: false
			});

			addMedia();

			makeSortable();

			listenForDelete();

			listenForDeleteSlider();

			listenForAdd(dialog);

			listenForEdit();

		}

		init();

	});

}(jQuery));