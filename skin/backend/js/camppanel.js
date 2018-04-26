
/* used to show the delivery amount when delivery charge is enabled in outlet management ends here */
/* below datepicker function is used in discount which can be used if the start and end date depending concept starts here */
$(function () {
	if($('.datepickerchange1').length && $('.datepickerchange2').length) {
		$('.datepickerchange1').datepicker({'format': 'dd-mm-yyyy','startDate':'today'})
		.on('changeDate', function(ev){
			var endDate = new Date($('.datepickerchange2').val());
			if (ev.date.valueOf() > endDate.valueOf()){
				$('#alert').show().find('strong').text('The start date should be lesser than the end date');
			} else {
				$('#alert').hide();

			}
			$('.datepickerchange2').datepicker('hide');
		});
		$('.datepickerchange2').datepicker({'format': 'dd-mm-yyyy','startDate':'today'})
		.on('changeDate', function(ev){
			var startDate = new Date($('.datepickerchange1').val());
			if (ev.date.valueOf() < startDate.valueOf()){
				$('#alert').show().find('strong').text('The end date should be greater than the start date');
			} else {
				$('#alert').hide();
			}
			$('.datepickerchange2').datepicker('hide');
		});
	}
});
/* below datepicker function is used in discount which can be used if the start and end date depending concept ends here */
/* used to show the additional text box for the selection of percentage in discount module starts here */
$(document).ready(function() {
	$('#promotion_type').change(function() {
		if($('#promotion_type').val() == 'percentage')
			$('#promotion_percentage_amount').show();
		else
			$('#promotion_percentage_amount').hide();
	})
});
/* used to show the additional text box for the selection of percentage in discount module ends here */
/* unlink images for active and default icon */
 $(".common_delete_other_image").click(function() {
	 var current=this;
	 var dataid=$(this).attr('data-id');
	  customAlertmsg("Are you sure you want to delete this image?");	
	   $( "#alt1" ).click(function() {  
            $("#"+dataid).val("Yes");
		    $(current).parent('a').parent('div').remove();
	  });
  });
  

/* used to display datetime picker */
$(document).ready(function() {
	
	if($('.datetimepicker').length) {
		$('.datetimepicker').datetimepicker();
	}
	if($('.datepicker').length) 
	{		
		$('.datepicker').datepicker({format: 'dd-mm-yyyy'});
	}
	
	if($('.current_datepicker').length) 
	{
		$('.current_datepicker').datepicker({startDate: new Date()});
	}
	
	
 /*  on  chnage user role show outlet list */
	 /* On change category get related modifiers */
	$("#user_groups").change(function(){
		var role_id = $(this).val();
		
		$.ajax({
			url: admin_url+module +"/add_outlet",
			data : { role_id: role_id, secure_key:secure_key },
			type :'POST', 
			dataType:"json",
			success:function(data){   
				if(data.display=="show"){
					$(".outlet_div").show();
					$("#outlets").addClass('rquired');
					
				}else{
					$(".outlet_div").hide();
					$("#outlets").removeClass('rquired');
				}
				
			}
		});
		
	})
	
	/*if($('.from_time').length) {
	$('.from_time').timepicker({
	showMinutes: false,
	showPeriod: true,
	showLeadingZero: true,
	onSelect: function(hour) {
	var ntime=calctime_timeslot(hour)
	$('.to_time').timepicker('option', { minTime: { hour: ntime,minute:"00"} });
    } 
	});
    }
    
	if($('.to_time').length) {
	$('.to_time').timepicker({
		showMinutes: false,
		showPeriod: true,
		showLeadingZero: true
	});
    }*/
    if($('.from_time').length) {
    $('.from_time').timepicker({
	showMinutes: true,
	showPeriod: true,
	showLeadingZero: true,
	onSelect: function(hour) {
	
	var ttime=hour.split(':');
	var ampm=ttime[1].split(" ");
	if(ampm[1]=="AM")
	{
		if(ttime[0]=='12')
		{
			nt="00";
		}
		else
		{
			nt=ttime[0];
		}
	}
	else if(ampm[1]=="PM")
	{
		var nt=parseInt(ttime[0])+12;
	}
	$('.to_time').timepicker('option', { minTime: { hour: nt,minute:ampm[0]} });
	
	var end_time=$('.to_time').val();
	if(end_time == '')
	{
		$('.to_time').val(hour);
	}
	else
	{
		var from_time=_24hourformat(hour);
		var to_time=_24hourformat(end_time);
		if(from_time > to_time)
		{
			$('.to_time').val(hour);
		}	
	}
        }
	});
    }

	if($('.to_time').length) {
		$('.to_time').timepicker({
				showMinutes: true,
				showPeriod: true,
				showLeadingZero: true
		});
	}

	/*Settings scheduled email campaign*/
	$(".sec_add_more").click(function() {

		var rel_val = $(this).attr('rel');

		var email_arr = [];
		if($('input[name="email_template_json"]').length)
			email_arr = $('input[name="email_template_json"]').val();

		var len = $('input[name="'+rel_val+'_days[]"]').length;
		len = len+ 1;

		$('.'+rel_val+'_append_div').append('<div class="col-md-6 col-sm-6"><input type="text" name="'+rel_val+'_days[]" id="'+rel_val+'_days_'+len+'" class="form-control required"/></div><div class="col-md-6 col-sm-6"><select name="'+rel_val+'_email_template[]" id="'+rel_val+'_email_template_'+len+'" class="form-control required"/></div>');

		var email_arr = jQuery.parseJSON(email_arr);

		$.each(email_arr, function(index, val) {

			$('#'+rel_val+'_email_template_'+len).append(new Option(val,index));

		});
		
		$('#'+rel_val+'_email_template_'+len).chosen();
		$('#'+rel_val+'_email_template_'+len).trigger("chosen:updated");

	});

});

function checkAddress_entry(){
	$.ajax({
		url: admin_url+"outletmanagement/addressBasedPostalcode",
		type: "POST",
		data: {'postalcode' : $('#outlet_postal_code').val(), 'secure_key' : secure_key},
		success: function(data){
			var jsn = JSON.parse(data);
			$('#outlet_address_line1').val(jsn.address);
		}
	});
}
/* unlink images for active and default icon */
 $(".common_delete_other_image").click(function() {
	 var current=this;
	 var dataid=$(this).attr('data-id');
	  customAlertmsg("Are you sure you want to delete this image?");	
	   $( "#alt1" ).click(function() {  
            $("#"+dataid).val("Yes");
		    $(current).parent('a').parent('div').remove();
	  });
  });
  
  $(".switch_pannel").click(function() {
	  
	   
	    customAlertmsg("Are you sure you want to switch businesspanel?");	
        $( "#alt1" ).click(function() { 
		$.ajax({
		url: admin_url+"camppanel/switch_pannel",
		type: "POST",
		data: {'secure_key' : secure_key},
		dataType : "json",
		success: function(data){
			if(data.status == "success")
			{
				 window.location.href = switch_url;
			}
			else if (data.status == "error")
			{
				showerror('alert-warning',data.message);
			}
		}
	    });
	    });
  });
 
  	
	
	/*function calctime_timeslot(hour)
	{
		var ttime=hour.split(' ');
		if(ttime[1]=="AM")
		{
			if(ttime[0]=='12')
			{
				nt="01";
			}
			else
			{
				nt=parseInt(ttime[0])+1;
			}
		}
		else if(ttime[1]=="PM")
		{
			var nt=parseInt(ttime[0])+13;
		}
		return nt;
	}*/
 
 /*
  * this is used to show the custom menu title when we checked the menu navigation enable
  * */
  if($('#menu_navigation').length)
  {
	  $('#menu_navigation').click(function()
	  {
		  if($('#menu_navigation').is(':checked'))
		  {
			  $('.custom_ttile').show();
		  }
		  else
		  {
			  $('.custom_ttile').hide();
		  }
	  });
  }
  
  function selectGroup_options(){
	var id	=	$("input[name=newsletter_sendto]:checked").attr('id');
	if(id == 'group'){
		$( "textarea.newsletter_textarea").removeClass( 'required' );
		$( "input.newsletter_groupType").addClass( 'required' );
	}
	else{
		$( "textarea.newsletter_textarea").addClass( 'required' );
		$( "input.newsletter_groupType").removeClass( 'required' );
	}
	
	$('.filltersection.form-group').hide();
	$('.filltersection.form-group.'+id).show();
	
  }
  /* $(".form_datetime").datetimepicker({format: 'yyyy-mm-dd hh:ii'});
  $(function () {     
        $("#datetimepicker").on("dp.change", function (e) {
            $('#datetimepicker').data("DateTimePicker").minDate(e.date);
        });
        $("#datetimepicker").on("dp.change", function (e) {
            $('#datetimepicker').data("DateTimePicker").maxDate(e.date);
        });
        /*$("#datetimepicker6").change(function(e) {
            $('#datetimepicker7').datetimepicker('setStartDate',(e.date));
        });
        $("#datetimepicker7").change(function(e)  {
           $('#datetimepicker6').datetimepicker('setEndDate',(e.date));
        });
    });*/
    
    
    
      /* $(function () {
        $('#datepickerchange1').datepicker({
			format: 'dd/mm/yyyy',
			autoclose: true,
			useCurrent: true //Important! See issue #14100
			});
   }); */
  
$('body').on('click','.customer_search1',function(){
	$("#customer_bought").removeClass('error-custom');
	$("#customer_bought_dt1").removeClass('error-custom');
	$("#customer_bought_dt2").removeClass('error-custom');	
	var search_name=$("#customer_bought").val();
	var search_name1=$("#customer_bought_dt1").val();
	var search_name2=$("#customer_bought_dt2").val();
	if(search_name== '')
	{
	$("#customer_bought").addClass('error-custom');	
	}
	if(search_name1== '')
	{
	$("#customer_bought_dt1").addClass('error-custom');	
	}
	if(search_name2== '')
	{
	$("#customer_bought_dt2").addClass('error-custom');	
	}
	if(search_name!= '' && search_name1!= '' && search_name2!= '')	
	{
		get_content('');  
	}
	
});
$('body').on('click','.customer_search2',function(){
	$("#customer_spent_from").removeClass('error-custom');
	$("#customer_spent_to").removeClass('error-custom');
	$("#customer_spent_dt1").removeClass('error-custom');	
	$("#customer_spent_dt2").removeClass('error-custom');
	var search_name3=$("#customer_spent_from").val();
	var search_name4=$("#customer_spent_to").val();
	var search_name5=$("#customer_spent_dt1").val();
	var search_name6=$("#customer_spent_dt2").val();
	if(search_name3== '')
	{
	$("#customer_spent_from").addClass('error-custom');	
	}
	if(search_name4== '')
	{
	$("#customer_spent_to").addClass('error-custom');	
	}
	if(search_name5== '')
	{
	$("#customer_spent_dt1").addClass('error-custom');	
	}
	if(search_name6== '')
	{
	$("#customer_spent_dt2").addClass('error-custom');	
	}
	if(search_name3!= '' && search_name4!= '' && search_name5!= ''  && search_name6!= '')	
	{
		get_content('');  
	}
	
});
/*
$('body').on('click','.total_active_customer',function(){
    showerror('alert-success','Active customers filtered successfully');		
	$(".total_active_customer").addClass('custom_loading');			
	$("#customer_bought").val('');
	$("#customer_bought_dt1").val('');
	$("#customer_bought_dt2").val('');
	$("#customer_spent_from").val('');
	$("#customer_spent_to").val('');
	$("#customer_spent_dt1").val('');
	$("#customer_spent_dt2").val('');
	
	var search_name7=$('input[name="total_active"]').val('1');
	if(search_name7!= '')	
	{
		get_content(''); 
		$('input[name="total_active"]').val(''); 
		
			setTimeout(function()
		{
			$(".total_active_customer").removeClass('custom_loading');		
		}, 150);
		
	
	}
	
}); 
$('body').on('click','.total_lastactive',function(){
	showerror('alert-success','Inactive last 60 days customers filtered successfully');
	$(".total_lastactive").addClass('custom_loading');	
	$("#customer_bought").val('');
	$("#customer_bought_dt1").val('');
	$("#customer_bought_dt2").val('');
	$("#customer_spent_from").val('');
	$("#customer_spent_to").val('');
	$("#customer_spent_dt1").val('');
	$("#customer_spent_dt2").val('');
	
	var search_name7=$('input[name="total_lastactive"]').val('1');
	if(search_name7!= '')	
	{
		get_content(''); 
		$('input[name="total_lastactive"]').val(''); 
			setTimeout(function()
		{
			$(".total_lastactive").removeClass('custom_loading');	
		}, 150);
	}

});    */
$('body').on('click','.search_items',function(){
	  get_content('');
}); 
$('body').on('click','.import_custom',function(){
   $(".mfp-content").removeClass('custom_append');	
   $(".mfp-content").addClass('custom_append');
   
}); 
$('body').on('click','.search_items',function(){
	   $(".item_bought_form_outer").addClass('custom_loading');
	   $.ajax({
            url: admin_url + module + "/bought_items" ,
            type: "POST",
            data: $("#bought_items_form").serialize(),
			cache : false,		
			dataType: "json",	
			success : function(data) {
				//alert(data);
				if(data.status == 'ok'){
					$(".item_bought_form_outer").removeClass('custom_loading');
					//$(".item_bought_form_outer").remove();
					//alert(data.html);
					(data.html!='')?$(".item_bought_form_outer").html(data.html):$(".item_bought_form_outer").html('');
					(data.total!='')?$(".item_total_price").html(data.total):$(".item_total_price").html('');
				}
				else
				{
					//alert(data.html);
				}
			}
		});
});
