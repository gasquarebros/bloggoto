/* this files used  pagination actions.. */

$(document).ready(function() {
	$(".append_html").on("click", ".pagination a", function(e) {
		e.preventDefault();

		var pass_url = $(this).attr('href');
		if (typeof (pass_url) != 'undefined' && pass_url != null) {
			show_content_loading();
			$.get(pass_url+"?paging=true", function(data) {
				hide_content_loading();
				var response = jQuery.parseJSON(data);
				$(".append_html").html(response.html);
				$("#page_id").val(response.offset);

			});
		}

	});

/* submit search.. */

/* unlink image  */
  $(".common_delete_image").click(function() {

	  customAlertmsg("Are you sure you want to delete this image?");	
	   $( "#alt1" ).click(function() {  
            $("#remove_image").val("Yes");
		    $(".show_image_box").remove();
	  });
  });
	
});

/* load content... */
function get_content(obj) { 
	paging =  page = sort_field = sort_value = "";
	
	/* pagination start */
	if (typeof (obj.paging) != "undefined" && obj.paging != null) { 
		paging = "true";
	}
	
	/* send  current page no */
	if (typeof (obj.page) != "undefined" && obj.page != null) {  
		page = obj.page;
	}  
	
	/* add sort by option  */  
	if ( (typeof (obj.sort_field) != "undefined" && obj.sort_field != null)  && (typeof (obj.sort_value) != "undefined" && obj.sort_value != null)  ) {  
		sort_field = obj.sort_field;
		sort_value = obj.sort_value;  
	}
	var customer_search='';
	
	show_content_loading(); 
	$.ajax({
		url : admin_url + module + "/ajax_pagination/"+page,
		data : $('#common_search').serialize() + "&paging="+paging + "&sort_field="+sort_field+"&sort_value="+sort_value + customer_search,
		type : 'POST',
		dataType : "json",
		async:false,
		success : function(data) {
			hide_content_loading();
			if (data.status == "ok") {
			
				$("#page_id").val(data.offset);
				
				/* reload page if delete the pagination record is empty... */
				if(data.page_reload == "Yes")
				 {
					window.location.href= admin_url + module;
					return false;
				 }
				 
				 if( data.append_json == 'ok' )
				 { 
					 /* show order details to order report */
					 $('.no_orders').html(data.no_orders);
					 $('.completed_orders').html(data.completed_orders);
					 $('.pending_orders').html(data.pending_orders);
					 $('.canceled_orders').html(data.cancel_orders);
				 }
				
				 if( data.sts_report == 'ok' )
				 {
					 /* show status average to order page */
					 $('.avg_received').html(data.avg_received);
					 $('.avg_processing').html(data.avg_process);
					 $('.avg_delivered').html(data.avg_delivery);
				 } 
				$(".append_html").html(data.html);
				
			}
			
			if (data.status == "error") {
				 // alert('');
			}
		}
	});
}
/*reset form */
function reset_form()
{

	 $('#common_search').each(function() {
         this.reset();
     });
	  get_content({paging:"true"});	
}
/* Common show lodong content image */
function show_content_loading() {
	$(".cntloading_wrapper").addClass('active');
	$(".cnt_loading").show()
}

/* Common hide lodong content image */
function hide_content_loading() {
	$(".cntloading_wrapper").removeClass('active');
	$(".cntloading_wrapper").removeClass('active');
	$(".cnt_loading").hide();
}
