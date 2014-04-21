/**
 * Media upload handler script.
 *
 * Props to Woocommerce, Andrew Munro and Thomas Griffin for the following JS code!
 * 
 * @package    Theme_Junkie_Portfolio_Content
 * @since      0.1.0
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2014, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 */
jQuery(document).ready(function($){
	
	var tjpc_media_frame;
	var $image_gallery_ids = $('#tjpc-portfolio-gallery-ids');
	var $gallery_images    = $('#tjpc-images-list');
	
	// Bind to our click event in order to open up the new media experience.
	$(document.body).on('click.tjpcOpenMediaManager', '.tjpc-open-media', function(e){

		var attachment_ids = $image_gallery_ids.val();

		// Prevent the default action from occuring.
		e.preventDefault();

		// If the frame already exists, re-open it.
		if ( tjpc_media_frame ) {
			tjpc_media_frame.open();
			return;
		}

		tjpc_media_frame = wp.media.frames.tjpc_media_frame = wp.media({

			className: 'media-frame tjpc-media-frame',
			frame: 'select',
			multiple: true,
			title: tjpc_media.title,
			library: {
				type: 'image'
			},
			button: {
				text:  tjpc_media.button
			}
		});

		tjpc_media_frame.on('select', function(){
			
			var selection = tjpc_media_frame.state().get('selection');

			selection.map(function(attachment) {

				attachment = attachment.toJSON();
				
				if ( attachment.id ) {

					attachment_ids = attachment_ids ? attachment_ids + "," + attachment.id : attachment.id;

					$gallery_images.append('\
						<li class="tjpc-image" data-image-id="' + attachment.id + '">\
							<img src="' + attachment.sizes.thumbnail.url + '" />\
							<a href="#" class="tjpc-delete" title="' + tjpc_media.attr + '"><div class="dashicons dashicons-no"></div></a>\
						</li>');

				}

			});

			$image_gallery_ids.val( attachment_ids );
			
		});

		// Now that everything has been set, let's open up the frame.
		tjpc_media_frame.open();
	});

	// Image ordering
	$gallery_images.sortable({
		items: 'li.tjpc-image',
		cursor: 'move',
		scrollSensitivity:40,
		forcePlaceholderSize: true,
		helper: 'clone',
		opacity: 0.65,
		placeholder: 'tjpc-sortable-placeholder',
		start:function(event,ui){
			ui.item.css('background-color','#f6f6f6');
		},
		stop:function(event,ui){
			ui.item.removeAttr('style');
		},
		update: function(event, ui) {
			var attachment_ids = '';

			$('li.tjpc-image').css('cursor','default').each(function() {
				var attachment_id = jQuery(this).attr( 'data-image-id' );
				attachment_ids = attachment_ids + attachment_id + ',';
			});

			$image_gallery_ids.val( attachment_ids );
		}
	});

	// Remove images
	$gallery_images.on( 'click', 'a.tjpc-delete', function(e) {

		e.preventDefault();

		$(this).closest('li.tjpc-image').remove();

		var attachment_ids = '';

		$('li.tjpc-image').css('cursor','default').each(function() {
			var attachment_id = jQuery(this).attr( 'data-image-id' );
			attachment_ids = attachment_ids + attachment_id + ',';
		});

		$image_gallery_ids.val( attachment_ids );

	} );

});