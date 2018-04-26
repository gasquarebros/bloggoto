$(document).ready(function(){
	$('.setmeal_title li a').click(function(){
		//$('.setmeal_outskin, .setmeal_title').slideUp();
		$('.head_list').fadeOut();
		var getrel = $(this).attr('rel');
		$(getrel).fadeIn();
	});


	$('.setdone_btn').click(function() {
	
		var tabid=$(this).attr('data-id');
		var section=$(this).attr('data-section');
		var errors='0';
		var nullerrors='0';
		var selected_text='';
		$('#'+tabid+' .choosen-editmodifiers').each(function() {
			
			var modifier_min=$(this).attr('data-min');
			var modifierid=$(this).attr('id');
			console.log(modifierid);
			var select_section=$(this).attr('data-section');
			var div_modifierid=modifierid.replace(/\-/g, '_');

			if(modifier_min >= 1)
			{
				var current_val=$(this).val();

				if($(this).val() != null)
				{

					var new_dropdown_values=new Array();
					if($('#'+div_modifierid+'_chosen .chosen-single').length)
					{
						if($(this).val() !='')
						{
							var selectedValue=$('#'+div_modifierid+'_chosen .chosen-single').children('span').text().trim();
							if(selected_text !='')
								selected_text=selected_text+', ';
							selected_text=selected_text+selectedValue;
							$('#'+modifierid+' option').map(function () {
								if ($(this).text().trim() == selectedValue)
								{
									new_dropdown_values.push($(this).val());
								}
							});
						}
						else
						{
							$('#'+tabid+' .error_'+modifierid).show();
							$('#'+tabid+' .error_'+modifierid).html('Please select Minimum options');
							errors='1';
						}
					}
					else
					{
						$('#'+div_modifierid+'_chosen .chosen-choices li.search-choice').each(function () {
							console.log('if inn');
							var selectedValue=$(this).children('span').text();
							console.log(selectedValue);
							if(selected_text !='')
								selected_text=selected_text+', ';
							selected_text=selected_text+selectedValue;
							$('#'+modifierid+' option').map(function () {
								if ($(this).text() == selectedValue)
								{
									new_dropdown_values.push($(this).val());
								}
							});
						});
						
						$(current_val).each(function(index,value) {
							var replace=value.replace(/~/g,'-');
							var replace=replace.replace(/[.]/g,'');
							var replace=replace.replace(/[(]/g,'');
							var replace=replace.replace(/[)]/g,'');
							var replace=replace.replace(/[&]/g,'and');
							var data_section_show_div=select_section.replace('prixfix-tab','additional_section');
							
							$('.'+data_section_show_div+' .'+replace).show();

							$('.'+data_section_show_div+' .'+replace).each(function() {

								var current_selected_value=$(this).children('.additonal_modifiers').val();

								var current_selected_text=$(this).children('.chosen-container-single').children('.chosen-single').children(' span').html();
								var error_section = $(this).children('.additonal_modifiers').attr('data-error');
								if(current_selected_value == '')
								{
									errors='1';
									$('#'+tabid+' .'+error_section).show();
									$('#'+tabid+' .'+error_section).html('Please select some option');
								}
							}); 
						});
					}
					var curcount= new_dropdown_values.length;
	
					//var curcount= $(this).val().length;
					if(modifier_min != 0)
					{
						if(curcount < modifier_min)
						{
							errors='1';
							$('#'+tabid+' .error_'+modifierid).show();
							$('#'+tabid+' .error_'+modifierid).html('Please select Minimum options');
						}
						else
						{
							//var curval=$(this).val();
							if(curcount > 0) {
								$.each(new_dropdown_values, function( index, value ) {
									if(value != null) {
										var currentmodifier=value.split("~");
										$('#'+tabid+' .error_'+modifierid).html();
										$('#'+tabid+' .error_'+modifierid).hide();
									}
								});
							}
						}
					}
				}
				else
				{
					console.log('else im');
					$('#'+tabid+' .error_'+modifierid).show();
					$('#'+tabid+' .error_'+modifierid).html('Please select Minimum options');
					errors='1';
				}
			}
			else
			{
				if($(this).val() == null)
				{
					nullerrors='1';
				}
				if($('#'+div_modifierid+'_chosen .chosen-single').length)
				{
					if($(this).val() !='')
					{
						var selectedValue=$('#'+div_modifierid+'_chosen .chosen-single').children('span').text();
						if(selected_text !='')
							selected_text=selected_text+', ';
						selected_text=selected_text+selectedValue;
					}
				}
				else
				{	
					$('#'+div_modifierid+'_chosen .chosen-choices li.search-choice').each(function () {
						var selectedValue=$(this).children('span').text();
						if(selected_text !='')
							selected_text=selected_text+', ';
						selected_text=selected_text+selectedValue;
					});
				}
				
				$('#'+tabid+' .error_'+modifierid).hide();
				$('#'+tabid+' .error_'+modifierid).html();
			}
		});
		
		if($('.choosen-editextramodifiers').length)
		{
			$('#'+tabid+' .choosen-editextramodifiers').each(function() {

				var modifierid=$(this).attr('id');
				var div_modifierid=modifierid.replace(/\-/g, '_');

				var current_val=$(this).val();

				if($(this).val() != null)
				{

					var new_dropdown_values=new Array();

						$('#'+div_modifierid+'_chosen .chosen-choices li.search-choice').each(function () {
							console.log('if inn');
							var selectedValue=$(this).children('span').text();
							console.log(selectedValue);
							if(selected_text !='')
								selected_text=selected_text+', ';
							selected_text=selected_text+selectedValue;
							$('#'+modifierid+' option').map(function () {
								if ($(this).text() == selectedValue)
								{
									new_dropdown_values.push($(this).val());
								}
							});
						});

					var curcount= new_dropdown_values.length;
					if(curcount > 0) {
						$.each(new_dropdown_values, function( index, value ) {
							if(value != null) {
								var currentmodifier=value.split("~");
								$('#'+tabid+' .error_'+modifierid).html();
								$('#'+tabid+' .error_'+modifierid).hide();
							}
						});
					}
				}
			});
		}
		if(errors == '0')
		{
			console.log(section);
			console.log(tabid);
			$('.prixfix_additonal_errors').html('').hide();
			if(nullerrors!='1' && selected_text !='')
			{
				$('.'+section+'-'+tabid).addClass('modifier_selected');
				$('.'+section+'-'+tabid).next('.modifier_selected_option').css('display','block');
				$('.'+section+'-'+tabid).next('.modifier_selected_option').html(selected_text);
			}
			else
			{
				$('.'+section+'-'+tabid).removeClass('modifier_selected');
				$('.'+section+'-'+tabid).next('.modifier_selected_option').html('');
				$('.'+section+'-'+tabid).next('.modifier_selected_option').hide();
			}
			updatemodifierprice();
			$('.setmeal_outskin').fadeOut();
			$('.head_list').fadeIn();
			return true;
		}
		else
		{
			return false;
		}
	});
	
	
	
	
});
function updatemodifierprice()
{
	var orginalproduct_price=$('#product_outprice').val();
	var setmealproducts=new Array();
	var set_meal_avoid=0;
	$('.choosen-editmodifiers').each(function() {
		var modifier_min=$(this).attr('data-min');
		var modifierid=$(this).attr('id');
		var div_modifierid=modifierid.replace(/\-/g, '_');

		if(modifier_min >= 1) 
		{

			if($(this).val() != null)
			{
				var new_dropdown_values=new Array();
				
				if($('#'+div_modifierid+'_chosen .chosen-single').length)
				{
					if($(this).val() !='')
					{
						var selectedValue=$('#'+div_modifierid+'_chosen .chosen-single').children('span').text().trim();
						$('#'+modifierid+' option').map(function () {
							if ($(this).text().trim() == selectedValue)
							{
								new_dropdown_values.push($(this).val());
							}
						});
					}
				}
				else
				{
					$('#'+div_modifierid+'_chosen .chosen-choices li.search-choice').each(function () {
						var selectedValue=$(this).children('span').text();
						$('#'+modifierid+' option').map(function () {
							if ($(this).text() == selectedValue)
							{
								set_meal_avoid=1;
								new_dropdown_values.push($(this).val());
							}
						});
					});
				}
				if(set_meal_avoid == 0) {
					var curcount= new_dropdown_values.length;
					if(modifier_min != 0)
					{
						if(curcount < modifier_min)
						{
							errors='1';
							$('.error_'+modifierid).show();
							$('.error_'+modifierid).html('Please select Minimum options');
						}
						else
						{
							setmealproducts.push(new_dropdown_values);
							$('.error_'+modifierid).hide();
							$('.error_'+modifierid).html();
						}
					}
					else
					{
						setmealproducts.push(new_dropdown_values);
						$('.error_'+modifierid).hide();
						$('.error_'+modifierid).html();
					}
				}
			}
			else
			{
				$('.error_'+modifierid).show();
				$('.error_'+modifierid).html('Please select Minimum options');
				errors='1';
			}
		}
		else
		{
			var new_dropdown_values=new Array();
			if($('#'+div_modifierid+'_chosen .chosen-single').length)
			{
				if($(this).val() !='')
				{
					var selectedValue=$('#'+div_modifierid+'_chosen .chosen-single').children('span').text().trim();
					$('#'+modifierid+' option').map(function () {
						if ($(this).text().trim() == selectedValue)
						{
							new_dropdown_values.push($(this).val());
						}
					});
				}
			}
			else
			{
				$('#'+div_modifierid+'_chosen .chosen-choices li.search-choice').each(function () {
					var selectedValue=$(this).children('span').text();
					$('#'+modifierid+' option').map(function () {
						if ($(this).text() == selectedValue)
						{
							new_dropdown_values.push($(this).val());
						}
					});
				});
			}
			setmealproducts=new_dropdown_values;
			$('.error_'+modifierid).hide();
			$('.error_'+modifierid).html();
		}
	});
	var modifier_price=0;
	var modifier_value_ids='';
	if(setmealproducts.length >= 1) {
		$.each(setmealproducts, function( index, value ) {
			if(value !='')
			{
				$.each(value, function (i2,v2) {
					modifier_sets=v2.split('~');
					console.log(modifier_sets);
					if(modifier_sets.length >= 3)
					{
						if(modifier_sets[3]){
							if(modifier_value_ids !='')
							{
								modifier_value_ids+=';';
							}
							modifier_value_ids=modifier_value_ids + modifier_sets[3];
						}
					}
					if(modifier_sets.length > 4)
					{
						if(modifier_sets[4]){
							modifier_price=modifier_price + parseFloat(modifier_sets[4]);
						}
					}
				});
			}
		});
	}
	
	/* getting extra modifier value price */
	var extra_modifier_price=0;
	if($('.extra_modifiers').length)
	{
		console.log('assa');
		$('.extra_modifiers').each(function(){
			var extra_dropdown_value=$(this).val();

			$(extra_dropdown_value).each(function(index,value) {
				var splitted_value=value.split('~');
				extra_modifier_price=parseFloat(extra_modifier_price)+parseFloat(splitted_value[4]);
				console.log(splitted_value);
			});
		});
		console.log(extra_modifier_price);
		console.log('checking');
	}
	

	var product_id=$('#product_id').val();

	var currency_symbol=$('#currency_symbol').val();
	
	if(($('.alacart_modifiers').length)) 
	{
		
		try 
		{
			$.ajax({
				url: admin_url+module+"/check_modifiers",
				type: "POST",
				data: {'product_id' : product_id,'modifier_value_ids':modifier_value_ids,'secure_key' : secure_key},
				success: function(data){
					var jsn = JSON.parse(data);
					if(jsn.status =='success')
					{
						var overall_price=(parseFloat(jsn.price)+parseFloat(extra_modifier_price)).toFixed(2);
						$('.model_content .edit_cart').show();
						$('.modifier_product_price').html(currency_symbol+overall_price);
					}
					else
					{
						$('.model_content .edit_cart').hide();
						showInfo(jsn.message,'Information');
					}
					$('.model_content .loading_modifier').remove();
				}
			});
		} 
		catch (e) { 
		}
	}
	else
	{
		console.log('orginal');
		console.log(orginalproduct_price);
		console.log(extra_modifier_price);
		var overall_price = (parseFloat(orginalproduct_price)+parseFloat(extra_modifier_price)).toFixed(2);
		console.log(overall_price);
		$('.model_content .edit_cart').show();
		$('.modifier_product_price').html('');
		$('.modifier_product_price').html(currency_symbol+overall_price);
	}
	return false;
	
	/*var modifyprice=parseFloat(modifier_price) + parseFloat(orginalproduct_price);
	$('.price_val').html("$"+modifyprice.toFixed(2));*/
}
	
function update_default_selected_modifiers(section,tabid,modifierid)
{
	var selected_text='';
	var div_modifierid=modifierid.replace(/\-/g, '_');

	if($('#'+div_modifierid+'_chosen .chosen-single').length)
	{
		if($('#'+modifierid).val() !='')
		{
			var selectedValue=$('#'+div_modifierid+'_chosen .chosen-single').children('span').text().trim();
			if(selected_text !='')
				selected_text=selected_text+', ';
			if(selectedValue !='Please select' ) {	
				selected_text=selected_text+selectedValue;
			}
		}
	}
	else
	{

		$('#'+div_modifierid+'_chosen .chosen-choices li.search-choice').each(function () {

			var selectedValue=$(this).children('span').text();

			if(selected_text !='')
				selected_text=selected_text+', ';
			selected_text=selected_text+selectedValue;
		});
	}
	if(selected_text !='')
	{
		$('.'+section+'-'+tabid).next('.modifier_selected_option').css('display','block');
	}
	else
	{
		$('.'+section+'-'+tabid).next('.modifier_selected_option').hide();
	}
	$('.'+section+'-'+tabid).next('.modifier_selected_option').html(selected_text);
}

/* to get the additional modifiers when choosing the prixfix modifier values */
$(document).ready(function() { 
	if($('.prixfixselectors').length) {
		$('.prixfixselectors').change(function() {

			var current_val=$(this).val();
			var data_section=$(this).attr('data-section');
			var data_section_show_div=data_section.replace('prixfix-tab','additional_section');
			$('.'+data_section_show_div+' .additonal_modifiers').val('');
			$('.'+data_section_show_div+' .additional_div_section').hide();

			if(current_val != null ) {
				if($.isArray(current_val)) {
					$(current_val).each(function(index,value) {
						var replaces=value.replace(/~/g,'-');
						var replace=replaces.replace(/[.]/g,'');
						var replace=replace.replace(/[(]/g,'');
						var replace=replace.replace(/[)]/g,'');
						var replace=replace.replace(/[&]/g,'and');

						$('.'+data_section_show_div+' .'+replace).css('display','block');
						$('.'+data_section_show_div+' .'+replace).each(function() {

							if($(this).children('.chzn-container-single').children('.chzn-single').children('span').length) {
								var current_selected_values=$(this).children('.chzn-container-single').children('.chzn-single').children('span').html();
								$(this).children('select').children('option').filter(function() {

									if($(this).text().trim() == current_selected_values.trim())
									{
										$(this).prop("selected",true);
									}
								});
							}
						}); 
					});
				}
				else if(current_val != '')
				{
					var replace=current_val.replace(/~/g,'-');
					var replace=replaces.replace(/[.]/g,'');
					var replace=replace.replace(/[(]/g,'');
					var replace=replace.replace(/[)]/g,'');
					var replace=replace.replace(/[&]/g,'and');
					$('.'+data_section_show_div+' .'+replace).show();
				}
			}
		});
	}
});

/* adding product to the cart */

$(document).on('click', '.edit_cart' , function() {
	var modifier_json_value='';
	var error =0;
	var modifier_type='';
	/* getting the modifier values */

		if($('.prod_modifiers').length) {
			var additional_modifiers_val='';
			$('.prod_modifiers').each(function() {
				var additional_modifiers_val='';
				var cur_val=$(this).val();
				var data_min=$(this).attr('data-min');
				var data_max=$(this).attr('data-max');
				var cur_id=$(this).attr('id');
				if($.isArray(cur_val)) {
					if(cur_val.length >= data_min && cur_val.length <= data_max) {
						$('#'+cur_id).next().next('span').remove();

						
						$(cur_val).each(function(index,value) {
		
							var current_val_div=value.replace(/~/g,'-');
							var current_val_div=current_val_div.replace(/[.]/g,'');
							var current_val_div=current_val_div.replace(/[(]/g,'');
							var current_val_div=current_val_div.replace(/[)]/g,'');
							var current_val_div=current_val_div.replace(/[&]/g,'and');
							var additional_modifiers_val='';
	
							if($('.'+current_val_div).length)
							{

								$('.'+current_val_div+' .additional_modifiers').each(function() {
									
									var new_div=$(this).attr('id');

									if($(this).val() !='') {
										additional_modifiers_val=additional_modifiers_val+($(this).val())+'!';
									}
									else
									{
										error=1;
										$('#'+new_div).parent().children('.error').remove();
										$('#'+new_div).next().after('<span class="error">select atleast 1 modifier</span>');
									}
								});
								console.log(additional_modifiers_val);
							}
							modifier_json_value=modifier_json_value+value+'?'+additional_modifiers_val+'|';
						});
					}
					else
					{
						error=1;
						$('#'+cur_id).parent().children('.error').remove();
						$('#'+cur_id).next().after('<span class="error">select atleast '+data_min+' modifier</span>');
					}
				}
				else if(cur_val != '' && cur_val !=null)
				{

					if($(this).val() !='') {
						$('#'+cur_id).next().next('span').remove();
						var current_val_div=cur_val.replace(/~/g,'-');
						var current_val_div=current_val_div.replace(/[.]/g,'');
						var current_val_div=current_val_div.replace(/[(]/g,'');
						var current_val_div=current_val_div.replace(/[)]/g,'');
						var current_val_div=current_val_div.replace(/[&]/g,'and');
						if($('.'+current_val_div).length)
						{
							$('.'+current_val_div+' .additional_modifiers').each(function() {
								additional_modifiers_val=additional_modifiers_val+($(this).val())+'!';
							});
						}
						modifier_json_value=modifier_json_value+$(this).val()+additional_modifiers_val+'|';
					}
					else
					{
						error=1;
						$('#'+cur_id).parent().children('.error').remove();
						$('#'+cur_id).next().after('<span class="error">select atleast '+data_min+' modifier</span>');
					}
				}
				else
				{
					error=1;
					$('#'+cur_id).parent().children('.error').remove();
					$('#'+cur_id).next().after('<span class="error">select atleast '+data_min+' modifier</span>');
				}
				
			});
			modifier_type='prix';
		}

		/* this is for alacart product modifiers selection list */
		if($('.alacart_modifiers').length) {
			$('.alacart_modifiers').each(function() {
				var cur_id=$(this).attr('id');
				if($(this).val() !='') {
					modifier_json_value=modifier_json_value+$(this).val()+'|';
				}
				else
				{
					error=1;
					$('#'+cur_id).parent().children('.error').remove();
					$('#'+cur_id).next().after('<span class="error">select atleast 1 modifier</span>');
				}
			});
			modifier_type='alacart';
		}
		
		var extra_modifiers =new Array();
		if($('.extra_modifiers').length)
		{
			$('.extra_modifiers').each(function(){
				if($(this).val() != null) {
					extra_modifiers.push($(this).val());
				}
			});
		}
		var extramodify=extra_modifiers;

	/* getting adding product details  */
	var product_id = $('#product_id').val();
	var product_qty = $('#product_qty').val();
	var rowid = $('#rowid').val();

	if(error == 0) {
		try 
		{
			$('.edit_cart').hide();
			$(".edit_cart").before(loading_icon);
			jQuery.ajax({
			type: "POST",
			url: admin_url+module +"/add_cart_items",
			synchronous: false,
			data: {  product_id: product_id,product_qty:product_qty,modifier_json:modifier_json_value,modifier_type:modifier_type,extra_modifiers:extramodify, secure_key:secure_key,rowid:rowid } })
			.done(function(data){
				$('.loading').remove();
				$('.edit_cart').show();
				response = $.parseJSON(data);
				if(response.status == "success") {
					window.location.href=admin_url+"order";
					$('.pop_close').trigger('click');
					$('#order_details').html(response.html);
					sticky_relocate();
					checkfixedpart_height();
					if(!$('.customer_heading').hasClass('collapsed'))
					{
						$('.customer_heading').addClass('collapsed');
						$('#customer_details').removeClass('in');
					}
				}
				if(response.status == 'error'){
					showInfo(response.msg,'Information');
				} 	
				

			});
		} 
		catch (e) { 
			  //alert("Something went wrong.");
		}
	}
});
