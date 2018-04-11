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
    });


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
$(document).on('click', '.toggle_feed',function(){
$.ajax({
			type :'POST', 
			url  : SITE_URL+'myprofile/pull_post_log',
			data : {secure_key:secure_key},	
			dataType:"json",
			success:function(data){ 
				console.log(data.status);
				if(data.status=="success")
				{ 
					notify_html='<i class="fa fa-bell-o" aria-hidden="true"></i><span class="badge notification_circle">'+data.count+'</span>'
					//$(".notify").html(notify_html);"#results span:first"
					$( ".notify" ).html(notify_html)
					$('.notify').addClass('active');
				} 
				else 
				{
					$('.notify').removeClass('active');
					$(".notify-count-div").html('');
				}
 
			},
			error: function(jqXHR, textStatus, errorThrown) 
			{
  				console.log(textStatus, errorThrown);
			}
		})
});
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
					$( ".notify" ).html(notify_html)
					$('.notify').addClass('active');
				} 
				else 
				{
					$('.notify').removeClass('active');
					$(".notify-count-div").html('');
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
					$('.alert-warning').find("label").text(data.message);
					$('.alert-warning').show();
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