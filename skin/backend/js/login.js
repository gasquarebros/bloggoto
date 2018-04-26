/* this files used login related functions... */

$(document).ready(function() {

	var  loading_icon = "";
/* Common login */
/*	$("#login_form").validate(
	{
		ignore : "",
		submitHandler : function() {
			$(".log_alert").removeClass('alert-danger');
			$("#log_submit").hide();
			$("#login-progress").show();
			$.ajax({
				url: ADMIN_URL+"index",
				data : $('#login_form').serialize(),
				type :'POST', 
				dataType:"json",
				success:function(data){
					$("#log_submit").show();
					$("#login-progress").hide();
					
					if(data.status=="success"){
						
	
						 window.location.href = ADMIN_URL+"dashboard/";

						
					  }else if(data.status=="error"){
						  $(".log_alert").addClass("alert-danger");
							$(".log_alert").show().html(data.message);
							
					  }
				}
			});
		}
	}); */
	
	/* forgot password display */
	$('#forgot_password').click(function() {
		$('#login_frm').hide();
		$('#forgot_frm').show();
	});
	/* login form display when clicking back button */
	$('#back_forgot').click(function() {
		$('#login_frm').show();
		$('#forgot_frm').hide();
	});
	
	
	$("#forgot_form").validate(
	{
		ignore : "",
		submitHandler : function() {
			$(".log_alert").hide();
			$(".log_alert").removeClass('alert-danger');
			$("#forgot_submit").hide();
			$("#forgot-progress").show();
			$.ajax({
				url: LOGIN_URL,
				data : $('#forgot_form').serialize(),
				type :'POST', 
				dataType:"json",
				success:function(data){
					$("#forgot_submit").show();
					$("#forgot-progress").hide();
					if(data.status=="success"){
						window.location.href = LOGIN_URL;	
					}else if(data.status=="error"){
						$(".log_alert").addClass("alert-danger");
						$(".log_alert").show().html(data.message);	
					}
				}
			});
		}
	});
	/* reset form validation and proceed submit */
	$("#reset_form").validate(
	{
		ignore : "",
		submitHandler : function() {
			$(".log_alert").hide();
			$(".log_alert").removeClass('alert-danger');
			$.ajax({
				url: ADMIN_URL+"reset_password",
				data : $('#reset_form').serialize(),
				type :'POST', 
				dataType:"json",
				success:function(data){
					if(data.status=="success"){
						window.location.href = LOGIN_URL;	
					}else if(data.status=="error"){
						$(".log_alert").addClass("alert-danger");
						$(".log_alert").show().html(data.message);	
					}
				}
			});
		}
	});
	
    /* Camppanel login */
	$("#camp_login_form").validate(
	{
		ignore : "",
		submitHandler : function() {
			$(".log_alert").hide();
			$(".log_alert").removeClass('alert-danger');
			$("#log_submit").hide();
			$("#login-progress").show();
			$.ajax({
				url: LOGIN_URL,
				data : $('#camp_login_form').serialize(),
				type :'POST', 
				dataType:"json",
				success:function(data){
					$("#log_submit").show();
					$("#login-progress").hide();
					if(data.status=="success"){
			
						if(typeof(data.redirect_url) !="undefined" &&  data.redirect_url != "")
							{
							  window.location.href = ADMIN_URL+data.redirect_url;
							 return false;
							}
						
						 window.location.href = ADMIN_URL+"dashboard";
						
					}else if(data.status=="error"){
						$(".log_alert").addClass("alert-danger");
						$(".log_alert").show().html(data.message);	
					}
				}
			});
		}
	});
	

}); /* end of document ready*/




