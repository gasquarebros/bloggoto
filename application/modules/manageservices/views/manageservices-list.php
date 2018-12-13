
<!--<script type="text/javascript" src="<?php echo admin_skin()?>js/products.js"></script>-->
<div class="container flat-blue">
	<div class="profile_wrap">
	   
		<div class="page-title">
            <div class="tt_left">
                <span class="title"><?php echo $module_labels; ?></span>
            
            </div>
            <div class="pull-right">

                <a href="<?php echo base_url().$module."/add"?>"
				class="an_btn" type="button"><span><i class="fa fa-plus"></i></span><?php echo get_label('add');?></a>

                </div>
    
                    </div>

		<div class="row">
			<div class="col-xs-12">
				<div class="card ">
					<div class="card-header">
                        <div class="card-body"> 
                            <?php echo form_open('',' id="common_search" class="form-inline"');?>
                            <div class="form-group">
                             <?php  $search_array = array(
                             		 '' => get_label('select'),
                             	     'ser_title' => get_label('ser_title'),
                             		'ser_slug' => get_label('ser_slug'),
                             );
                             
                             echo form_dropdown('search_field',$search_array,get_session_value($module."_search_field"),' style="width:200px  !important; " ');
                             
                             ?>
                            </div>
                               <div class="form-group">
                                <?php echo form_input('search_value',get_session_value($module."_search_value"),'class="form-control"');?>
                            </div>
                            
                             <?php /* category filter*/ ?>
                             <div class="form-group">
							 	<?php 
                             		echo get_service_category($where='',$selected='',$extra='class="form-control" id="product_category" ',$product_id='ser_cate_primary_id');
                             	?>
                            </div> 
                           
                                <div class="form-group">
                                 <?php echo get_status_dropdown(get_session_value($module."_search_status"),'','style="width: 200px ! important;"');?>
                            </div>                                
                            <div class="form-group">
                                <button class="btn btn-primary" type="button" id="submit_search" onclick="get_content('')"><i class="fa fa-search"></i></button> <a class="btn btn-info"  id="reset_search"  href="<?php echo base_url().$module."/refresh"?>"><i class="fa fa-refresh"></i>&nbsp; <?php echo get_label('reset');?></a> 
                            </div> 
						 
                             <?php echo form_close(); ?>    
						</div>		 
							 
                    </div>
					<div class="card-body">
                        
						
						
					  <?php echo form_open(base_url().$module."/action",array("id"=>"mainform","class"=>"action_form"));?>
						<input  type="hidden"  name="postaction"  id="actionid" value=""> 
						<input  type="hidden"  name="changeId"  id="changeId"  value="">
						<input  type="hidden"  name="multiaction"  id="multiaction"  value="">
					    <input  type="hidden"  name="page_id"  id="page_id" value="0">
						<div class="cntloading_wrapper min_height" > <?php echo loading_image('cnt_loading');?>  <div class="append_html"></div></div>
							
                                    <?php // echo $paging;?>
                                  <?php echo form_close();?>  
                                             
                                </div>
				</div>
			</div>
			
		
		</div>

	</div>
</div>
<script type="text/javascript" src="<?php echo skin_url(); ?>js/products_manage.js"></script>
<link rel='stylesheet' href='<?php echo skin_url().'css/manageproduct.css'; ?>' type='text/css' media='all' /> 
<script>
/*  load initial content.. */
$(window).load(function(){
	  get_content({paging:"true"});
});

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

	 <?php /*   Add Celebrity Badge action  */?>
		if(this_action=="Add_Celebrity_Badge")
		{    
			 customAlertmsg("<?php echo sprintf($this->lang->line('confirm_add_celebrity_bage'), ucfirst($module_labels)); ?>");
			 	
			 $( "#alt1" ).click(function() { 
	   			$("#actionid").val("Add_Celebrity_Badge");
	   			$("#multiaction").val("Yes");
	   			action_submit('');

			 }); 

			 $( "#alt0" ).click(function() { 
					$("#multiaction").val('');
			 });
		}			
	 <?php /*   Remove Celebrity Badge action  */?>
		if(this_action=="Remove_Celebrity_Badge")
		{    
			 customAlertmsg("<?php echo sprintf($this->lang->line('confirm_remove_celebrity_bage'), ucfirst($module_labels)); ?>");
			 	
			 $( "#alt1" ).click(function() { 
	   			$("#actionid").val("Remove_Celebrity_Badge");
	   			$("#multiaction").val("Yes");
	   			action_submit('');

			 }); 

			 $( "#alt0" ).click(function() { 
					$("#multiaction").val('');
			 });
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

$(".append_html").on("click", ".pagination a", function(e) {
    e.preventDefault();

    var pass_url = $(this).attr('href');
    if (typeof (pass_url) != 'undefined' && pass_url != null) {
        show_content_loading();
        $.get(pass_url+"?paging=true", function(data) {
            hide_content_loading();
            var response = jQuery.parseJSON(data);
            $(".append_html").html(response.html);
            $("#page_id").val(response.offset);

        });
    }

});
</script>