
jQuery(document).on("click",".address_one .close_icon, .edit_address .close_icon", function(e) {
	e.preventDefault();	
	jQuery(this).parents('li').removeClass('ship_edit');
	jQuery(this).parents('li').removeClass('edit_address');
})


jQuery(document).on("click",".delete_address", function() {	
	 if(confirm("Are you sure you want to delete this address?")){
	var current = jQuery(this);
	address_id = this.id;
	url = jQuery('#url').val();
	jQuery.ajax({
		url    : url,
		type   : "POST",
		data   : { "Shippingaddress[delete]":1,"address_id":address_id,'secure_key':secure_key },
		success: function (data) 
		{
			var response = jQuery.parseJSON(data);
			console.log(response);
			console.log(response.status);
			if(response.status == 'success') {
				current.parents('li').remove();
			}
			else {
				if(response.form_error != "undefined" && response.form_error.length > 0)
				{
					jQuery(".response_error").html(response.form_error);
				}
				else if(response.error !='') {
					jQuery('.response_error').html(response.error);
				}
				else
				{
					jQuery('.response_error').html("Something Wrong");
				}
			}
			
		},
		error  : function () 
		{
			console.log("internal server error");
		}
	});
	return false;
	}
});

jQuery(document).on("click",".address_list .set_active", function() {	
	 if(confirm("Are you sure you want to set shipping address?")){
	var current = jQuery(this);
	address_id = this.id;
	url = jQuery('#url').val();
	jQuery.ajax({
		url    : url,
		type   : "POST",
		data   : { "Shippingaddress[default]":1,"address_id":address_id,'secure_key':secure_key},
		success: function (data) 
		{
			var response = jQuery.parseJSON(data);
			console.log(data);
			console.log(response);
			if(response.status == 'success')
			{
				jQuery('#is_default').val(address_id);
				jQuery('.address_list li').removeClass('active');
				jQuery('.delivery_icon').removeClass('delivery_icon').removeClass('edit_icon');
				
				//current.removeClass('set_active');
				//current.addClass('active');
				current.parents('li').addClass('active');
				current.parent().children('.three-icons').children('a.delviery').addClass('delivery_icon').addClass('edit_icon');
			}
			else
			{
				if(response.form_error != "undefined" && response.form_error.length > 0)
				{
					jQuery(".response_error").html(response.form_error);
				}
				else if(response.error !='') {
					jQuery('.response_error').html(response.error);
				}
				else
				{
					jQuery('.response_error').html("Something Wrong");
				}
			}
			//$('').html(response.message);
		},
		error  : function () 
		{
			console.log("internal server error");
		}
	});
	return false;
	}
});

jQuery(document).on("click","#address_next", function() {
	var error = 0;
	/*
	alert();
	$( ".delivery_add_one input.required" ).each(function( index ) {
		if(jQuery(this).val()=='') {
			error++;
			jQuery(this).siblings('.help-block').html(jQuery(this).prev().html()+' cannot be blank.');
		}
		else {
			jQuery(this).siblings('.help-block').html('');
		}
	});
	alert(error);*/
	if(error==0) {
		jQuery('.delivery_add_one').hide();
		jQuery('.delivery_add_two').show();	
	}
	
});



jQuery(document).on("click","#initial_address", function() {

	jQuery('.delivery_add_one').show();
	jQuery('.delivery_add_two').hide();	
	
});


$('.address_list .add').click(function() {
    $(this).addClass('edit_address');
});
$('.address_list .edit_address').click(function() {
    jQuery('.close_icon').trigger('click');
    jQuery(this).parents('li').addClass('ship_edit');
});

jQuery(document).on("submit",".update_form", function() 
{
	var current = $(this);
	jQuery('.secure_key').val(secure_key);
	$.ajax({
		url: jQuery('#url').val(),
		data : current.serialize(),
		type :'POST', 
		dataType:"json",
		success:function(data){
			console.log(data);
			if(data.status == 'success') {
				window.location.reload();
			}
			console.log(data);
		}
	});
	return false;
});	

$(window).load(function() { 
    $("#shipping_form").validate(
        {
            ignore : "",
            submitHandler : function() {
                $.ajax({
                    url: jQuery('#url').val(),
                    data : $('#shipping_form').serialize(),
                    type :'POST', 
                    dataType:"json",
                    success:function(data){
						console.log(data);

						if(data.status == 'success') {
							window.location.reload();
						}
                        console.log(data);
                    }
                });
                return false;
            }
		});

	$("#common_shipping_form").validate(
	{
		ignore : "",
		submitHandler : function() {
			$.ajax({
				url: jQuery('#url').val(),
				data : $('#common_shipping_form').serialize(),
				type :'POST', 
				dataType:"json",
				success:function(data){
					console.log(data);

					if(data.status == 'success') {
						window.location.href = SITE_URL+'checkout/payment';	
					}
					console.log(data);
				}
			});
			return false;
		}
	});	
		
		
        
})
