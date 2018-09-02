<script type="text/javascript" src="<?php echo admin_skin()?>js/products.js"></script>
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
                             	     'product_name' => get_label('product_name'),
                             		'product_sku' => get_label('product_sku'),
                             );
                             
                             echo form_dropdown('search_field',$search_array,get_session_value($module."_search_field"),' style="width:100px  !important; " ');
                             
                             ?>
                            </div>
                               <div class="form-group">
                                <?php echo form_input('search_value',get_session_value($module."_search_value"),'class="form-control"');?>
                            </div>
                            
                             <?php /* category filter*/ ?>
                             <div class="form-group">
                                 <?php //echo get_product_category(array('cate_availability_id !=' => 'EB62AF63-0410-47CC-9464-038E796E28C4'),get_session_value($module."_category_id"),'class="form-control search_select" id="product_category" ','pro_cate_id');?>
                            </div> 
                           
                                <div class="form-group">
                                 <?php echo get_status_dropdown(get_session_value($module."_search_status"),'','style="width: 120px ! important;"');?>
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

<script>
/*  load initial content.. */
$(window).load(function(){
	  get_content({paging:"true"});
});
</script>
<style>
.card .card-body {
    padding: 25px 0px;
}
.form-inline .form-group {
    display: inline-block;
    margin-bottom: 0;
    vertical-align: middle;
}
.form-inline .form-control {
    display: inline-block;
    width: auto;
    vertical-align: middle;
}
input.form-control {
    color: #000;
    font-family: Myriad Pro;
}
.form-control {
    height: 48px;
    border: 1px solid #dcd9d9;
    background: #fff;
    border-radius: 4px;
    -webkit-border-radius: 4px;
    font-size: 15px;
    color: #aaa7a7;
}
.form-control {
    display: block;
    width: 100%;
    height: 34px;
    padding: 6px 12px;
    font-size: 14px;
    line-height: 1.42857143;
    color: #555;
    background-color: #fff;
    background-image: none;
    border: 1px solid #ccc;
    border-radius: 4px;
    -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
    box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
    -webkit-transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;
    -o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
    transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
}
input[type="text"], input[type="email"], input[type="password"], textarea, select {
	margin:0px;
	height:30px;
}
.flat-blue a.an_btn {
    color: #e43232;
}

.an_btn {
    text-align: center;
    font-size: 13px;
    font-family: 'Open Sans', sans-serif;
    text-align: center;
    color: #e43232;
    display: inline-block;
    text-transform: uppercase;
    margin-left: 10px;
}

.an_btn span {
    line-height: 44px;
    font-size: 24px;
    border: 3px solid #e43232;
    height: 50px;
    width: 50px;
    display: block;
    margin: 0 auto 3px;
    border-radius: 100%;
    -webkit-border-radius: 100%;
}

.table_overflow {
    overflow-x: auto;
    max-width: 100%;
}
.pagination_bar {
    margin-bottom: 12px;
}
.table {
    margin-bottom: 12px;
	width:100%;
}
.table > thead > tr {
    background: #e2e2e2;
}
.table > thead > tr > th, .flat-blue .table > thead > tr > td {
    border-width: 0;
        border-top-width: 0px;
    text-transform: uppercase;
    font-weight: normal;
    padding: 15px 20px;
    padding: 12px 8px;
    vertical-align: middle;
}


 /* Table Check box */
.table .checkbox3 label:before{ width: 19px; height: 19px; top: 3px; background: #fff;}
.table .checkbox3.checkbox-light input:checked+label:before{ background: #fff;}
.table .checkbox3 label:after{ top:3px; margin-left: 0; }
.checkbx_sec{ position: relative;}
.checkbx_sec .checkbox-inline{ position: static;}
input.edit_txt{ width: calc(100% - 50px);}
    /* Subtable */
/* .ltable_outer{background: #F0F0F0;} */
.table tbody tr.ltable_outer:hover{ background: #fff;}
.loop_table{}
 .loop_table{background: #F0F0F0;}
.table.loop_table > tbody > tr:first-child > td, .flat-blue .table.loop_table > tbody > tr:first-child > th{border-top:0;}
.table.loop_table > tbody > tr > td, .flat-blue .table.loop_table > tbody > tr > th, .flat-blue .table.loop_table > tfoot > tr > td, .flat-blue .table.loop_table > tfoot > tr > th{padding: 10px 20px; border-color: #ccc;}
a.expand{  width: 18px; height: 18px; line-height: 17px; text-align: center; color: #252525; background: #fff; cursor: pointer; border: 1px solid #ccc; display: inline-block;margin-right: 5px;}
a.expand .fa{font-size: 13px;}
.expand.open_icon .fa:before{ content: "\f068";}

tbody.append_html input[type="checkbox"] {
	margin-left: 10px;
}
</style>


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
</script>