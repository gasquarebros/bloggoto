/* this file used to product related function */
$(document).ready(function() {
	
/* change category get subcategory - Ajax call */
$("#product_category").change(function() {
var category_val = $("#product_category").val();
if(category_val !="" )
{
	$.ajax({
		url: admin_url+module +"/get_subcategory_listing",
		data : { category_id: category_val, secure_key:secure_key },
		type :'POST', 
		dataType:"json",
		success:function(data){
			if(data.html !=""){
				
				$("#subcategory_div").html(data.html);
				
				$(function() {
					return $('.search_select').chosen({
					});

				});
				
			}
			
		}
	});
}

});	

/*  show and hide menu set component div */
$("#product_type").change(function(){ return  false;
	
	var sel_value = $(this).val();
	
	   if(sel_value == 2 ){ 
		   $("#set_menu_component_div").show();
		   $("#product_modifier_set").hide();
		   
	   }	  
	   else{
	 
		   $("#set_menu_component_div").hide();
		   $("#product_modifier_set").show();
	   }
	
});


});

/* multi image upload ...*/
$(document).ready(function() {

    var max_fields      = 15;  
	var wrapper         = $(".multi_field");  
	var add_button      = $(".add_field_button");  

    var x = 1;  
	$(add_button).click(function(e){  
	
		e.preventDefault();
		if(x <= max_fields){  
			x++;  
	
		var html = '<div class="form-group">'+
			'<label for="inputEmail3" class="col-sm-2 control-label"> </label>'+
			'<div class="col-sm-8"> <div class="input_box"><div class="custom_browsefile"><input type="file" name="product_gallery[]" class="ajax_image" ><span class="result_browsefile"><span class="brows"></span> + '+gallery_image_label+'</span> </div> </div> </div>'+
			
			'<div class="col-sm-2 "><span class="remove_field more_link fa fa-close"></span></div>'+
			//'<div class="radio3"><input id="default_image'+x+'" type="radio" value="default_image" name="default_image[]"><label for="default_image'+x+'">&nbsp;</label></div>'
			'</div>';			  
           
			$(".multi_field").last().after(html);  
		}
	});

	$(document).on('click', '.remove_field' , function() {
		$(this).parent().parent().remove();
	    x--;
        var rel_attr=$(this).attr('rel');
	 

	});
	
	/*  gallery image unlink option */
	$(".gallery_delete").click(function() {
		  var gallery_id = this.id;  
		  customAlertmsg("Are you sure you want to delete this image?");	
		   $( "#alt1" ).click(function() { 
			  
			
				$.ajax({
					url: admin_url+module +"/unlink_gallery_image",
					data : { gallery_id: gallery_id, secure_key:secure_key },
					type :'POST', 
					dataType:"json",
					success:function(data){
						if(data.status == "success"){
							
						 $("#"+gallery_id).remove();
							
						}
						else {
							
							showInfo(data.msg);
						}
					}
				});
		  });
	});

 /* On change category get related modifiers */
/* 
 * commented by devteam */
	$(".check_option").change(function(){
		var product_id = $(this).val();
		
		/* enable or disable selectbox */
		if (product_id != "") { 
			$(".modi_div").hide();
			$(".defalut_pr_div").show();
		} else {
			$(".modi_div").show();
			$(".defalut_pr_div").hide();
		}

		
		$.ajax({
			url: admin_url+module +"/check_alias",
			data : { product_id: product_id, secure_key:secure_key },
			type :'POST', 
			dataType:"json",
			success:function(data){
				if(data.status == "success"){
				 
					$("#category_div").html(data.dropdown);
					$(function() {
						return $('select').chosen({
						});

					});
				}
				else {
					
					//showInfo(data.msg);
				}
			}
		});
		
	}) 
	


						/* enable or disable product modifiers */
	$("#product_type").change(function() {
		
	  var type = $(this).val();	 
	 
	  //var products_list = $("#products_list").val();
	   if(type == 2 )
	   {
		   $(".addonslabel").hide();
		   $(".modi_div").hide();
		   $(".defalut_pr_div").hide();
	   }
	    else if(type == 3)
	   {		   
		   $(".addonslabel").show();
		   $(".addons_div").hide();		   		   
		   $(".par_div").hide();
		   $(".modi_div").hide();
		   $(".defalut_pr_div").hide();
	   }
	   else 
	   {
		   if($(".par_div").hasClass('catering_div'))
		   {
			    $(".par_div").hide();
		   }
		   $(".addonslabel").hide();
		   $(".addons_div").show();	
		   $(".modi_div").show();
		   $(".defalut_pr_div").show();
	   }
	});
 
	});


/* add combo set */
$("body").on('click', '.add_combo', function() {
	load_combo_html('Yes');
});

/* Remove combo set */
$("body").on('click', '.combo_remove', function() {
	var id_val = this.id;
	$("." + id_val).remove();
});

/* load combo products */
$(window).load(function() {

	var form_action = $("#form_action").val();

	if (form_action == "add") {  

		load_combo_html('No');
	}
});


function load_combo_html() {  

	var combo_count = $("#combo_set_count").val();
	$.ajax({
		url : admin_url + module + "/get_combo_html",
		data : {
			secure_key : secure_key,
			combo_count : combo_count,
		},
		type : 'POST',
		dataType : "json",
		success : function(data) {
			if (data.html != "") {
				$(".combo_append_html").append(data.html);
				$("#combo_set_count").val(parseInt(combo_count) + 1);
				$('select').chosen({});
			}

		}
	});

}




 
