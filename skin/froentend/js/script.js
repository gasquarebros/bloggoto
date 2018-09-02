$('.copy_to_clipboard').click(function(){
  var text=$(this).attr('data-text');
  var self=$(this);
  copyToClipboard(self,text);
});
function copyToClipboard(current,text) {
  var temp = $("<input>");
  $("body").append(temp);
  temp.val(text).select();
  document.execCommand("copy");
  temp.remove();
  $("#success-alert").remove();
  current.append('<span id="success-alert">Copied to Clipboard</span>');
  setTimeout(function() { 
	current.parent().find("#success-alert").remove();
  }, 3000);
}

$('.device_nav li').each(function() {
	$(this).children('ul').parent('li').append('<span class="s_arrow"></span>');
});
$('.nav_triger').click(function(){
    $(this).toggleClass('active');
	$('.device_nav').stop().slideToggle(300);
	$('.device_nav li').removeClass('active');
	$('.device_nav ul').slideUp(300);
});

/* More Item display */
$('.more_items').click(function(){
    $(this).toggleClass('active');
	$('.section_menu').toggleClass('more_menu');
});

function isInView(el) {
  var rect = el.getBoundingClientRect();           // absolute position of video element
  return !(rect.top > $(window).height() || rect.bottom < 0);   // visible?
}


$(window).scroll(function(){
	if($(this).scrollTop() !=0){
		$('#back-to-top').fadeIn();
	}
	else{
		$('#back-to-top').fadeOut();
	}
	
	$('video').each(function(){
		if($(this).hasClass('autoplay')) {
			if (isInView($(this)[0])) {                    // visible?
			  if ($(this)[0].paused) $(this)[0].play();    // play if not playing
			}
			else {
				console.log($(this).attr('src'));
			  if (!$(this)[0].paused) $(this)[0].pause();  // pause if not paused
			}
		}

	})
	
});
$('#back-to-top').click(function(){
	$('body,html').animate({scrollTop:0}, 800);
});

/* Toggle the news feed */
$(document).on('click', '.toggle_feed',function(){
    $(this).toggleClass('active');
    $(this).parent().parent().parent('.single_feed').children('.toggle_content').slideToggle();
    $(this).parent().parent('.feed_wrapper').children('.toggle_content').slideToggle();
});
/* Custom Browse */    
    $(window).load(function(e) {
		var fileinput=$('input[type=file]:not(.notneeded)');
		fileinput.each(function() {
		$(this).wrap('<div class="custom_file"></div>');
		$(this).parent('.custom_file').append('<span class="result"><span class="brows"></span></span>');
		var inputval=$(this).val();
		var placeholder=$(this).attr('placeholder');
		if(inputval)
		{
			$(this).next('.result').html('<span class="brows">Browse </span>'+inputval);
		}
		else if(placeholder)
		{
			$(this).next('.result').html('<span class="brows">Browse '+placeholder+' </span>');
		}
		else
		{
		$(this).next('.result').html('<span class="brows">Browse </span>');
		}
		});
		fileinput.change(function(e) {
		$(this).next('.result').html('<span class="brows">Browse </span>'+$(this).val());
		});
		/*
		$('img').one('load',function() {
			setTimeout(equalheight(), 2000);
		});*/
		// setTimeout(function(){ $('.close').trigger('click') } , 4000);

	
    });
	
	$(window).resize(function(){
		
		//setTimeout(equalheight(), 2000);
		//equalheight();
	});
/*
function equalheight()
{
	if($('.list_row_section').length)
	{
		$('.list_row_section').each(function(){
			var rowheight = 0;
			
			$(this).children('.list_row').each(function() {
				
				if($(this).children('.list_col').outerHeight() >= rowheight)
				{
					rowheight = $(this).children('.list_col').outerHeight();
				}
				var img_hgt = $(this).children('.list_img').outerHeight();
				var list_decp = $(this).children('.list_decp').outerHeight();
				
				if(img_hgt >= list_decp && img_hgt >= rowheight)
				{
					rowheight = img_hgt;
				}
				else if(list_decp >= rowheight)
				{
					rowheight = list_decp;
				}
				else {
					rowheight = rowheight;
				}
			});
			
			$(this).children('.list_row').outerHeight(rowheight);
		});
	}
} */ 
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



/* showing the ajax condiments list */
$('.ajax_popup').magnificPopup({
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
 
function triger_ajax_popup()
{
	$('.ajax_popup').magnificPopup({
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
window.setInterval(function() {  
		$.ajax({
			type :'POST', 
			url  : SITE_URL+'myprofile/pull_post_log',
			data : {secure_key:secure_key},	
			dataType:"json",
			success:function(data){ 
				if(data.status=="success")
				{ 
					notify_html='<i class="fa fa-bell-o" aria-hidden="true"></i><span class="badge notification_circle">'+data.count+'</span>'
					msg_notify_html='<i class="fa fa-envelope-o" aria-hidden="true"></i><span class="badge notification_circle">'+data.msg_count+'</span>'
					//$(".notify").html(notify_html);"#results span:first"
					if(data.count >0)
					{
						$( ".icons_wrap .notify" ).html(notify_html)
						$('.icons_wrap .notify').addClass('active');
					}
					if(data.msg_count > 0)
					{
						$( ".icons_wrap .message" ).html(msg_notify_html)
						$('.icons_wrap .message').addClass('active');
					}
				} 
				else 
				{
					$('.icons_wrap .notify').removeClass('active');
					$(".icons_wrap .notify-count-div").html('');
				}
 
			},
			error: function(jqXHR, textStatus, errorThrown) 
			{
  				// console.log(textStatus, errorThrown);
			}
		});
}, 5000);
	$(document).on('click', '.post_report', function(e) {		
		var dataid = $(this).attr('data-id');
		var action = $(this).attr('title');
		//show_content_loading(); 
		//$('.load_more').hide();
		$.ajax({
			url  : SITE_URL+'home/reportpost',
			data : {secure_key:secure_key,dataid:dataid,action:action},
			type : 'POST',
			dataType : "json",
			async:false,
			success : function(data) {
				//hide_content_loading();
				if (data.status == "ok") 
				{
					$('.alert-success').find("label").text(data.message);
					$('.alert-success').show();
					$('html, body').animate({
						'scrollTop' : $(".alert-success").position().top
					});
				}
				if (data.status == "error") 
				{
					 // alert('');
				}
			}
		});
	});
	$(document).on('click', '.post_delete', function(e) {		
		var dataid = $(this).attr('data-id');
		var action = $(this).attr('title');
			customAlertmsg("Are you sure you want to delete permanently? Yes, No");	
	   $( "#alt1" ).click(function() {		
		//show_content_loading(); 
		//$('.load_more').hide();
		$.ajax({
			url  : SITE_URL+'home/deletepost',
			data : {secure_key:secure_key,dataid:dataid,action:action},
			type : 'POST',
			dataType : "json",
			async:false,
			success : function(data) {
			//	hide_content_loading();
				if (data.status == "ok") 
				{
					location.reload();
				}
				if (data.status == "error") 
				{
					 // alert('');
				}
			}
		});
		});
	});		

$('.reload-captcha').click(function(event){
	event.preventDefault();
	$.ajax({
	   url:SITE_URL+'contact/create_captcha',
	   success:function(data){
		  $('.captcha-img').html(data);
	   }
	});            
});

$(document).on('click','.post_options_action',function(e) { 
	e.stopPropagation();
	$('.post_options_action').not(this).each(function() {
		$(this).children('.show_post_options').hide();
	});
	$(this).children('.show_post_options').not('a').slideToggle();
	
});
	$(document).on('click', '.mark_read', function(e) {	
		var data_type = $(this).attr('data-type');
		if($(this).find('.comment').val() !='') {
			//show_content_loading(); 
			$.ajax({
				url : SITE_URL+'myprofile/notify_mark_read',
				data : {secure_key:secure_key,data_type:data_type},
				type : 'POST',
				dataType : "json",
				async:false,
				success : function(data) {
					//hide_content_loading();
					if (data.status == "success") 
					{
						$('.mailboxer_conversation').attr('style','');
					}
					else
					{

					}
				}
			});
		}
		return false;
	});
	$(document).on('click', '.account_delete', function(e) {	
		var url = $(this).attr('action');
		var dataaction = $(this).attr('data-action');
            // showInfo("Please select category.", "Message");		
			customAlertmsg("Are you sure you want to delete permanently? Yes, No");	
	   $( "#alt1" ).click(function() {
			//show_content_loading(); 
			$.ajax({
				url : url,
				data : {secure_key:secure_key,action:dataaction},
				type : 'POST',
				dataType : "json",
				async:false,
				success : function(data) {
					//hide_content_loading();
					if (data.status == "success") 
					{
						$(".cmmn_error").show();
						$('.cmmn_error').find(".msg").html(data.message);					
					}
					else
					{
						$(".cmmn_error").show();
						$('.cmmn_error').find(".msg").html(data.message);
					}
				}
			});
		 });
		return false;
	});

	$(document).on('click', '.like_popup', function(e) {		
		var popup_type = $(this).attr('data-pop-type');
		var data_target = $(this).attr('data-target');
		var url = $(this).attr('href');
		show_content_loading(); 
		$.ajax({
			url : url,
			data : "secure_key="+secure_key+"&action="+popup_type,
			type : 'POST',
			dataType : "json",
			async:false,
			success : function(data) {
				hide_content_loading();
				if (data.status == "success") 
				{
					$('#like_modal_div').html(data.html);
					$('#like_modal_div').trigger('click');
					// $('#follow_modal_div'+data_target).trigger('click');
				}
			}
		});
		return false;
	});		