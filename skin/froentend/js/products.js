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
	
	
	
	$('body').on('click','.add_cart',function(e) {
		e.stopPropagation();		  
		var errors='0'; 
		var addcartclass = this;
		var product_id = this.id; 	
		var product_qty = $("#"+product_id+"-qty").val();	
		if(product_qty == '0')
		{
			errors='1';
			$("#"+product_id+"-qty").css("border","1px solid red");
			var errorDiv = $("#"+product_id+"-qty");
			var scrollPos = errorDiv.offset().top-112;
			$(window).scrollTop(scrollPos);
		}
		else
		{
			$("#"+product_id+"-qty").css("border","0 none");
		} 
				  
		if(errors == '0')
		{
			show_content_loading();
			$('.add_cart').addClass("g_loading").append('<div class="gloading_img"></div>');
			$("[data-id=cart_item_success]").html('');				
			$("[data-id=cart_item_success]").removeClass();
			try 
			{		
		
				$.ajax({
					type: "POST",
					url:SITE_URL+"products/add_to_cart",
					async: false,
					synchronous: false,
					data: { secure_key:secure_key,product_id:product_id,product_qty:product_qty }
				}).done(function(data){	
					hide_content_loading();
					response = jQuery.parseJSON(data);
					if(response.status == 'ok') 
					{ 
						$('.add_cart' ).removeClass( "g_loading" );
						$( "div" ).removeClass( "gloading_img" );  	 
						$('.cartcountings_count').html(response.cartreplace_html);
						$("[data-id=cart_item_success]").addClass('success_lay1');
						$("[data-id=cart_item_success]").show();
						var alerthtml = '<i class="fa fa-thumbs-o-up"></i>'+ '<font id="cart_item_hide" color="green">Item added to cart!</font>'; 
						$("[data-id=cart_item_success]").html(alerthtml);
						$("[data-id=cart_item_success]").delay(1500).fadeOut();
					}

					if(response.status == 'error')
					{
						$('.add_cart' ).removeClass( "g_loading" );	 
						setTimeout(function(){
						$( "div" ).removeClass( "gloading_img" );
						},1000);

						$("[data-id=cart_item_success]").addClass('error_lay1');
						$("[data-id=cart_item_success]").show();
						var alerthtml = '<i class="fa fa-thumbs-o-up"></i>'+ '<font id="cart_item_hide" color="red">'+response.msg+'</font>'; 
						$("[data-id=cart_item_success]").html(alerthtml);
						$("[data-id=cart_item_success]").delay(1500).fadeOut(); 		
					}
					return false;
				});
			}
			catch (e) { 
				/*alert("Something went wrong.");*/
			}		
		}
		else
		{
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
	
});