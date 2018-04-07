/* this files used login related functions... */

$(document).ready(function() {

	/* Common form validation and for submit - start */
	var loading_icon = '';
	wrapper_val = container =  error_val = "";
	if( typeof(validation_container) !="undefined" && validation_container == "Yes")  {
		var wrapper_val = "li";
		var container = $('div.container_div');
		var error_val = 'span';
	}else {
		var error_val = 'label';
	}
	var container = $('div.container_div'); 
	$("#common_form").validate({
    	
		errorContainer: container,
		errorLabelContainer: $("ul", container),
		wrapper: wrapper_val,
		errorElement: error_val,
		ignore : "",
		submitHandler : function() {
			$(".alert_msg").hide();
			$(".btn_submit_div").hide();
			$(".btn_submit_div").before(loading_icon);
			if( typeof(CKEDITOR) !== "undefined" )
			{
				for ( instance in CKEDITOR.instances )
				{
					CKEDITOR.instances[instance].updateElement();
				}
			}
			$("#common_form").ajaxSubmit({
				type : "POST",
				dataType : "json",
				url :  SITE_URL + module,
				data : $("#common_form").serialize(),
				cache : false,
				success : function(data,message) {
					if(typeof(message) == 'string')
					{
						response = data;
					}
					else
					{
						response = message.responseJSON;
					}
					console.log(response);
					$(".btn_submit_div").show();
					$(".form_submit").remove();

					if (response.status == "success") {
						 var redirect =  (typeof(custom_redirect_url) !="undefined" && custom_redirect_url !="" )?  custom_redirect_url :  module;
						
						window.location.href = SITE_URL+"registration/thankyou";
						
					} else if (response.status == "error") {
						$(".alert_msg,.container_div").show();
						$(".alert_msg").html(data.message);
						//$('.side-body').scrollView();
						
					}

				}
			});

		}
	});

	$(document).on('change',"input[name = 'customer_type']",function() {
		var customer_type = $(this).val();
		if(customer_type == 1)
		{
			$('.business_field').show();
		}
		else
		{
			$('.business_field').hide();
		}
	});

}); /* end of document ready*/




