// JavaScript Document
jQuery(document).ready( function($) {
	$(".ajax-link").click( function() {
		
    $("#id_link").html("");		
 	//capture_date
	post_id = $("#post_id").val();
	year = $("#year").val();
	month = $("#month").val();
	data_type = $("#data_type").val();
	
	 var data = {   
	                action    : 'test_response',
					post_id   : post_id,
					year      : year,
					month     : month,
					data_type : data_type
				};
				
	$.post(the_ajax_script.ajaxurl,
		   data, 
		   function(response) {
					   // $("#id_link").html(response);
						$("#ifrmae_id").attr('src',response);
				 });
	//return false;
	
	});
});	