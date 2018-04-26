/* fancy tree..
 * created by kvin
 * */
$(document).ready(function() {  

/*if click category show sub categorys */
$(".category_parent").click(function() {
	 $(this).toggleClass('open_icon');
     $(this).parent('.category_li').find('.subcategory_ul').toggle();
});

/*if click subcategory Products */
$(".subcategory_parent").click(function() {
	 $(this).toggleClass('open_icon');
     $(this).parent('.subcategory_li').find('.product_ul').toggle();
});

/* if category checkbox checked... */
$(".category_checkbox").change(function(){
	$(this).parents('.category_li').find(".subcategory_checkbox, .product_checkbox").prop('checked', $(this).prop("checked"));
});

/* if category checkbox checked... */
$(".subcategory_checkbox").change(function(){
	$(this).parents('.subcategory_li').find(".product_checkbox").prop('checked', $(this).prop("checked"));
	var subcate_lenght = $(this).parents('.category_li').find('.subcategory_checkbox:checked').length;
	if(subcate_lenght == 0 ) {  
	     $(this).parents('.category_li').find(".category_checkbox").prop('checked',  false);
	 }
	else{  
	    $(this).parents('.category_li').find(".category_checkbox").prop('checked',true);
	 }
});

/* if prodc checkbox checked... */
$(".product_checkbox").change(function(){
    var product_lenght = $(this).parents('.subcategory_li').find('.product_checkbox:checked').length;

	
    if( product_lenght == 0 ) {
      $(this).parents('.subcategory_li').find(".subcategory_checkbox").prop('checked',  false);
	}
	else{
	  $(this).parents('.subcategory_li').find(".subcategory_checkbox").prop('checked', true);
	}
	var subcate_lenght = $(this).parents('.category_li').find('.subcategory_checkbox:checked').length;
	
    if(subcate_lenght == 0 ) {  
	   $(this).parents('.category_li').find(".category_checkbox").prop('checked',  false);
	 }
	 else{  
	   $(this).parents('.category_li').find(".category_checkbox").prop('checked',true);
	 }
});

 });