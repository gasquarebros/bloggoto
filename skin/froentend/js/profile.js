$(document).ready(function(){
	$(document).on('click', '.follow_users', function(e) {		
		var url = $(this).attr('href');
		var suggestion = $(this).hasClass('follow_users_suggestions');
		show_content_loading(); 
		$.ajax({
			url : url,
			data : "secure_key="+secure_key+"&action=follow",
			type : 'POST',
			dataType : "json",
			async:false,
			success : function(data) {
				hide_content_loading();
				if (data.status == "success") {
					/* reload page if delete the pagination record is empty... */
					if(data.page_reload == "Yes")
					{
						window.location.href= admin_url;
						return false;
					}
					$(".follow_count").html(data.html);
					$(".follow_users").html(data.msg);
					window.location.reload();
					if(suggestion == true)
					{
						window.location.reload();
					}
				}
			}
		});
		return false;
	});
	$(document).on('click', '.follow_popup', function(e) {		
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
					$('#follow_modal_div').html(data.html);
					$('#follow_modal_div').trigger('click');
					// $('#follow_modal_div'+data_target).trigger('click');
				}
			}
		});
		return false;
	});	
	$(document).on('click', '.unfollow_users', function(e) {		
		var url = $(this).attr('href');
		var dataid = $(this).parent().parent().attr('id');
		show_content_loading(); 
		$.ajax({
			url : url,
			data : "secure_key="+secure_key+"&action=follow",
			type : 'POST',
			dataType : "json",
			async:false,
			success : function(data) {
				hide_content_loading();
				if (data.status == "success") {
					/* reload page if delete the pagination record is empty... */
					if(data.page_reload == "Yes")
					{
						window.location.href= admin_url;
						return false;
					}
					$(".follow_count").html(data.html);
					$(".follow_users").html(data.msg);
					$("#"+dataid).remove();
					window.location.reload();
				}
			}
		});
		return false;
	});	
	
	$(document).on('click','.comment_submit',function() {
			$(this).parent().parent().submit();
			return false;
	});
	$(document).on('submit', '.comment_form', function(e) {	
		
		var userid = $('#userid').val();
		if(userid == '')
		{
			window.location.href= admin_url;
			return false;
		}
		var url = $(this).attr('action');
		var current = $(this);
		current.find(".alert_msg").html('');
		current.find(".alert_msg").hide();
		$(this).find('.comment_section').val($(this).find('.comment').html());
		if($(this).find('.comment_section').val() !='') {
			show_content_loading(); 
			$.ajax({
				url : url,
				data : $(this).serialize(),
				type : 'POST',
				dataType : "json",
				async:false,
				success : function(data) {
					
					hide_content_loading();
					if (data.status == "success") {
						/* reload page if delete the pagination record is empty... */
						if(data.page_reload == "Yes")
						{
							window.location.href= admin_url;
							return false;
						}
						current.find('.comment').val('');
						current.parent().parent().find(".comments_display").html(data.html);
						current.parent().parent().find('.comments_list').hide();
						current.parent().parent().find('.comments').trigger('click');
						current.find('.comment').html('');
					}
					else
					{
						current.find(".alert_msg").show();
						current.find(".alert_msg").html(data.message);
					}
				}
			});
		}
		return false;
	});
		
	$(document).off('click', '.thumbsup').on('click', '.thumbsup',function(e) {
		var userid = $('#userid').val();
		if(userid == '')
		{
			window.location.href= admin_url;
			return false;
		}		
		var dataid = $(this).data('id'); 
		var url = $(this).attr('href');
		var current = $(this);
		show_content_loading(); 
		$.ajax({
			url : url,
			data : "secure_key="+secure_key+"&action=likes&dataid="+dataid,
			type : 'POST',
			dataType : "json",
			async:false,
			success : function(data) {
				hide_content_loading();
				if (data.status == "success") {
					/* reload page if delete the pagination record is empty... */
					if(data.page_reload == "Yes")
					{
						window.location.href= admin_url;
						return false;
					}
					if(current.hasClass('active'))
					{
						current.removeClass('active');
					}
					else
					{
						current.addClass('active');
					}
					current.parent().children().find(".likes_display").html(data.html);
				}
			}
		});
		return false;
	});
	
	$(document).off('click', '.comments').on('click', '.comments',function(e) {	
		var dataid = $(this).data('id'); 
		var url = $(this).attr('href');
		var current = $(this);
		if(current.parent('li').parent('ul').next(".comments_list").is(":visible") == true)
		{
			current.parent('li').parent('ul').next(".comments_list").hide();
		}
		else {
			var page = current.parent().parent().parent().find('.comment_page').val();
			current.parent().parent().parent().find('.comment_page').remove();
			show_content_loading(); 
			$.ajax({
				url : url,
				data : "secure_key="+secure_key+"&action=comments&dataid="+dataid+"&offset=0",
				type : 'POST',
				dataType : "json",
				async:false,
				success : function(data) {
					
					hide_content_loading();
					if (data.status == "success") {
						/* reload page if delete the pagination record is empty... */
						if(data.page_reload == "Yes")
						{
							window.location.href= admin_url;
							return false;
						}
						
						/*if(page > 0)
						{
							current.parent('li').parent('ul').next(".comments_list").append(data.html);
						}
						else{*/
							current.parent('li').parent('ul').next(".comments_list").show();
							current.parent('li').parent('ul').next(".comments_list").html(data.html);
						//}
						
						$(".body").each(function() {
							var myObj = JSON.parse($(this).html());
							$(this).html(myObj);
						});
					}
				}
			});
		}
		return false;
	});
	
	$(document).off('click', '.share_social').on('click', '.share_social',function(e) {	
		$(this).parent().children('.social_sharing_sections').toggle('slow');
		return false;
	});
	
	$('.profile_section').click(function() {
		$('.profile_section').removeClass('active');
		var current_section = $(this).attr('data-section');
		$(this).addClass('active');
		if(current_section == 'products' || current_section == 'services' )
		{
			$('.boi_data').addClass('deals_part flash_sale_deals grid-view');
		} else {
			$('.boi_data').removeClass('deals_part flash_sale_deals grid-view');
		}
		get_profile_section();
		if($('.my-grid').length) {
			/*waterfall('.my-grid');*/
		}
		return false;
	});

	$(document).off('click', '.comment_delete').on('click', '.comment_delete',function(e) {		
		var current=$(this);
		var url = $(this).attr('href');
		var id = $(this).attr('data-cmtid');
		var dataid = $(this).attr('data-id');
			customAlertmsg("Are you sure you want to delete permanently? Yes, No");	
	   $( "#alt1" ).click(function() {		
		show_content_loading(); 
		$.ajax({
			url : url,
			data : "secure_key="+secure_key+"&dataid="+dataid+"&action=Delete",
			type : 'POST',
			dataType : "json",
			async:false,
			success : function(data) {
				hide_content_loading();
				if (data.status == "success") 
				{
					current.parent().parent().parent().find(".comments_display").html(data.html);
					current.parent().parent().find('#'+id).remove();
				}
			}
		});
		});
		return false;
	});	
	
	$(document).off('click', '.comment_edit').on('click', '.comment_edit',function(e) {	
		var current=$(this);
		var url = $(this).attr('href');
		var id = $(this).attr('data-cmtid');
		var dataid = $(this).attr('data-id');
		$('#'+id).find('.before_edit_content').children('.recent').hide();
		$('#'+id).find('.comment_content').show();
		var msg=$('#'+id).find('.before_edit_content').children('.recent').html();
		$('#'+id).find('#comment_data').val(msg);
		return false;
	});
	
	$(document).off('click', '.comment_cancel').on('click', '.comment_cancel',function(e) {
		$('.recent').show();
		$('.comment_content').hide();
		return false;
	});		 
	$(document).off('submit', '.upcomment_form').on('submit', '.upcomment_form',function(e) {
		var userid = $('#userid').val();
		if(userid == '')
		{
			window.location.href= admin_url;
			return false;
		}
		var url = $(this).attr('action');
		var current = $(this);
		current.find(".alert_msg").html('');
		current.find(".alert_msg").hide();
		var dataid=$(this).find('#cmt_record').val();
		
		$(this).find('.comment_edit_section').val($(this).find('.comment').html());
		if($(this).find('.comment_edit_section').val() !='')
		{
			show_content_loading(); 
			$.ajax({
				url : url,
				data : current.serialize(),
				type : 'POST',
				dataType : "json",
				async:false,
				success : function(data) {
					hide_content_loading();
					if (data.status == "success") 
					{
						if(data.page_reload == "Yes")
						{
							window.location.href= admin_url;
							return false;
						}
						current.find('.upcomment').val('');
						$('#'+dataid).parent().parent().find('.comments').trigger('click');
						current.parent().parent().parent().find(".comments").trigger('click');
					}
					else
					{
						current.find(".alert_msg").show();
						current.find(".alert_msg").html(data.message);
					}				
				}
			});
		}
		return false;
	});
});

function get_state() {
	var country = $('#customer_country').val();
	var url = SITE_URL+'myprofile/getstates';
	if(country !='')
	{
		$.ajax({
			url : url,
			data : "secure_key="+secure_key+"&country="+country,
			type : 'POST',
			dataType : "json",
			async:false,
			success : function(data) {
				$('.state_field').html(data.message);
				trigger_chosen();
			}
		});
	}
	return false;
}
function get_city() {
	var state = $('#customer_state').val();
	var url = SITE_URL+'myprofile/getcities';
	if(state !='')
	{
		$.ajax({
			url : url,
			data : "secure_key="+secure_key+"&state="+state,
			type : 'POST',
			dataType : "json",
			async:false,
			success : function(data) {
				$('.city_field').html(data.message);
				trigger_chosen();
			}
		});
	}
	return false;
}

function get_profile_section(urlsection='')
{
	if(urlsection !='')
	{
		var url = admin_url + module + "/"+urlsection+"/";
	}
	else {
		var url = $('.newsfeed_menu .active').attr('href');
	}
	var section = $('.newsfeed_menu .active').attr('data-section');
	show_content_loading(); 
	$.ajax({
		url : url,
		data : "secure_key="+secure_key+"&section="+section+"&show=Yes",
		type : 'POST',
		dataType : "json",
		async:false,
		success : function(data) {
			hide_content_loading();
			if (data.status == "success") {
				/* reload page if delete the pagination record is empty... */
				if(data.page_reload == "Yes")
				{
					window.location.href= admin_url + 'myprofile';
					return false;
				}
				$(".boi_data").html(data.html);
				trigger_chosen();
				triger_ajax_popup();
				trigger_modal_popup();
			}
		}
	});
	return false;
}
function get_favor_section(urlsection='')
{
	if(urlsection !='')
	{
		var url = admin_url + module + "/"+urlsection+"/";
	}
	else {
		var url = $('.newsfeed_menu .active').attr('href');
	}
	var section = $('.newsfeed_menu .active').attr('data-section');
	show_content_loading(); 
	$.ajax({
		url : url,
		data : "secure_key="+secure_key+"&section="+section+"&show=Yes",
		type : 'POST',
		dataType : "json",
		async:false,
		success : function(data) {
			hide_content_loading();
			if (data.status == "success") {
				/* reload page if delete the pagination record is empty... */
				if(data.page_reload == "Yes")
				{
					window.location.href= admin_url + 'myprofile';
					return false;
				}
				$(".append_html").html(data.html);
				trigger_chosen();
				triger_ajax_popup();
				trigger_modal_popup();
			}
		}
	});
	return false;
}
function get_content()
{
	var section = $('.newsfeed_menu .active').attr('data-section');
	var url = $('#common_search').attr('action');
	var order_field = $('#order_field').val();
	show_content_loading(); 
	$('.load_more').remove();
	$.ajax({
		url : url,
		data : $('#common_search').serialize() + "&section="+section+ "&order_field="+order_field,
		type : 'POST',
		dataType : "json",
		async:false,
		success : function(data) {
			hide_content_loading();
			if (data.status == "success") {
				$("#page_id").val(data.offset);
				$("#load_offset").val(data.next_set);
				/* reload page if delete the pagination record is empty... */
				if(data.page_reload == "Yes")
				{
					window.location.href= admin_url + module;
					return false;
				}
				$(".append_html").append(data.html);
				if(data.next_set !='')
				{
					$('.load_more').show();
				}
				trigger_chosen();
				triger_ajax_popup();
				trigger_modal_popup();
			}
			
			if (data.status == "error") {
				 // alert('');
			}
		}
	});
}
$(document).ready(function(){
	$(document).on('change', '#search_category', function(e) {	
		$('#page_id').val('');
		$('#load_offset').val('');
		$(".append_html").html('');
		get_content();
	});
	
	$(document).on('click', '.more_posts', function(e) {	
		get_content();
	});
	
	$(document).on('click', '.more_posts_comments', function(e) {
		
		//$(this).parent().parent().parent().parent().parent().find('.comments').trigger('click');

		var dataid = $(this).parent().parent().parent().parent().parent().find('.comments').data('id'); 
		var url = $(this).parent().parent().parent().parent().parent().find('.comments').attr('href');
		var current = $(this).parent().parent().parent().parent().parent().find('.comments');
		
		var page = current.parent().parent().parent().find('.comment_page').val();
		current.parent().parent().parent().find('.comment_page').remove();
		show_content_loading(); 
		$(this).parent().remove();
		$('.recent').removeClass('recent');
		$.ajax({
			url : url,
			data : "secure_key="+secure_key+"&action=comments&dataid="+dataid+"&offset="+page,
			type : 'POST',
			dataType : "json",
			async:false,
			success : function(data) {
				hide_content_loading();
				if (data.status == "success") {
					/* reload page if delete the pagination record is empty... */
					if(data.page_reload == "Yes")
					{
						window.location.href= admin_url;
						return false;
					}
					

					if(page > 0)
					{
						//current.parent('li').parent('ul').next(".comments_list").append(data.html);
						current.parent('li').parent('ul').next(".comments_list").prepend(data.html);
					}
					else{
						current.parent('li').parent('ul').next(".comments_list").show();
						current.parent('li').parent('ul').next(".comments_list").html(data.html);
					}
					$(".recent").each(function() {
						var myObj = JSON.parse($(this).html());
						$(this).html(myObj);
					});
				}
			}
		});
		return false;
		
		
	});
	$(document).on('click', '.favor', function(e) {
		var userid = $('#userid').val();
		if(userid == '')
		{
			window.location.href= admin_url;
			return false;
		}		
		var dataid = $(this).data('id'); 
		var url = $(this).attr('href');
		var current = $(this);
		show_content_loading(); 
		$.ajax({
			url : url,
			data : "secure_key="+secure_key+"&action=favor&dataid="+dataid,
			type : 'POST',
			dataType : "json",
			async:false,
			success : function(data) {
				hide_content_loading();
				if (data.status == "success") {
					/* reload page if delete the pagination record is empty... */
					if(data.page_reload == "Yes")
					{
						window.location.href= admin_url;
						return false;
					}
					if(current.hasClass('active'))
					{
						current.removeClass('active');
					}
					else
					{
						current.addClass('active');
					}
				}
			}
		});
		return false;
	});
	
	$(document).on('change', '#order_field', function(e) {	
		$('#page_id').val('');
		$('#load_offset').val('');
		$(".append_html").html('');
		get_content();
	});
	
	$('.post_category_selection li a').click(function(){
	
		$('.post_category_selection li a').removeClass('active');
		$(this).addClass('active');
		var current_val = $(this).data('section');
		$('#post_category').val(current_val);
	});
	$('.post_type_selection li a').click(function(){
		var current_val = $(this).data('type');
		$('.post_type_selection li a').removeClass('active');
		$(this).addClass('active');
		$('#post_type').val(current_val);
		$('.video_section').hide();
		$('.pdf_section').hide();

		if(current_val == 'video')
		{
			$('.video_section').show();
		}
		else if(current_val == 'blog' || current_val == 'book' || current_val == 'story' )
		{
			$('.pdf_section').show();
		}		
	});
	
	$(document).on('click','.edit_profile',function () {
		$('.profile_edit_form').show();
		$('.profile_display_section').hide();
		$('.profile_edit_form select').chosen('destroy');  
		$('.profile_edit_form select').chosen();  
	});
	
	$(document).on('click','.cancel_edit_profile',function () {
		$('.profile_edit_form').hide();
		$('.profile_display_section').show();
		return false;
	});
	
	$(document).on('click','.suggestion_close',function () {
		$(this).parent().parent().parent().remove();
		if($('.follow_request').children('ul').children('li').length < 1)
		{
			$('.follow_request').remove();
		}
		return false;
	});

		
	var start=/@/ig;
	var word=/@(\w+)/ig;

	$(document).on("keyup",'.comment',function() 
	{
		var current = $(this);
		var content=$(this).text();
		var go= content.match(start);
		var name= content.match(word);
		var dataString = 'searchword='+name+"&secure_key="+secure_key;
		if(go.length>0)
		{
			$("#msgbox").slideDown('show');
			$("#display").slideUp('show');
			$("#msgbox").html("Type the name of someone or something...");
			if(name.length>0)
			{
				var url = admin_url + "home/gettagnames";
				$.ajax({
					type: "POST",
					url: url,
					data: dataString,
					cache: false,
					success: function(html)
					{
						current.parent().next(".msgbox").hide();
						current.parent().next(".display").html(html).show();
					}
				});

			}
		}
		return false;
	});
	
	$(document).on("click",'.addname',function() 
	{
		var username=$(this).attr('title');
		var taglink=$(this).attr('data-link');
		var old= $(this).parent().parent().find('.comment').html();
		var content=old.replace(word,""); 
		$(this).parent().parent().find('.comment').html(content);
		var E="<a class='red' target='_blank' contenteditable='false' href='"+taglink+"' >"+username+"</a>";
		$(this).parent().parent().find('.comment').append(E);
		$(this).parent().parent().find(".display").hide();
		$(this).parent().parent().find(".msgbox").hide();
		$(this).parent().parent().find(".comment").focus();
	});


	$('body').on('click','.lazy_load_flashsale',function(e) {
		e.stopPropagation();		  
		var page = $(this).data('nextpage');
		show_content_loading(); 
		$('.load_more').hide();
		var url = $('.product_section').attr('href');
		$.ajax({
			url : url,
			data : $('#common_search').serialize() + "&page="+page+"&secure_key="+secure_key,
			type : 'POST',
			dataType : "json",
			async:false,
			success : function(data) {
				hide_content_loading();
				if (data.status == "success") {
					$('.more_details_par').remove();
					$(".boi_data").append(data.html);
				}
			}
		});
	});

	$('body').on('click','.lazy_load_flashsale_services',function(e) {
		e.stopPropagation();		  
		var page = $(this).data('nextpage');
		show_content_loading(); 
		$('.load_more').hide();
		var url = $('.service_section').attr('href');
		$.ajax({
			url : url,
			data : $('#common_search').serialize() + "&page="+page+"&secure_key="+secure_key,
			type : 'POST',
			dataType : "json",
			async:false,
			success : function(data) {
				hide_content_loading();
				if (data.status == "success") {
					$('.more_details_par').remove();
					$(".boi_data").append(data.html);
				}
			}
		});
	});
	
});