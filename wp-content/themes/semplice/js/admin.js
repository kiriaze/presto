(function ($) {
    "use strict";
    $(document).ready(function () {
	
    	/* add dropdown arrows */
    	$('<div class="select-arrow"></div>').insertAfter($('div.field > select'));

		/* delete cover slider arrow */
		$('#acf-field-cover_slider').next().remove();
		
    	/* wysiwyg editor in full width */
    	$('.row_layout .field_type-wysiwyg').each(function() {
    	   $(this).children('td.label').remove();
    	   $(this).children('td:first-child').attr('colspan', '2');
    	});

    	$('.field ul.acf-checkbox-list li label').each( function() {
    	    if($(this).children('.checkbox').prop('checked')) {
    	        $(this).css('backgroundPosition', '0px -21px');
                $(this).addClass('checked');
    	    }
    	});
    	
    	/* include the content editor in the workview content editor tab */
    	$('#acf_3362, #acf_acf_content-editor').insertAfter('.field_key-field_52af1e0e9d2d9');
    	
    	/* include the content editor in the page tab */
        $('#acf_3362, #acf_acf_content-editor').insertAfter('.field_key-field_530238f0d553c');
    	
    	/* include the custom header in the page custom header tab */
        $('#acf_1307, #acf_acf_fullscreen-cover').insertAfter('.field_key-field_52f2469819e07');
    	
    	/* include the custom header in the workview project header tab */
    	$('#acf_1307, #acf_acf_fullscreen-cover').insertAfter('.field_key-field_51ef0717531f2');
		
		
		if($('body').hasClass('semplice_page_acf-options-custom-modules')) {
		
			/* dropzone */
			var uploadUrl = $('#custom-modules-upload').data('upload-url');

			/* create dropzone */
			var dropzone = new Dropzone('#custom-modules-upload', { url: uploadUrl, acceptedFiles: '.zip' });
					
			dropzone.on('success', function(file) {

				var request = $.ajax({
					url: ajaxurl,
					type: "POST",
					data: {
						action : 'semplice_modules_upload',
						mode : 'reload'
					},
					dataType: "html"
				});
				
				/* append field to content area */
				request.done(function(response) {
					$('.installed-modules').html(response);
				});
				
				request.fail(function( jqXHR, textStatus ) {
					alert( "Request failed: " + textStatus );
				});
			});
			
			// delete module
			$('body').on('click', 'a.deactivate-module', function() {

				var module_id = $(this).data('module-id');
				var module_status = $(this).data('module-status');
				
				var request = $.ajax({
					url: ajaxurl,
					type: "POST",
					data: {
						action : 'semplice_modules_upload',
						mode : 'deactivate',
						module_id : module_id,
						module_status : module_status
					},
					dataType: "html"
				});
				
				/* append field to content area */
				request.done(function(response) {
					$('.installed-modules').html(response);
				});
				
				request.fail(function( jqXHR, textStatus ) {
					alert( "Request failed: " + textStatus );
				});

			});
		}
	});
})(jQuery);