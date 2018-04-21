$(function() {
	$(".navbar-expand-toggle").click(function() {
		$(".app-container").toggleClass("expanded");
		return $(".navbar-expand-toggle").toggleClass("fa-rotate-90");
	});
	return $(".navbar-right-expand-toggle").click(function() {
		$(".navbar-right").toggleClass("expanded");
		return $(".navbar-right-expand-toggle").toggleClass("fa-rotate-90");
	});
});



$(function() {
	return $('.search_select').chosen({	
	});
});

$(function() {
	return $('select').chosen({
		 // "disable_search": true
	});
});

function trigger_chosen()
{
	$('select').chosen({
		//"disable_search": true
	});
}

$(function() {
	if($('.toggle-checkbox').length)
	{
		return $('.toggle-checkbox').bootstrapSwitch({
			size : "small"
		});
	}
});

$(function() {
	if($('.match-height').length)
	{
		return $('.match-height').matchHeight();
	}
});

/*******************************************************************************
 * * removed tadatable - devteam $(function() { return
 * $('.datatable').DataTable({ "dom": '<"top"fl<"clear">>rt<"bottom"ip<"clear">>'
 * }); });
 ******************************************************************************/

$(function() {
	return $(".side-menu .nav .dropdown").on('show.bs.collapse', function() {
		return $(".side-menu .nav .dropdown .collapse").collapse('hide');
	});
});

/* Common form validation and for submit - start */
var loading_icon = get_loading_icon('form_submit col-sm-offset-2 col-sm-4 publish_submit');
wrapper_val = container =  error_val = "";
if( typeof(validation_container) !="undefined" && validation_container == "Yes")  {
	var wrapper_val = "li";
	var container = $('div.container_div');
	var error_val = 'span';
}else {
	var error_val = 'label';
}

var container = $('div.container_div'); 
$("#common_form").validate(
{    	
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
		if($('select.choosenclass').length)
		{
			$('select.choosenclass').each(function() {
				var selection = $(this).getSelectionOrder();
				$(this).parent().parent().children('.selectval').val(selection);
				console.log(selection);
				/*$(this).val(selection);*/
			});
		}
		$("#common_form").ajaxSubmit({
			type : "POST",
			dataType : "json",
			url :  admin_url + module + "/" + module_action,
			data : $("#common_form").serialize(),
			cache : false,
			success : function(data) {
				response = data;
				$(".btn_submit_div").show();
				$(".form_submit").remove();

				if (response.status == "success") {
					 var redirect =  (typeof(custom_redirect_url) !="undefined" && custom_redirect_url !="" )?  custom_redirect_url :  module;
					
					window.location.href = admin_url + redirect;
					
				} else if (response.status == "error") {
					$(".alert_msg,.container_div").show();
					$(".alert_msg").html(data.message);
					$('.side-body').scrollView();
					
				}

			}
		});

	}
});


/* Common form validation and for submi - end */

/* hide error on chnage the select box... */
$(document).ready(function() {
	$('select').change(function() { 
		$(this).parents('.col-sm-4,.col-sm-8').find('.error').hide();
	});


	

	/* trigger timeout function  */
	setTimeout(function() { user_alive(); },2000);
	


});
$(window).load(function() {
	
	$('.cmmn_error').delay(10000).slideUp(function(){$(this).hide();});
});

/* color box enable .. */
$( document ).ajaxComplete(function() {
	if($('.ajax-popup').length) {
		$('.ajax-popup').magnificPopup({
			 type: 'ajax',
		   alignTop: true,
		   overflowY: 'scroll',
		   midClick:false,
		   closeOnContentClick:false,
		   closeOnBgClick:false,
		   preloader: true,	
		   enableEscapeKey:false,
		   fixedBgPos: true,  
		});
	}
	
	$('#assign_rider_popup').magnificPopup({
		type: 'ajax',
		alignTop: true,
		overflowY: 'scroll'  
	});
	
	});
/* get loading icon */
function get_loading_icon(class_name) {
	return loding_img = "<div class=\""
			+ class_name
			+ " loading\"><img src=\""
			+ lod_lib
			+ "theme/images/loading_icon_default.gif\" class=\"\" alt=\"Loading...\" /> </div>";

}

/*show  alert message*/
function showerror(errorclas,errormessage)
{ 
	$(".cmmn_error").hide();
    $("."+errorclas).show().find('.msg').html(errormessage);
	$('.cmmn_error').delay(10000).slideUp(function(){$(this).hide();});
	
	 
}
function submits(urls) {
	 $("#common_form1").submit(function(b) {
        b.preventDefault();
         $form = $('#common_form1');
         fd = new FormData($form[0]);
        $.ajax({
            url: urls,
            type: "POST",
            data: fd,
			cache : false,
			processData: false,
            contentType: false,
			success : function(data) {
				response = eval('('+data+')');
				console.info(response);			
				if (response.status == "success") {
					 $.magnificPopup.close();
					 var redirect ="export";
					window.location.href = admin_url + module + "/" + redirect;
				} else if (response.status == "error") {
					//alert(response.message);				
					$(".alert_msg,.container_div").show();
					$(".alert_msg").html(response.message);
					$('.side-body').scrollView();				    
				}

			}
		});
});
}



/*scrool to top */
$.fn.scrollView = function () { 
	  return this.each(function () {
	    $('html, body').animate({
	      scrollTop: $(this).offset().top
	    }, 1000);
	  });
	}

/* function used to check user alive or session destroy */
function user_alive()
{

	$.ajax({
		url: admin_url+"keep_alive",
		data : {'secure_key': secure_key},
		type :'POST', 
		dataType:"json",
		success:function(data){
			
			if(data.status == "error")
				{
				    window.location.href= data.redirect_url;
				}
			
			if(data.status == "new_order")
			{
				 window.location.href= admin_url+"orders";
			}
			
			setTimeout(function() { user_alive(); },2000);
		}
	});
}

/* is number only */
function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;  
    if ( charCode > 31 && ( charCode < 48 || charCode > 57 )   ) {
        return false;
    }
    return true;
}

/* is number only */
function isFloat(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;  
    if ( charCode > 31 && ( charCode < 48 || charCode > 57 ) && charCode != 46 ) {
        return false;
    }
    return true;
}

/* custom alert box */

function customAlertmsg(alrtmessage,alertheader)
{
$('.alrt_overlay').remove();
$('.custom_alert').remove();

alertheader =  (typeof(alertheader) =="undefined" )?  "Confirmation" :  alertheader;
	$('body').append('<div class="alrt_overlay"></div><div class="custom_alert"><div class="custom_alertin"><div class="alert_height"><div class="alert_header">'+ alertheader +'</div><div class="alert_body"> '+ alrtmessage +' <div class="alt_btns"><a href="javascript:;" class="btn btn-primary confirm" id="alt1">OK</a><a href="javascript:;" class="btn btn-info reject" id="alt0">Cancel</a></div></div></div></div></div>');
	
        var actheight=$('.alert_height').height();
		$('.custom_alert').height(actheight+10);
    
	
	$('.alt_btns a').click(function(e) {
	   $('.alrt_overlay, .custom_alert').remove();
       
    });
}

/* showing the amount box when a particular is enabled */
$(document).ready(function() {
$('.show_amount_box .bootstrap-switch span').click(function() {  
setTimeout(function(){ $('.show_amount_box .bootstrap-switch span').click(function() {
	
var show_div=$(this).parent().parent().parent().attr('data-id');
	var input_id=$(this).parent().children('.toggle-checkbox').attr('id');
	console.log(input_id);
	if($('#'+input_id).is(':checked'))
	{
		$('#'+show_div).show();
	}
	else
	{
		$('#'+show_div).hide();
	}
});
}, 250);
});});
/* Information  alert box */

function showInfo(alrtmessage,alertheader)
{
$('.alrt_overlay').remove();
$('.custom_alert').remove();

alertheader =  (typeof(alertheader) =="undefined" )?  "Information" :  alertheader;


	$('body').append('<div class="alrt_overlay"></div><div class="custom_alert"><div class="custom_alertin"><div class="alert_height"><div class="alert_header">'+ alertheader +'</div><div class="alert_body"> '+ alrtmessage +' <div class="alt_btns"><a href="javascript:;" class="btn btn-info reject" id="alt0">Close</a></div></div></div></div></div>');
	
        var actheight=$('.alert_height').height();
		$('.custom_alert').height(actheight+10);
    
	
	$('.alt_btns a').click(function(e) {
	   $('.alrt_overlay, .custom_alert').remove();
       
    });
}
function _24hourformat(tim) {
		
				var _time = tim.split(':');
				var _hours = _time[0]; 

				_time = _time[1].split(' ');

				var _min = _time[0]; 
				var _ampm = _time[1]; 

				if(_ampm == 'PM' && _hours != '12')
						_hours = parseInt(_hours) + 12;

				 if(_ampm == 'AM' && _hours == '12')
						hours = '0';

				_time = _hours+'.'+_min;
				_time = Number(_time);

		return _time;
}


function submits1(urls) {
	 $("#common_form1").submit(function(b) {
        b.preventDefault();
         $form = $('#common_form1');
         fd = new FormData($form[0]);
        $.ajax({
            url: urls,
            type: "POST",
            data: fd,
			cache : false,
			processData: false,
            contentType: false,
			success : function(data) {
				response = eval('('+data+')');
				console.info(response);			
				if (response.status == "success") {
					 $.magnificPopup.close();
					 var redirect ="export";
					 window.location.href = admin_url + module;
				} else if (response.status == "error") {
					//alert(response.message);				
					$(".alert_msg,.container_div").show();
					$(".alert_msg").html(response.message);
					$('.side-body').scrollView();				    
				}

			}
		});
});
}

function submitclear(urls) {
	 $("#common_form1").submit(function(b) {
        b.preventDefault();
         $form = $('#common_form1');
         fd = new FormData($form[0]);
		$(".clearbutton").hide();
		$(".loadappend").append(get_loading_icon());
        $.ajax({
            url: urls,
            type: "POST",
            data: fd,
			cache : false,
			processData: false,
            contentType: false,
			success : function(data) {
				response = eval('('+data+')');
				console.info(response);			
				if (response.status == "success") {
					 $.magnificPopup.close();
					 var redirect ="export";
					 window.location.href = admin_url + module;
					 $(".clearbutton").show();
					 $(".loadappend").remove();
				} else if (response.status == "error") {
					//alert(response.message);				
					$(".alert_msg,.container_div").show();
					$(".alert_msg").html(response.message);
					$('.side-body').scrollView();				    
					$(".clearbutton").show();
					$(".loadappend").remove();
				}

			}
		});
});
}
