<script type="text/javascript" src="<?php echo admin_skin()?>js/products.js"></script>
<script type="text/javascript" src="<?php echo skin_url(); ?>js/products_manage.js"></script>
<div class="container-fluid">
	<div class="side-body">
	   <?php echo get_template('layout/notifications','')?>
		<div class="page-title">
            <div class="tt_left">
                <h1 class="title page-header text-overflow"><?php echo $module_labels; ?> </h1>
            </div>
            <div class="pull-right">
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

<script>
/*  load initial content.. */
$(window).load(function(){
	  get_content({paging:"true"});
});
</script>
<style>
.table_overflow {
    overflow-x: auto;
    max-width: 100%;
}
table { 
    border-collapse: collapse;
    width: 100%;
    margin: 0 auto;
}
thead {
    background: #F1F1F1;
}
tr {
    height:50px;
    text-align:center;
}
td, th{
    border: 1px solid #d4d4d4;
    border-collapse: collapse;
    text-align: center;
    padding: 8px;
    padding-left: 8px;
    vertical-align: top;
}
#common_search, .page-title {
    margin: 0 auto;
    width: 96%;
}
.page-title { padding:15px; }
.form-group {
    width: auto;
    float: left;
    margin: 0 auto;
}
.append_html {
    width: 96%;
    margin: 0 auto;
}
.page-header {
	margin: 0 auto;
	text-align: center;
	padding: 10px;
}
</style>