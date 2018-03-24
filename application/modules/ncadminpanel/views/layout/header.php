 <title><?php  echo get_label('admin_title'); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Fonts -->
    <link href='<?php echo  load_font('google_lato.css')?>' rel='stylesheet' type='text/css'>
    <link href='<?php echo  load_font('google_roboto_condensed.css')?>' rel='stylesheet' type='text/css'>
    <!-- CSS Libs -->
   <link rel="stylesheet" type="text/css" href="<?php echo load_lib();?>bootstrap/css/bootstrap.min.css">
   <link rel="stylesheet" type="text/css" href="<?php echo load_lib();?>bootstrap/css/bootstrap-switch.min.css">
  
    <link rel="stylesheet" type="text/css" href="<?php echo load_lib();?>font-awesome/font-awesome.min.css">
       
    <link rel="stylesheet" type="text/css" href="<?php echo load_lib();?>theme/css/animate.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo load_lib();?>theme/css/checkbox3.min.css">
     <link rel="stylesheet" type="text/css" href="<?php echo load_lib();?>chosen/css/chosen.min.css">
 <link rel="stylesheet" type="text/css" href="<?php echo load_lib();?>chosen/css/chosen.min.css">
    <!--<link rel="stylesheet" type="text/css" href="<?php echo load_lib()?>color-box/css/colorbox.css">-->
  
    
    <!-- CSS App -->
    <link rel="stylesheet" type="text/css" href="<?php echo load_lib();?>theme/css/style.css">
    <link rel="stylesheet" type="text/css" href="<?php echo load_lib();?>theme/css/flat-blue.css">
     
         <link rel="stylesheet" type="text/css" href="<?php echo load_lib()?>magnific-popup/css/magnific-popup.css">
       <link rel="stylesheet" type="text/css" href="<?php echo load_lib()?>theme/css/custom.css">   
   
   <!--  load js  -->
   
    <script type="text/javascript" src="<?php echo load_lib()?>jquery/jquery-2.2.2.min.js"></script>
    <script type="text/javascript" src="<?php echo load_lib()?>jquery/jquery.form.min.js"></script>
    <script type="text/javascript" src="<?php echo load_lib()?>jquery/jquery.validate.min.js"></script>
   <script type="text/javascript" src="<?php echo load_lib()?>magnific-popup/js/jquery.magnific-popup.min.js"></script>
    <!--<script type="text/javascript" src="<?php echo load_lib()?>color-box/js/jquery.colorbox-min.js"></script>-->
    
    <script type="text/javascript" src="<?php echo load_lib()?>canvasjs.min.js"></script>
 
<?php /* common javascript varibles ...*/ ?>
<script>
 var admin_url ="<?php echo admin_url(); ?>";
 var lod_lib = "<?php echo load_lib(); ?>";
 var module ="<?php echo $module; ?>";
 var module_label = "<?php echo $module_label; ?>";
 var module_labels = "<?php echo $module_labels; ?>";
 var module_action  = "<?php echo (isset($module_action)? $module_action : '' );?>";
 var custom_redirect_url  = "<?php echo (isset($custom_redirect_url)? $custom_redirect_url : '' );?>";  
 var secure_key = "<?php echo $this->security->get_csrf_hash(); ?>";
</script>
</script>

<script type="text/javascript">

 <?php /* Change  status */ ?>  
$(document).ready(function(){

$('body').on('click', '.status,.delete_record', function() { 
var id = this.id;
var action = $(this).attr('data');

  if ( (typeof (id) != 'undefined') && (typeof (action) != 'undefined') )
  {
	   customAlertmsg("Are you sure you want to " + action + " this "+ module_label + "?");	
	   
	   $( "#alt1" ).click(function() { 
		   
		   $("#actionid").val(action);
		   $("#changeId").val(id);  
		   action_submit( {id:id, action: action });	
		   
	      });

	      return false;
  }
 
});

<?php /* check and uncheck all rdio buttons  */ ?>
		$('body').on('click', '.multicheck_top, .multicheck_bottom', function() {     
	 		if($(this).is(':checked')==true)
	  		{  
	    		  $('.multi_check,.multicheck_top, .multicheck_bottom').attr("checked", "checked");
	    		   $('.multi_check,.multicheck_top, .multicheck_bottom').prop('checked', true);
	  		}
	 		else
	  		{       
	    		$(".multi_check,.multicheck_top, .multicheck_bottom").removeAttr("checked");  
	    		 $('.multi_check,.multicheck_top, .multicheck_bottom').prop('checked', false);
	   		}     
	  	});

<?php /*  if check all checkbox selct parent check box */  ?>
	$('body').on('click', '.multi_check', function() { 
	var multichecklength = $('.multi_check').length;
	var multiunchecklength = $('.multi_check:checked').length; 
		if(multichecklength == multiunchecklength)
	{
		 $(".multicheck_top, .multicheck_bottom").attr('checked','checked');
		  $('.multicheck_top, .multicheck_bottom').prop('checked', true);
	}
	else
	{
		$(".multicheck_top, .multicheck_bottom").removeAttr('checked');
		  $('.multicheck_top, .multicheck_bottom').prop('checked', false);
	}
});
	<?php /*   sort by options   */  ?>
	$('body').on('click', '.sort_asc', function() { 
       $(this).find('.sort_icon').removeClass('fa fa-sort fa fa-sort-alpha-asc').addClass('fa fa-sort-alpha-desc');
       $(this).removeClass('sort_asc').addClass('sort_desc');
       $(this).attr('title',"<?php echo get_label('order_by_desc'); ?>");
        var sort_field = $(this).attr('data');
        var obj = { sort_field : sort_field, sort_value : "ASC" }; 
  		get_content( obj );
	});	

	$('body').on('click', '.sort_desc', function() {  
		   $(this).find('.sort_icon').removeClass('fa fa-sort-alpha-desc').addClass('fa fa-sort-alpha-asc');
	       $(this).removeClass('sort_desc').addClass('sort_asc');
	       $(this).attr('title',"<?php echo get_label('order_by_asc'); ?>");
	       var sort_field = $(this).attr('data');
	       var obj = { sort_field : sort_field, sort_value : "DESC" }; 
	  		get_content( obj );
		});	
	
<?php /* Submit action form   */ ?>
function action_submit(str)
{
	id = str.id;
	show_content_loading();
  $.ajax({
        url: admin_url+module+"/action",
        data :  $('#mainform').serialize(),
        type :'POST', 
        dataType:"json",
        success:function(data){
        hide_content_loading();
	        
        	if(data.status=="success") { 

	        	 if(data.action=="Activate") {

                      if(data.multiaction == "Yes")
                       {
                    	  $('input[type=checkbox]').each(function () {
		                      if(this.checked)
		                 		 {  
		                             $(this).parents('tr').find('.status').removeClass('fa-lock').addClass('fa-unlock');
		                             $(this).parents('tr').find('.status').attr('title', 'Active');
		                             $(this).parents('tr').find('.status').attr('data', 'Deactivate');
		                 		 }
                    	  });

                       }
                      else
                       {
                    	  $('#'+ id ).removeClass('fa-lock').addClass('fa-unlock');
 		        		     $('#'+ id  ).attr('title', 'Active');
 		        		     $( '#'+ id ).attr('data', 'Deactivate');
                       }
		        	    	        		 
	        		 }
					 
	
	         	if(data.action=="Deactivate") 
	         	{ 
			         		if(data.multiaction == "Yes")
		                    {

			         			$('input[type=checkbox]').each(function () {
				                      if(this.checked)
				                 		 {  
				                             $(this).parents('tr').find('.status').removeClass('fa-unlock').addClass('fa-lock');
				                             $(this).parents('tr').find('.status').attr('title', 'Inactive');
				                             $(this).parents('tr').find('.status').attr('data', 'Activate');
				                 		 }
		                    	  });
		                    	  
		                    }
			         		else
				         	{
			         			$('#'+ id ).removeClass('fa-unlock').addClass('fa-lock');
				         		$('#'+ id  ).attr('title', 'Inactive');
				         		$('#'+ id  ).attr('data', 'Activate');
			         		}
		         		
	            	}

	         	if(data.action=="Deactivate") 
	         	{
	         		 
	         		if(data.multiaction == "Yes")
                    {

	         			$('input[type=checkbox]').each(function () {
		                      if(this.checked)
		                 		 {  
		                             $(this).parents('tr').find('.status').removeClass('fa-unlock').addClass('fa-lock');
		                             $(this).parents('tr').find('.status').attr('title', 'Inactive');
		                             $(this).parents('tr').find('.status').attr('data', 'Activate');
		                 		 }
                    	  });
                    	  
                    }
	         		else
		         	{
	         			$('#'+ id ).removeClass('fa-unlock').addClass('fa-lock');
		         		$('#'+ id  ).attr('title', 'Inactive');
		         		$('#'+ id  ).attr('data', 'Activate');
	         		}
         		
            	}
	        	
	        	if(data.action=="Delete") { 
                    var page_id = $("#page_id").val();
	         		get_content({ page : page_id });
	         	
            	 }

	        	 $(".multi_check, .multicheck_top, .multicheck_bottom").removeAttr("checked");  
	    		 $('.multi_check, .multicheck_top, .multicheck_bottom').prop('checked', false);
	    		 $("#multiaction").val('');
	    		 $("#actionid").val();
	    		 $("#changeId").val('');

	    		 if(data.delete_warnig=="Yes") {
	    			  showerror('alert-warning',data.msg);
 
	    		 }else {
	    		  showerror('alert-success',data.msg);
	    		 }
        	}

        	 <?php /* show warning messages  */?>
             if(data.status=="warning") { 
  	             showerror('alert-warning',data.msg);
             }	 

             <?php /* show error  messages  */?>
             if(data.status=="error") { 
  	             showerror('alert-warning',data.msg);
             }	
        }
    });
}

<?php /*  multiselct action */ ?>
$('body').on('click', '.multi_action', function() { 

	 var this_action  = $(this).attr('data');  
	if($(".multi_check:checked").length < 1)
    {
		showInfo("<?php echo $this->lang->line("alert_multibleaction");?>");
    	$("#multiselect").val('');
    	return false;
 	} 
	if ( typeof (this_action) != 'undefined' )
	  {

	 <?php /*   Activate action  */?>
		if(this_action=="Activate")
		{    
			 customAlertmsg("<?php echo sprintf($this->lang->line('confirm_activate'), ucfirst($module_labels)); ?>");
			 	
			 $( "#alt1" ).click(function() { 
	   			$("#actionid").val("Activate");
	   			$("#multiaction").val("Yes");
	   			action_submit('');

			 }); 

			 $( "#alt0" ).click(function() { 
					$("#multiaction").val('');
			 });
		}
		
		if(this_action=="Draft")
		{    
			 customAlertmsg("<?php echo sprintf($this->lang->line('confirm_draft'), ucfirst($module_labels)); ?>");
			 	
			 $( "#alt1" ).click(function() { 
	   			$("#actionid").val("Draft");
	   			$("#multiaction").val("Yes");
	   			action_submit('');

			 }); 

			 $( "#alt0" ).click(function() { 
					$("#multiaction").val('');
			 });
		}

		<?php /*   deactivation action  */?>
		if(this_action=="Deactivate")
		{    
		customAlertmsg("<?php echo sprintf($this->lang->line('confirm_deactivate'), ucfirst($module_label)); ?>");
			
			 $( "#alt1" ).click(function() {  
	   			$("#actionid").val("Deactivate");
	   			$("#multiaction").val("Yes");
	   			action_submit('');

			 });

			 $( "#alt0" ).click(function() { 
					$("#multiaction").val('');
			 });
		}

		<?php /*  Delete  action  */?>
		if(this_action=="Delete")
		{    
		  customAlertmsg("<?php echo sprintf($this->lang->line('confirm_delete'), ucfirst($module_labels)); ?>");	

		  $( "#alt1" ).click(function() {   
	   			$("#actionid").val("Delete");
	   			$("#multiaction").val("Yes");
	   			action_submit('');

			 });

			 $( "#alt0" ).click(function() { 
					$("#multiaction").val('');
			 });
		}

		 <?php /*   Sequence  action  */?>
			if(this_action=="Sequence")
			{    
				customAlertmsg ("<?php echo sprintf($this->lang->line('confirm_sequence'), ucfirst($module_labels)); ?>");	
				  $( "#alt1" ).click(function() {
		   			$("#actionid").val("Sequence");
		   			$("#multiaction").val("Yes");
		   			action_submit('');

				 });

				  $( "#alt0" ).click(function() { 
						$("#multiaction").val('');
				 })
			}
			
	 } 	
 	
});

}); /* end of ready */

<?php /*  alert for conformation in multible actions  */ ?>
function confirm_alert(error)
{

	var x=window.confirm(error);
	if (x) { 
            return true;
	} else {
	        return false;
	}
	
}

<?php /* cancel form to redirect parent module  */ ?>
function cancelform(url)
{ 
    var url;
	window.location=url; 
}
</script>
