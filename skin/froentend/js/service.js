function get_content()
{
	var sortby = $('#product-sort-web').val();
	show_content_loading(); 
	$('.load_more').hide();
	$.ajax({
		url : admin_url + module + "/ajax_pagination/",
		data : $('#common_search').serialize() +"&sortby="+sortby,
		type : 'POST',
		dataType : "json",
		async:false,
		success : function(data) {
			hide_content_loading();
			if (data.status == "ok") {
				$("#page_id").val(data.offset);
				$("#load_offset").val(data.next_set);
				/* reload page if delete the pagination record is empty... */
				if(data.page_reload == "Yes")
				{
					window.location.href= admin_url + module;
					return false;
				}
				$(".append_html").html(data.html);
				if(data.next_set !='')
				{
					$('.load_more').show();
				}
			}
			
			if (data.status == "error") {
				 // alert('');
			}
		}
	});
}

function get_service_subcategory() {
	var cat = $('#service_category').val();
	var url = SITE_URL+"services/getsubcategory";	
	$.ajax({
		url : url,
		data : "secure_key="+secure_key+"&category="+cat,
		type : 'POST',
		dataType : "json",
		async:false,
		success : function(data) {
			$('.service_subcategory').html(data.html);
			$('#service_subcategory').chosen();
		}
	});  
}

$(document).ready(function(){
	$('.more_posts').click(function() {
		get_content();
	});

	function loading()
	{
		return  '<img src="'+SITE_URL+'lib/theme/images/loading_icon_default.gif" alt="loading.."  class="loading" />';
	}

	$('body').on('click','.add_cart',function(e) {
		e.stopPropagation();	
		var url = SITE_URL;	  
		var error ='true'; 
		var addcartclass = this;
		var product_id = this.id; 	

		var type = 'simple';
		var current = jQuery(this);
		var productid = jQuery('#product_id').val();
		var product_max_qty = jQuery('#product_qty').val();
		var product_qty = jQuery('#quantity-input').val();
		var product_name = jQuery('#product_name').val();
		var product_sku = jQuery('#product_sku').val();
		var product_slug = jQuery('#product_slug').val();
		var subproduct = jQuery('#subproduct').val();
		var shipping_method = (jQuery('#shipping_method').length)?jQuery('#shipping_method').val():'';

		var selected_attribute_values = new Array();
		var selected_attribute_values_object = new Array();
		jQuery('.qty-box-full-outer .qty_exceed_error').hide();
		if(parseInt(product_max_qty) < parseInt(product_qty))
		{
			jQuery('.qty-box-full-outer .qty_exceed_error').show();
			return false;
		}
		jQuery('.error-info').remove();
		if(jQuery('.attributes_sections').length)
		{
			type = 'configurable';
			var selected_count = 0;
			var overallcount = jQuery('.value_section_selection ul').length;
			jQuery('.value_section_selection ul').each(function() {
				var selectionvalue = '';
				var selectionid = jQuery(this).attr('data-section_selection');
				//var selectionid = jQuery(this).children('li').children('a.active').attr('id');
				if(jQuery(this).children('li').children('a.active').length)
				{
					selectionvalueobj = jQuery(this).children('li').children('a.active').attr('data-sku-id');
					if (jQuery(this).children('li').children('a.active').attr('data-image')) {
						var selectionvalueimage = jQuery(this).children('li').children('a.active').attr('data-image');
					}
					else{
						var selectionvalueimage = '';
					}
					selected_attribute_values_object.push({'productid': productid, 'selectionid' : selectionid,'selectionvalue' : selectionvalueobj,'selectionvalueimage':selectionvalueimage});
					selected_count++;
					selectionvalue = jQuery(this).children('li').children('a.active').attr('data-sku-related');
					jQuery(selectionvalue.split(',')).each(function(key,val){
						selected_attribute_values.push(val);
					});
				}
			});
			if(overallcount == selected_count)
			{
				jQuery('.attribute_add_error').remove();
				error = 'false';
			}
			else
			{
				jQuery('.attributes_sections').append('<p class="error error-info attribute_add_error">Please make any one selection</p>');
			}
			// attribute product
		}
		else
		{
			error = "false";
			selected_attribute_values_object = productid;
			// simple product
		}

		/*shipping_validation*/
		if(jQuery('#shipping_method').length && jQuery('#shipping_method').val() == '')
		{
			error = 'true';
			jQuery('.selectship-part').append('<p class="error error-info shipping_add_error attribute_add_error">Please select the shipping method</p>');
		} else {
			jQuery('.selectship-part').children('.shipping_add_error').remove();
		}

		if(error == 'false')
		{
			current.hide();
			current.parent('div').append(loading);
			//show_content_loading(); 
			jQuery.ajax({
				url    : url+'products/add_to_cart/',
				data   : { 'selected_attribute_values' : selected_attribute_values_object, 'productid' : productid, 'type' :type,'product_qty':product_qty,'product_name':product_name,'product_sku':product_sku,'product_slug':product_slug,'product_max_qty':product_max_qty,'subproduct':subproduct,secure_key:secure_key,'shipping_method':shipping_method },
				type   : "post",
				dataType:'json',
				success: function (responses)
				{
					//hide_content_loading();
					current.show();
					jQuery('.loading').remove();
					if(responses.status == 'ok')
					{
						var result = responses.contents;
						var cartcount = parseInt(result.cart_details.cart_total_items);
						current.parent().append('<p class="success success-info">'+responses.message+'</p>');
						setTimeout("jQuery('.success-info').remove()", 2000);
						if(cartcount >0)
						{
							jQuery('.cart-number').html(cartcount);
						}
						else{
							jQuery('.cart-number').html('0');
						}
					}
					else{
						var result = responses;
                        console.log(result.form_error);
                        console.log(responses.form_error);
						if(typeof result.form_error != 'undefined')
						{
							var error ='<ul class="cart_error">';
							/*jQuery(result.form_error).each(function(key,val){
								error+="<li>"+val+"</li>"
							});*/
                           error += result.form_error;
							error +="</ul>";
						}
						else {
							var error = result.message;
						}
                        console.log(error);
						current.parent().append('<div class="error error-info">'+error+'</div>');
					}
				},
				error : function ()
				{
					console.log("internal server error");
				}
			});
			return false;
		}
		return false;
	});
	
	$('body').on('click','.lazy_load_flashsale',function(e) {
		e.stopPropagation();		  
		var page = $(this).data('nextpage');
		var sortby = $('#product-sort-web').val();
		show_content_loading(); 
		$('.load_more').hide();
		$.ajax({
			url : admin_url + module + "/ajax_pagination/",
			data : $('#common_search').serialize() +"&page="+page+"&sortby="+sortby,
			type : 'POST',
			dataType : "json",
			async:false,
			success : function(data) {
				hide_content_loading();
				if (data.status == "ok") {
					$('.more_details_par').remove();
					$(".append_html").append(data.html);
				}
			}
		});
	});


	$('body').on('change','.sortby',function(e) {
		get_content();
	});


	$('body').on('submit','#common_search',function() {
		get_content();
		return false;
	});
	
});