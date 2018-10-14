function get_content()
{
	
	var type = $('.cate_list li.active').data('type');
	var subcat = $('.subcate_list li.active').data('type');
	var price_from = $('#price_from').val();
	var price_end = $('#price_end').val();
	var sortby = $('#product-sort').val();
	var search = $('#products-product_name').val();
	show_content_loading(); 
	$('.load_more').hide();
	$.ajax({
		url : admin_url + module + "/ajax_pagination/",
		data : $('#common_search').serialize() + "&type="+type+"&subcat="+subcat+"&price_from="+price_from+"&price_end="+price_end+"&sortby="+sortby+"&search="+search,
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

function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}
function  update_qty(inc_val,row_id,type)
{
	var increment_val = inc_val;
	var row_id = row_id;
	var post_rowid = '';

	if($('#post_rowid').length > 0)
	{
		var post_rowid = $('#post_rowid').val();
	}
	if($('#shoppingcart-checkout').length)
	{
		var condiments='yes';
	}
	else
	{
		var condiments='';
	}
	var type = type;
	if(increment_val >0)
	{	
		try 
		{
			jQuery.ajax({
			type: "POST",
			url:base_url+"products/update_quantity",
			synchronous: false,
			data: {  secure_key:security_token,increment_val:increment_val,row_id:row_id,post_rowid:post_rowid,type:type,condiments:condiments } })
			.done(function(data){
				response = data;
				$(".search_loading").remove();
				if(response.status == "ok") {
					$("#sub_tot_id").html(response.sub_total);
					$("#cart_itm_id").html(response.cart_count);
					$("#"+row_id+"_price").html(response.price);
					$("#replace_ccontent").html(response.replace_ajax_html);
					$('#shoppingcart-checkout').html(response.condiment_html);
				}
				if(response.status == 'error'){
					window.location.reload();
				}
				trigger_ajaxpopup();  
			});
		} 
		catch (e) { 
		}
	}
}
$(document).ready(function(){

	$(document).on('click', '.blog_category li a', function(e) {		
		$('.blog_category li a').removeClass('active');
		$(this).addClass('active');
		$('#page_id').val('');
		$('#load_offset').val('');
		$(".append_html").html('');
		get_content();
	});
/*
	$(document).on('change', '#search_category', function(e) {	
		var current = this.options[e.target.selectedIndex].text;
		$('.blog_section li a').removeClass('active');
		$( '.blog_section li a[ data-section=' + current + ']' ).addClass( 'active' );
		$('#page_id').val('');
		$('#load_offset').val('');
		$(".append_html").html('');
		get_content();
	});
	*/
	$('.more_posts').click(function() {
		get_content();
	});
	
	$('body').on('click','.lefter_cart',function() { 
		var row_id_decre = this.id;
		var int_val = parseInt($(this).parent().find('input').val());
		 var red_val = 1;
		 if(!isNaN(int_val) && int_val != 0 && int_val != 1 && int_val > 0)
		   {
			  var red_val = parseInt(int_val - 1);
			  //update_qty(red_val,row_id_decre,'decrement');
			  
		   }
		  var int_val = parseInt($(this).parent().find('input').val(red_val));
	});
		
	$('body').on('click','.righter_cart',function() {
		var row_id_incre = this.id;
		var int_val_inc = parseInt($(this).parent().find('input').val());
		 var red_val_inc = 1;
		 if(!isNaN(int_val_inc) && int_val_inc > 0 )
		   {  
			  var red_val_inc = parseInt(int_val_inc + 1);
			  //update_qty(red_val_inc,row_id_incre,'increment');
		   }
		 parseInt($(this).parent().find('input').val(red_val_inc));
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
				jQuery('.attributes_sections').append('<p class="error error-info attribute_add_error">Please select the selection</p>');
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
						var result = responses.contents;
						if(typeof result.form_error != 'undefined')
						{
							var error ='<ul class="cart_error">';
							jQuery(result.form_error).each(function(key,val){
								error+="<li>"+val+"</li>"
							});
							error +="</ul>";
						}
						else {
							var error =result.message;
						}
						current.parent().append('<p class="error error-info">'+error+'</p>');
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
		var type = $('.cate_list li.active').data('type');
		var subcat = $('.subcate_list li.active').data('type');
		var price_from = $('#price_from').val();
		var price_end = $('#price_end').val();
		var sortby = $('#product-sort').val();
		var search = $('#products-product_name').val();
		show_content_loading(); 
		$('.load_more').hide();
		$.ajax({
			url : admin_url + module + "/ajax_pagination/",
			data : $('#common_search').serialize() + "&type="+type+"&subcat="+subcat+"&page="+page+"&price_from="+price_from+"&price_end="+price_end+"&sortby="+sortby+"&search="+search,
			type : 'POST',
			dataType : "json",
			async:false,
			success : function(data) {
				hide_content_loading();
				console.log(data);
				if (data.status == "ok") {
					$('.more_details_par').remove();
					$(".append_html").append(data.html);
				}
			}
		});
	});
	$('body').on('submit','#common_search',function() {
		get_content();
		return false;
	});
	$('body').on('click','.cate_list .categories',function(e) {
		$('.cate_list').find('.categories').removeClass('active');
		$(this).addClass('active');
		get_content();
	});

	$('body').on('click','.subcate_list .categories',function(e) {
		$('.subcate_list').find('.categories').removeClass('active');
		$(this).addClass('active');
		get_content();
	});

	$('body').on('click','.allcategories',function(e) {
		$('.show_less_category').show();
		$(this).hide();
	});
	$('body').on('click','.allsubcategories',function(e) {
		$('.show_less_subcategory').show();
		$(this).hide();
	});

	$('body').on('click','.hide_category',function(e) {
		$('.show_less_category').hide();
		$('.allcategories').show();
	});
	$('body').on('click','.hide_subcategory',function(e) {
		$('.show_less_subcategory').hide();
		$('.allsubcategories').show();
	});


	
	jQuery('body').on("click",".attribute_values", function() {
		var url = SITE_URL;
		
		if(!(jQuery(this).parent('li').hasClass('disabled')))
		{
			var id = jQuery(this).attr('id');
			var valueid = jQuery(this).attr('data-sku-id');
			if(jQuery(this).hasClass('active'))
			{
				var already = "yes";
			}
			else{
				var already = "no";
			}
			jQuery('.value_section_selection').children('ul').removeClass('current');
			jQuery(this).parent('li').parent('ul').children('li').each(function(){
				jQuery(this).children('a').removeClass('active');
				jQuery(this).parent('li').parent('ul').removeClass('current');
			});
			if(already == 'no')
			{
				jQuery(this).addClass('active');
				jQuery(this).parent().parent().addClass('active');
				jQuery(this).parent('li').parent('ul').addClass('current');
				var dataimage = jQuery(this).attr('data-image');
				if(dataimage)
				{
					var changeimg = dataimage.replace('thumbnail_350x350/','');
					jQuery('#elevatezoom-0').attr('src',changeimg);
					jQuery('#elevatezoom-0').attr('data-zoom-image',changeimg);
					jQuery('.zoomLens').css('background-image','url('+changeimg+')');
				}
			}
			else{
				jQuery(this).removeClass('active');
				jQuery(this).parent().parent().removeClass('active');
			}
			var productid= jQuery('#product_id').val();
			
			var selected_attribute_values = new Array();
			var selected_attribute_values_object = new Array();
			var selected_count = 0;
			var overallcount = jQuery('.value_section_selection ul').length;
			
			jQuery('.value_section_selection ul').each(function() {
				var selectionvalue = '';
				var selectionid = jQuery(this).attr('data-section_selection');
				//var selectionid = jQuery(this).children('li').children('a.active').attr('id');
				if(jQuery(this).children('li').children('a.active').length)
				{
					
					selectionvalueobj = jQuery(this).children('li').children('a.active').attr('data-sku-id');

					selected_attribute_values_object.push({'productid': productid, 'selectionid' : selectionid,'selectionvalue' : selectionvalueobj});
					
					selected_count++;
					selectionvalue = jQuery(this).children('li').children('a.active').attr('data-sku-related');
					jQuery(selectionvalue.split(',')).each(function(key,val){
						selected_attribute_values.push(val);
					});
				}
			});
			
			if(selected_count > 1)
			{
				var showarrays = get_duplicate(selected_attribute_values);
			}
			else{
				var showarrays = selected_attribute_values;
			}

			if(overallcount == selected_count)
			{
				jQuery('.value_section_selection ul').each(function() {

					if(!jQuery(this).hasClass('current'))
					{
						jQuery(this).children('li').each(function(){
							var current_li = jQuery(this);
							var current_li_class = new Array();
							var current_li_class_array = jQuery(this).attr('class').split(' ');
							jQuery(current_li_class_array).each(function(k,v){
								current_li_class.push(v);
							});
							var contain =0;
							jQuery(showarrays).each(function(curkey,curval){

								if(jQuery.inArray( curval, current_li_class ) == -1 && contain == 0)
								{
									jQuery(current_li).addClass('disabled');
									
								}
								else{
									jQuery(current_li).removeClass('disabled');
									contain= 1;
								}
							});
						});
					}
				});
				
				var productid= jQuery('#product_id').val();
				jQuery.ajax({
					url    : url+'products/getattributecombination/',
					data   : { 'selected_attribute_values' : selected_attribute_values_object, selectionid : productid,'secure_key':secure_key  },
					type   : "post",
					dataType:'json',
					success: function (responses) 
					{
						if(responses.status == 'success')
						{
							var product = responses.response;
							jQuery('.subproduct_section').hide();
							jQuery('.subproduct_section_duplicate').show();
							if(product.product_special_price !='' && product.product_special_price !=null)
							{
								jQuery('.subproduct_section_duplicate .new-price .priceval').html(product.product_special_price);
								jQuery('.subproduct_section_duplicate .old-price .priceval').html(product.product_price);
								if(product.discount_percent > 0)
								{
									jQuery('.subproduct_section_duplicate .offer .priceval').html(product.discount_percent);
								}
								else{
									jQuery('.subproduct_section_duplicate .offer').hide();
								}
							}
							else{
								jQuery('.subproduct_section_duplicate .offer').hide();
								jQuery('.subproduct_section_duplicate .old-price').hide();
								jQuery('.subproduct_section_duplicate .new-price .priceval').html(product.product_price);
								
							}
							jQuery('#subproduct').val(product.id);
							jQuery('#product_qty').html(product.product_qty);
							jQuery('#quantity-input').attr('data-maxquantity',product.product_qty);
							jQuery('.qty_exceed_error .max_qty').html(product.product_qty);
							jQuery('.qty_exceed_error .qty_error_product_name').html(product.name);
							jQuery('.subproduct_section_duplicate .subproduct_title_display').html(product.name);
						}

					},
					error : function () 
					{
						console.log("internal server error");
					}
				});
			}
			else if(selected_count > 0)
			{
				jQuery('.subproduct_section').show();
				jQuery('.subproduct_section_duplicate').hide();
							
				jQuery('.value_section_selection ul').each(function() {
					if(selected_count == 1) {
						jQuery('.value_section_selection ul.current').children('li').removeClass('disabled');
					}
					if(!jQuery(this).hasClass('current'))
					{
						jQuery(this).children('li').each(function(){
							var current_li = jQuery(this);
							var current_li_class = new Array();
							var current_li_class_array = jQuery(this).attr('class').split(' ');
							jQuery(current_li_class_array).each(function(k,v){
								current_li_class.push(v);
							});
							var contain =0;
							jQuery(showarrays).each(function(curkey,curval){

								if(jQuery.inArray( curval, current_li_class ) == -1 && contain == 0)
								{
									jQuery(current_li).addClass('disabled');
									
								}
								else{
									jQuery(current_li).removeClass('disabled');
									contain= 1;
								}
							});
						});
					}
				});
			}
			else{
				jQuery('.subproduct_section').show();
				jQuery('.subproduct_section_duplicate').hide();
				
				jQuery('.value_section_selection ul').each(function() {
					jQuery(this).children('li').removeClass('disabled');
				});
			}
		}
		return false;
	});
	
});


/* increase and decrease product quantity starts here */
$(document).on('click','.page_lefter',function() {
    var int_val = parseInt($(this).parent().find('input').val());
    var red_val = 1;
    var maxqty =  parseInt($(this).parent().find('input').data('maxquantity'));
    $('.qty-box-full-outer .qty_exceed_error').hide();

    if(!isNaN(int_val) && int_val != 0 && int_val != 1 && int_val > 0)
    {
        var red_val = parseInt(int_val - 1);
    }
    var int_val = parseInt($(this).parent().find('input').val(red_val));

});

$(document).on('click','.page_righter',function() {
    var int_val_inc = parseInt($(this).parent().find('input').val());
    var red_val_inc = 1;
    //var maxqty = parseInt($('#product_qty').val());
    var maxqty = parseInt($(this).parent().find('input').data('maxquantity'));

    $('.qty-box-full-outer .qty_exceed_error').hide();
    if(!isNaN(int_val_inc) && int_val_inc > 0 && int_val_inc < maxqty)
    {
        var red_val_inc = parseInt(int_val_inc + 1);
    }
    else if(int_val_inc >= maxqty)
    {
        var red_val_inc = parseInt(int_val_inc);
        $('.qty-box-full-outer .qty_exceed_error').show();
    }
    parseInt($(this).parent().find('input').val(red_val_inc));
});

$(document).on('click', '.update_cart_qty', function(e) { 
        var url = $(this).attr('href');
        var product_qty = $(this).parent('span').parent('td').find('input').val();
        show_content_loading(); 
        $.ajax({
            url : url,
            data : "secure_key="+secure_key+"&action=Updateqty"+"&product_qty="+product_qty,
            type : 'POST',
            dataType : "json",
            async:false,
            success : function(data) {
                hide_content_loading();
				$('#cart-empty').hide();                
                if (data.status == "success") {
                	var result = data.response;
					var cartcount = parseInt(data.cart_count);
					if(cartcount >0)
					{
						$('.cart-number').html(cartcount);
					}
					else
					{
						$('.cart-number').html('0');
						$('#main_shopping_cart').remove();
						$('#cart-empty').show();						
					}
					console.log(data.cart);
					$('#cart').html(result.cart);               	
                }
            }
        });
        return false;
    });		
    $(document).on('click', '.remove_cart_item', function(e) {   
		if(confirm('Are you sure you would like to remove this item from the shopping cart?'))
		{       
	        var url = $(this).attr('href');
	        show_content_loading(); 
	        $.ajax({
	            url : url,
	            data : "secure_key="+secure_key+"&action=Removeitem",
	            type : 'POST',
	            dataType : "json",
	            async:false,
	            success : function(data) {
	                hide_content_loading();
					$('#cart-empty').hide();                
	                if (data.status == "success") {
	                	var result = data.response;
						var cartcount = parseInt(data.cart_count);
						if(cartcount >0)
						{
							$('.cart-number').html(cartcount);
						}
						else
						{
							$('.cart-number').html('0');
							$('#main_shopping_cart').remove();
							$('#cart-empty').show();
						}
						$('#cart').html(result.cart); 
	                }
	            }
	        });
	    }
        return false;
    });
    $(document).on('click', '.remove_cart', function(e) {      
		if(confirm('Are you sure you would like to delete cart items from the shopping cart?'))
		{     	
	        var url = $(this).attr('href');
	        show_content_loading(); 
	        $.ajax({
	            url : url,
	            data : "secure_key="+secure_key+"&action=Removecart",
	            type : 'POST',
	            dataType : "json",
	            async:false,
	            success : function(data) {
	                hide_content_loading();
					$('#cart-empty').hide();                
	                if (data.status == "success") {
	                	var result = data.response;
						var cartcount = parseInt(data.cart_count);
						if(cartcount >0)
						{
							$('.cart-number').html(cartcount);
						}
						else
						{
							$('.cart-number').html('0');
							$('#main_shopping_cart').remove();
							$('#cart-empty').show();
						}
						$('#cart').html(result.cart); 
	                }
	            }
	        });
   		}
        return false;
    });        	
    
