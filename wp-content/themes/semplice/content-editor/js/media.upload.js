(function ($) {
    "use strict";
    $(document).ready(function () {

        //uploading files variable
        var semplice_file_frame;
        
        $(document).on('click', '.media-upload', function(event) {
            
            var id = '#' + $(this).data('content-id');
			var phpId = $(this).data('content-id');
            var type = $(this).data('upload-type');
			var isBranding = $(this).data('branding');
            
			var upload_type;
            
			/* set multiple images to false */
			var multiple = false;
			
            /* define upload type */
            if(type === 'background') {
                upload_type = 'image';
            } else {
                upload_type = type;
            }

			if(type === 'gallery') {
			
				/* allow multiple file selection */
				multiple = true;
				
				/* set upload type */
				upload_type = 'image';
				
				/* has images? */
				// $(id).find('[data-gallery-id=' + phpId + ']')
			}
            
            event.preventDefault();
    
            if (typeof(semplice_file_frame)!=="undefined") {
                semplice_file_frame.close();
            }
      
            semplice_file_frame = wp.media.frames.customHeader = wp.media({
                title: "Media Upload",
                library: {
                    type: upload_type
                },
                button: {
                    text: "Insert Media"
                },
                multiple: multiple
            });
    
            semplice_file_frame.on('select', function() {
                
				if(type === 'gallery') {
					
					/* recent images */
					var recent = $(id).find('input[name=gallery]').val();
					
					/* get recent array of images */
					if(recent.length > 0) {
					
						/* parseint the recent image ids */
						var images = recent.split(',').map(function (xid) {
							return parseInt(xid, 10); 
						});
						
					} else {
					
						/* images array */
						var images = [];
						
					}
					
					/* get selection */
					var selection = semplice_file_frame.state().get('selection');

					selection.map(function(attachment) {
							
						/* attachment json */
						attachment = attachment.toJSON();
						console.log(attachment);
						if($.inArray(attachment.id,images) < 0){
						
							/* fill gallery array and append to sortable container */
							images.push(attachment.id);
							
							$(id).find('[data-gallery-id=' + phpId + ']').append('<li id="' + attachment.id + '"><a class="remove-gallery-image"></a><img src="' + attachment.url + '"></li>');
							
						};
						
					});
					
					/* give array to input */
					$(id).find('input[name=gallery]').val(images);
					
					/* remove gallery image */
					$(id).find('.remove-gallery-image').click(function() {
					
						$(this).parent().transition({ opacity: 0 }, 400, 'ease', function() {
						
							/* remove item */
							var removeItem = $(this).attr('id');
						
							/* delete value in images array */							
							images = $.grep(images, function(value) {
							  return value != removeItem;
							});
							
							/* remove from DOM */
							$(this).remove();
							
							/* get array of ids */
							var sortIDs = $(id).find('[data-gallery-id=' + phpId + '] li').map(function () { return this.id; }).get();
							
							/* append ids to val */
							$(id).find('input[name=gallery]').val(sortIDs);
							
						}); 
						
					});
					
					/* start sortable */
					$(id).find('[data-gallery-id=' + phpId + ']').sortable({
						update: function(event, ui) {
						
							/* get array of ids */
							var sortIDs = $(id).find('[data-gallery-id=' + phpId + '] li').map(function () { return this.id; }).get();
							
							/* append ids to val */
							$(id).find('input[name=gallery]').val(sortIDs);
						}
					});
							
				} else {
				
					/* single media */
					var attachment = semplice_file_frame.state().get('selection').first().toJSON();
					
					/* return value depending on upload type */
					if(type === 'background') {
						if(isBranding === 'branding') {
							$('input[name=branding-bg-image]').first().val(attachment.url);
							$('img.branding-bg-image-preview').first().attr('src', attachment.url);
							$('img.branding-bg-image-preview').first().show();
							$('#semplice-content').css('background-image', 'url(' + attachment.url + ')');
						} else {
							$(id).find('input[name=background-image]').first().val(attachment.url);
							$(id).find('img.bg-image-preview').first().attr('src', attachment.url);
							$(id).find('img.bg-image-preview').first().show();
						}
						
					}
					
					if(type === 'image') {
						$(id).find('input[name=img]').val(attachment.id);
						$(id).find('.image-upload').text(attachment.filename);
						$(id).find('input[name=image-filename]').val(attachment.filename);
						$(id).find('img.image-preview').attr('src', attachment.url);
						$(id).find('img.image-preview').show();
					}
					
					if(type === 'video') {
						$(id).find('.video-upload').text(attachment.filename);
						$(id).find('input[name=video_url]').val(attachment.url);
						$(id).find('input[name=video-filename]').val(attachment.filename);
					}
					
					if(type === 'audio') {
						$(id).find('.audio-upload').text(attachment.filename);
						$(id).find('input[name=audio_url]').val(attachment.url);
						$(id).find('input[name=audio-filename]').val(attachment.filename);
					}
					
				}

            });
			
			semplice_file_frame.on('open', function() {
			
				/* get active images */
				var selection = semplice_file_frame.state().get('selection');
				
				/* gallery images */
				var gallery_images = $(id).find('input[name=gallery]').val();
				
				/* get images array */
				if(gallery_images) {
					gallery_images = gallery_images.split(',');
					
					/* attachment */
					var attachment;
					
					/* run throught images and add them to the selection */
					gallery_images.forEach(function(imgId) {
						attachment = wp.media.attachment(imgId);
						attachment.fetch();
						selection.add( attachment ? [ attachment ] : [] );
					});
				}
				
				$('.attachments').children('.selected').hide();
			});
     
            //Open modal
            semplice_file_frame.open();
        });
    });
})(jQuery);