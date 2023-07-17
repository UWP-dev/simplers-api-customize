function save_custom_settings(){
	var post_id = jQuery('input[name="pt-cv-post-id"]').val();
	var css_code_val = jQuery('#pt-cv-bcv-custom-css').val();

	jQuery.ajax({
		type: 'POST',
		url: bcv_admin.ajaxurl,
		data: {
			action: "bcv_admin_css",
			post_id: post_id,
			css_code: css_code_val
		},
		dataType : 'html',
		beforeSend: function() {
			//jQuery('.book_now_' + schedule_id).prop('disabled', true);
		},
		success: function(response) {
			if (response.success == true) {
				jQuery('.custom_css_cls').html("Your css is added.").show();
			} else {
				jQuery('.custom_css_cls').html("Please enter valid css.").show();
			}
		}
	});

	

}
