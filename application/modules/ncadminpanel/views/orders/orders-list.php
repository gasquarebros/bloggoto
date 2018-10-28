<script type="text/javascript" src="<?php echo admin_skin()?>js/products.js"></script>
<div class="container-fluid">
	<div class="side-body">
	   <?php echo get_template('layout/notifications','')?>
		<div class="page-title">
            <div class="tt_left">
                <span class="title"><?php echo $module_labels; ?></span>
            
            </div>
            <div class="pull-right">

                <a href="<?php echo admin_url().$module."/add"?>"
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
                             	     'customer_first_name' => get_label('customer_name'),
                             		'order_local_no' => get_label('order_local_no'),
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
                                <button class="btn btn-primary" type="button" id="submit_search" onclick="get_content('')"><i class="fa fa-search"></i></button> <a class="btn btn-info"  id="reset_search"  href="<?php echo admin_url().$module."/refresh"?>"><i class="fa fa-refresh"></i>&nbsp; <?php echo get_label('reset');?></a> 
                            </div> 
						 
                             <?php echo form_close(); ?>    
						</div>		 
							 
                    </div>
					<div class="card-body">
                        
						
						
					  <?php echo form_open(admin_url().$module."/action",array("id"=>"mainform","class"=>"action_form"));?>
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

<script>
/*  load initial content.. */
$(window).load(function(){
	  get_content({paging:"true"});
});
</script>
