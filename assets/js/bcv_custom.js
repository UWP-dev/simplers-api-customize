jQuery(document).ready(function(event) {

  });

  jQuery(document).on("click",".remove_section a",function(event) {

	event.preventDefault()
	jQuery(".post-show").remove();
	console.log('2232');

});

function bcv_open_post_detail(post_id, block_post_id, clickelement) {
	jQuery(".post-show").remove();
	
	var index = jQuery(clickelement).closest('.pt-cv-content-item').index();

	var total_div = jQuery('.pt-cv-content-item').length;


	var elementNumber = index + 1;
	var counter = jQuery(clickelement).closest('.pt-cv-content-item').data('counter');
	var view = jQuery('.bcv_row_details').data('view');
	
	if (view == "timeline") {
	  var index = jQuery(clickelement).closest('.tl-item').index();
	  var elementNumber = index + 1;
	}

	console.log(index+'counter');
	
	var row = "";
	
	if (jQuery(clickelement).closest('.pt-cv-view').hasClass("pt-cv-mobile")) {
	  row = jQuery('.bcv_mobile_row_details').data('mobilerow');
	} else if (jQuery(clickelement).closest('.pt-cv-view').hasClass("pt-cv-mobile-tablet")) {
	  row = jQuery('.bcv_tablet_row_details').data('tabletrow');
	} else {
	  row = jQuery('.bcv_desktop_row_details').data('desktoprow');
	}


	
	

	


	if (row == "") {
	  row = 1;
	}
	
	var numerator = counter;
	var denominator = row;
	var result = elementNumber / denominator;
	var page = Math.ceil(result);
	var appendedPage = page * row;

	var maincontent ="";
	if (jQuery(clickelement).closest('.pt-cv-content-item').hasClass("pt-cv-omain")) {
		appendedPage = 1;
		 maincontent = "yes";
		
	}

  
	console.log('clicked ' + post_id); 
	jQuery.ajax({
	  type: 'POST',
	  url: bcv_script_object.ajaxurl,
	  data: {
		action: "bcv_open_post_detail",
		post_id: post_id,
		block_post_id: block_post_id
	  },
	  dataType: 'html',
	  beforeSend: function() {
		//jQuery('.book_now_' + schedule_id).prop('disabled', true);
	  },
	  success: function(response) {
		jQuery("#bcv_wrapper").remove();
		if (response) {
		  if (view == "timeline") {
			// Find the appropriate position in the timeline layout
			var targetIndex = appendedPage - row;
			jQuery('div.tl-item:nth-child('+ appendedPage +')').after('<div id="bcv_content" class="tl-item post-show"><span class="remove_section"><a href="">X</a></span>'+response+'</div>').slideDown('slow').show();
		  } else  if (view == "one_others") {

			if(maincontent == "yes"){
			jQuery('div.pt-cv-omain:nth-child('+ appendedPage +')').after('<div id="bcv_content" class="col-md-12 post-show"><span class="remove_section"><a href="">X</a></span>'+response+'</div>').slideDown('slow').show();
			}else{
				jQuery('div.pt-cv-content-item:nth-child('+ appendedPage +')').after('<div id="bcv_content" class="col-md-12 post-show"><span class="remove_section"><a href="">X</a></span>'+response+'</div>').slideDown('slow').show();

			}

		  }else {
			// Find the appropriate position in the column layout
			var targetIndex = appendedPage - row;
			console.log(targetIndex);
			if(total_div < appendedPage){
				//console.log(total_div+'add on end');
				appendedPage = total_div;
			}
			jQuery('div.pt-cv-content-item:nth-child('+ appendedPage +')').after('<div id="bcv_content" class="col-md-12 post-show"><span class="remove_section"><a href="">X</a></span>'+response+'</div>').slideDown('slow').show();
		  }
		} else {
		  alert(response.message);
		}
	  }
	});
  }

  
function bcv_open_post_detail_asd(post_id,block_post_id,clickelement){

	jQuery(".post-show").remove();
	var index = jQuery(clickelement).closest('.pt-cv-content-item').index();
	var elementNumber = index + 1;
	var counter = jQuery(clickelement).closest('.pt-cv-content-item').data('counter');
	var view = jQuery('.bcv_row_details').data('view');
	if(view == "timeline"){
		var index = jQuery(clickelement).closest('.tl-item').index();
		var elementNumber = index + 1;
	}
	var row ="";
	if(jQuery(clickelement).closest('.pt-cv-view').hasClass("pt-cv-mobile")){
		 row = jQuery('.bcv_mobile_row_details').data('mobilerow');
	}else if(jQuery(clickelement).closest('.pt-cv-view').hasClass("pt-cv-mobile-tablet")){
		 row = jQuery('.bcv_tablet_row_details').data('tabletrow');
	}else{
		 row = jQuery('.bcv_desktop_row_details').data('desktoprow');
	}

	if(row == ""){
		var row = 1;
	}	console.log(counter+'row'+row);
	 	 var numerator = counter;
		var denominator = row;
		var result = elementNumber / denominator;
		var page = Math.ceil(result);
		var apped_page = page * row;
		console.log(page+'pages');
	console.log('clicked'+post_id); 
	jQuery.ajax({
		type: 'POST',
		url: bcv_script_object.ajaxurl,
		data: {
			action: "bcv_open_post_detail",
			post_id: post_id,
			block_post_id:block_post_id
		},
		dataType : 'html',
		beforeSend: function() {
			//jQuery('.book_now_' + schedule_id).prop('disabled', true);
		},
		success: function(response) {
			jQuery("#bcv_wrapper").remove();
			if (response) {
				if(view == "timeline"){
					jQuery('div.tl-item:nth-child('+ apped_page +')').after('<div id="bcv_content" class="tl-item post-show"><span class="remove_section"><a href="">X</a></span>'+response+'</div>').slideDown('slow').show();
				}else{
					jQuery('div.pt-cv-content-item:nth-child('+ apped_page +')').after('<div id="bcv_content" class="col-md-12 post-show"><span class="remove_section"><a href="">X</a></span>'+response+'</div>').slideDown('slow').show();
				}
			} else {
				alert(response.message);
			}
		}
	});
}
