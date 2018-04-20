function get_content()
{
	var section = $('.blog_section li a.active').data('section');
	var type = $('.blog_category li a.active').data('type');
	var order_field = $('#order_field').val();
	show_content_loading(); 
	$('.load_more').hide();
	$.ajax({
		url : admin_url + module + "/ajax_pagination/",
		data : $('#common_search').serialize() + "&section="+section + "&type="+type+ "&order_field="+order_field,
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
				$(".append_html").append(data.html);
				if(data.next_set !='')
				{
					$('.load_more').show();
				}
				equalheight();
			}
			
			if (data.status == "error") {
				 // alert('');
			}
		}
	});
}

$(document).ready(function(){
	/*$('.blog_section li a').click(function() {*/
	$(document).on('click', '.blog_section li a', function(e) {		
		$('.blog_section li a').removeClass('active');
		$(this).addClass('active');
		var selection = $(this).data('section');

		$("#search_category option").removeAttr('selected');
		var values = '';
		$("#search_category option").filter(function() {
			if(this.text == selection)
			values = this.value;
			return this.text == selection; 
		}).attr('selected', true);	
		
		
		$('#page_id').val('');
		$('#load_offset').val('');
		$(".append_html").html('');
		$('#search_category').val(values);
		$('#search_category').trigger("chosen:updated");

		get_content();
	});
	$(document).on('click', '.blog_category li a', function(e) {		
		$('.blog_category li a').removeClass('active');
		$(this).addClass('active');
		$('#page_id').val('');
		$('#load_offset').val('');
		$(".append_html").html('');
		get_content();
	});

	$(document).on('change', '#search_category', function(e) {	
		var current = this.options[e.target.selectedIndex].text;
		$('.blog_section li a').removeClass('active');
		$( '.blog_section li a[ data-section=' + current + ']' ).addClass( 'active' );
		$('#page_id').val('');
		$('#load_offset').val('');
		$(".append_html").html('');
		get_content();
	});
	
	$(document).on('change', '#order_field', function(e) {	
		$('#page_id').val('');
		$('#load_offset').val('');
		$(".append_html").html('');
		get_content();
	});
	
	$('.more_posts').click(function() {
		get_content();
	});
});