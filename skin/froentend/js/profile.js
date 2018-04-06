
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
					if(suggestion == true)
					{
						window.location.reload();
					}
				}
			}
		});
		return false;
	});
	$(document).on('submit', '.comment_form', function(e) {	
		var url = $(this).attr('action');
		var current = $(this);
		current.find(".alert_msg").html('');
		current.find(".alert_msg").hide();
		if($(this).find('.comment').val() !='') {
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
						current.parent().parent().find('.comments').trigger('click');
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
		
	
	$(document).on('click', '.thumbsup', function(e) {		
		var dataid = $(this).data('id'); 
		var url = $(this).attr('href');
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
					$(".likes_display").html(data.html);
				}
			}
		});
		return false;
	});
	
	$(document).on('click', '.comments', function(e) {		
		var dataid = $(this).data('id'); 
		var url = $(this).attr('href');
		var current = $(this);
		
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
					console.log(current);
					/*if(page > 0)
					{
						current.parent('li').parent('ul').next(".comments_list").append(data.html);
					}
					else{*/
						current.parent('li').parent('ul').next(".comments_list").html(data.html);
					//}
				}
			}
		});
		return false;
	});
	
	$(document).on('click', '.share_social', function(e) {		
		$(this).parent().children('.social_sharing_sections').toggle('slow');
		return false;
	});
	
	$('.profile_section').click(function() {
	
		$('.profile_section').removeClass('active');
		$(this).addClass('active');
		get_profile_section();
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

function get_profile_section()
{
	var url = $('.newsfeed_menu .active').attr('href');
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
					console.log(current);
					if(page > 0)
					{
						current.parent('li').parent('ul').next(".comments_list").append(data.html);
					}
					else{
						current.parent('li').parent('ul').next(".comments_list").html(data.html);
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
		if(current_val == 'video')
		{
			$('.video_section').show();
		}
	});


	
});