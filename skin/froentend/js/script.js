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

$(window).scroll(function(){
	if($(this).scrollTop() !=0){
		$('#back-to-top').fadeIn();
	}
	else{
		$('#back-to-top').fadeOut();
	}
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
		var fileinput=$('input[type=file]');
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
		setTimeout(equalheight(), 2000);
		setTimeout(function(){ $('.close').trigger('click') } , 4000);

	
    });
	
	$(window).resize(function(){
		equalheight();
	});

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
			});
			$(this).children('.list_row').outerHeight(rowheight);
		});
	}
}
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
					$( ".icons_wrap .notify" ).html(notify_html)
					$('.icons_wrap .notify').addClass('active');
					$( ".icons_wrap .message" ).html(msg_notify_html)
					$('.icons_wrap .message').addClass('active');
				} 
				else 
				{
					$('.icons_wrap .notify').removeClass('active');
					$(".icons_wrap .notify-count-div").html('');
				}
 
			},
			error: function(jqXHR, textStatus, errorThrown) 
			{
  				console.log(textStatus, errorThrown);
			}
		});
}, 5000);
	$(document).on('click', '.post_report', function(e) {		
		var dataid = $(this).attr('data-id');
		var action = $(this).attr('title');
		show_content_loading(); 
		$('.load_more').hide();
		$.ajax({
			url  : SITE_URL+'home/reportpost',
			data : {secure_key:secure_key,dataid:dataid,action:action},
			type : 'POST',
			dataType : "json",
			async:false,
			success : function(data) {
				hide_content_loading();
				if (data.status == "ok") 
				{
					$('.alert-success').find("label").text(data.message);
					$('.alert-success').show();
				}
				if (data.status == "error") 
				{
					 // alert('');
				}
				 $('html,body').animate({ scrollTop: $('.alert-warning').offset().top }, 1000);
			}
		});
	});
	$(document).on('click', '.post_delete', function(e) {		
		var dataid = $(this).attr('data-id');
		var action = $(this).attr('title');
		show_content_loading(); 
		$('.load_more').hide();
		$.ajax({
			url  : SITE_URL+'home/deletepost',
			data : {secure_key:secure_key,dataid:dataid,action:action},
			type : 'POST',
			dataType : "json",
			async:false,
			success : function(data) {
				hide_content_loading();
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

$('.reload-captcha').click(function(event){
	event.preventDefault();
	$.ajax({
	   url:SITE_URL+'contact/create_captcha',
	   success:function(data){
		  $('.captcha-img').html(data);
	   }
	});            
});

$(document).on('click','.post_options_action',function() { 
	$('.post_options_action').not(this).each(function() {
		$(this).parent().next('.show_post_options').hide();
	});
	$(this).parent().next('.show_post_options').slideToggle();
	
});