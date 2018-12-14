<link rel="stylesheet" href="<?php echo load_lib()?>timepicker-master/jquery-ui-1.10.0.custom.min.css" type="text/css" />
<script type="text/javascript" src="<?php echo skin_url()?>js/products_manage.js"></script>
<link rel="stylesheet" href="<?php echo load_lib()?>/theme/css/custom.css">
<style>
header { margin:0px; }
.flat-blue .card { display:inline-block; padding:6px 0; width:100%; }
.card-header { margin-top:0px !important; }
.card .card-header .card-title { padding-top: 6px; }

/*for images section*/
.image_browser_section {
width: 60%;
float: left;
clear:none !important
}
.addmorefiles { width:10%; float:left; clear:none !important}
.result_browsefile { display:none;}
.remove_gallery { float:left; }
.image_browser_section_gallery {
width: 100%;
margin: 10px;
float: left;
}

#common_form .chosen-container {
	width: 100% !important;
	margin-top:0px !important;
}
.control-label {
    padding-top: 7px;
    margin-bottom: 0;
    text-align: right;
}
.col-sm-2 {
	width:25%;
	float:left;
	padding-right:15px;
}
.col-sm-4 {
    width: 33.33333333%;
	float:left;
}
.col-sm-8 {
	width:75%;
	float:left;
}
.col-sm-5 {
	width:50%;
	float:left;
}
.form-group {
    margin: 15px 5px;
}
.card-header {
	width: 100%;
	float: left;
	clear: both;
	margin-top: 21px;
	padding-right: 30px;
}
.card-title{
	text-align: center;
	font-size: 16px;
	font-weight: bold;
	width: calc(100% - 100px);
	float: left;
}
#common_form {
    clear: both;
    float: left;
    width: 100%;
    margin: 5px;
}
.btn_submit_div {
	width: 100%;
	text-align: center;
}
</style>
<script>
var validation_container ="Yes";
var gallery_image_label = "<?php echo get_label('product_gallery');?>";
var commission_price = '<?php echo $commission_price; ?>';
</script>
<div class="container-fluid product_add">
	<div class="side-body">
		<div class="row">
			<div class="col-xs-12">
				<div class="card">
					<div class="card-header">
						<div class="card-title">
							<div class="title"><?php echo $form_heading;?>   </div>
						</div>
						<div class="pull-right card-action">
							<div class="btn-group" role="group" aria-label="...">
								<a href="<?php echo base_url().$module;?>" class="btn btn-info"><?php echo get_label('back');?></a>
							</div>
						</div>
					</div>
					<?php echo form_open_multipart(admin_url().$module."/$module_action",' class="form-horizontal" id="common_form" ' );?>
						<div class="form-group">
							<label for="product_customer_id" class="col-sm-2 control-label"><?php echo get_label('service_customer').get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>"">
								<div class="input_box">
								<?php echo get_product_customer(array('customer_status'=>'A'),$records['ser_customer_id'],'class="form-control search_select" id="product_customer_id"  data-placeholder="'.get_label('product_customer_id').'" ','','','1','');?></div>
							</div>
						</div>
						<div class="form-group">
							<label for="post_category" class="col-sm-2 control-label"><?php echo get_label('ser_category').get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php echo get_service_category($where='',$records['ser_category'],$extra='class="form-control" id="ser_category" required onchange="get_subcategory()" ',$product_id='ser_cate_primary_id'); ?></div></div>
						</div>

						<div class="form-group">
							<label for="post_category" class="col-sm-2 control-label"><?php echo get_label('ser_subcategory').get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box modi_div"><?php echo get_service_subcategory(array('pro_subcate_category_primary_id'=>$records['ser_category']),$records['ser_subcategory'],$extra='class="form-control" required id="ser_subcategory"',''); ?></div></div>
						</div>
						
						<div class="form-group">
							<label for="ser_title" class="col-sm-2 control-label"><?php echo get_label('ser_title').get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('ser_title',$records['ser_title'],' class="form-control required"  ');?></div></div>
						</div>

						<div class="form-group">
							<label for="ser_description" class="col-sm-2 control-label"><?php echo get_label('ser_description').get_required();?></label>
                            <div class="col-sm-8">
								<div class="input_box"><?php  echo form_textarea('ser_description',$records['ser_description'],' class="form-control"  ');?></div>
							</div>
						</div>

						<div class="form-group multi_field">
							<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('ser_gallery');?></label>
							<div class="col-sm-5 ">
								<div class="input_box">
									<div class="custom_browsefile"> <?php echo form_upload('product_gallery[]');?> <span class="result_browsefile"><span class="brows"></span> + <?php echo get_label('ser_gallery');?></span>
									</div>
								</div>
								<?php /*<span class="hint"><?php echo "* ". get_label('product_max_image_count');?></span>*/ ?>
							</div>
							<div class="col-sm-1 ">
								<span class="add_field_button fa fa-plus  more_link"></span>
							</div>
						</div>
						
						<?php if(!empty($gallery_images)) { ?>
							<div class="gallery_images">
								<div class="form-group image_outer ">
									<div class="col-sm-offset-2 col-xs-9 col-md-9 ">
										<div class="gallery_images_flow">
											<?php foreach($gallery_images as $gallery ) { ?>
													 
												<a class="thumbnail gallery_delete"
												id="<?php echo  encode_value($gallery['ser_gallery_id']);?>"
												href="javascript:;"
												title="<?php echo get_label('remove_image_title');?>"> <img
												class="img-responsive "
												style="width: 250px; height: 250px;"
												src="<?php echo media_url()."/". $this->lang->line('service_gallery_image_folder_name')."/".$gallery['ser_gallery_image'];?>">
												</a>
											 <?php } ?>
										</div>
									</div>
								</div>
							</div>					
						<?php } ?>

						<div class="form-group">
							<label for="ser_pricet_type" class="col-sm-2 control-label"><?php echo get_label('ser_pricet_type').get_required();?></label>
							<div class="col-sm-8"><div class="input_box"><?php echo form_dropdown('ser_pricet_type',array('day'=>'Day','hour'=>'Hour'),$records['ser_pricet_type'],'class="form-control required" id="ser_pricet_type"'); ?></div></div>
						</div>

						<div class="form-group">
							<label for="time_start_time" class="col-sm-2 control-label"><?php echo get_label('time_start_time').get_required();?></label>
							<div class="col-sm-8"><div class="input_box"><?php echo get_time_dropdown('time_start_time',$records['ser_service_start_time']); ?></div></div>
						</div>

						<div class="form-group">
							<label for="time_end_time" class="col-sm-2 control-label"><?php echo get_label('time_end_time').get_required();?></label>
							<div class="col-sm-8"><div class="input_box"><?php echo get_time_dropdown('time_end_time',$records['ser_service_end_time']); ?></div></div>
						</div>

						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('ser_price').get_required();?></label>
							<div class="col-sm-8">
								<div class="input_box">
									<input type="number" value="<?php echo $records['ser_price']; ?>" required class="form-control required" title="<?php echo get_label('ser_price'); ?>" name="ser_price" onkeypress="return isFloat(event)" id="ser_price">
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('ser_discount_price');?></label>
							<div class="col-sm-8">
								<div class="input_box">
									<input type="number" value="<?php echo $records['ser_discount_price']; ?>" class="form-control " name="ser_discount_price" onkeypress="return isFloat(event)" id="ser_discount_price">
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('ser_discount_start_date');?></label>
							<div class="col-sm-8">
								<div class="input_box">
									<input type="text" value="<?php echo ($records['ser_discount_start_date'] !='' && $records['ser_discount_start_date'] !="NULL" && $records['ser_discount_start_date'] != '0000-00-00 00:00:00' && $records['ser_discount_start_date'] != '1970-01-01')?stripslashes(date('d-m-Y',strtotime($records['ser_discount_start_date']))):"";?>" class="form-control datepickerchange1 " name="ser_discount_start_date" id="ser_discount_start_date" >
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('ser_discount_end_date');?></label>
							<div class="col-sm-8">
								<div class="input_box">
									<input type="text" value="<?php echo ($records['ser_discount_end_date'] !='' && $records['ser_discount_end_date'] !="NULL" && $records['ser_discount_end_date'] != '0000-00-00 00:00:00' && $records['ser_discount_end_date'] != '1970-01-01')?stripslashes(date('d-m-Y',strtotime($records['ser_discount_end_date']))):"";?>" class="form-control datepickerchange2 " name="ser_discount_end_date" id="ser_discount_end_date">
								</div>
							</div>
						</div> 

						<div class="form-group">
							<label for="ser_availability" class="col-sm-2 control-label"><?php echo get_label('ser_availability').get_required();?></label>
							<div class="col-sm-8"><div class="input_box"><?php echo form_dropdown('ser_availability[]',array(''=>'Select Availability','mon'=>'Monday','tue'=>'Tuesday','wed'=>'Wednesday','thu'=>'Thursday','fri'=>'Friday','sat'=>'Saturday','sun'=>'Sunday'),$availability,'class="form-control required " multiple="multiple" data-placeholder="Select Availability" id="ser_avail"'); ?></div></div>
						</div>

						<div class="form-group">
							<label for="customer_city" class="col-sm-2 control-label"><?php echo get_label('customer_city').get_required();?></label>
							<div class="col-sm-8"><div class="input_box">
							<?php echo get_all_cities('',$service_city,'class="form-control" required data-placeholder="Select City" id="customer_city" multiple="multiple" data-placeholder="Select City"','customer_city[]'); ?>
							</div></div>
						</div>
						
						
						<div class="form-group">
							<label for="status" class="col-sm-2 control-label"><?php echo get_label('status').get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_dropdown('status',array ('' => get_label('select_status'),'A' => 'Active','I' => 'Inactive'),$records['ser_status'],'class="form-control required" id="status" style="width:374px;"');?></div></div>
						</div>

						 <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-<?php echo get_form_size();?>  btn_submit_div">
                                <button type="submit" class="btn btn-primary " name="submit"
                                    value="Submit"><?php echo get_label('submit');?></button>
                                <a class="btn btn-info" href="<?php echo admin_url().$module;?>"><?php echo get_label('cancel');?></a>
                            </div>
                        </div>
					</div>

					<?php
					echo form_hidden('edit_id',$records['ser_primary_id']);
					echo form_hidden ( 'action', 'edit' );
					echo form_close ();
					?>
			
				
			</div>
			</div>
		</div>
	</div>


<script>
jQuery("#dynamic-form").on("click", ".add-shipping", function(e) {
    e.preventDefault();
    
});

jQuery("#dynamic-form").on("click", ".remove-shipping", function(e) {
    e.preventDefault();
    jQuery(".dynamicform_shippingmethod").yiiDynamicForm("deleteItem", dynamicform_74805eeb, e, jQuery(this));
});
</script>
<script type="text/javascript">
	jQuery( ".tabs-left" ).tabs();
	
	
	if(jQuery('.datepickerchange1').length && jQuery('.datepickerchange2').length) {
		
		jQuery('.datepickerchange1').datepicker({'format': 'dd-mm-yyyy','startDate':'today'})
		.on('changeDate', function(ev){
			var endDate = new Date(jQuery('.datepickerchange2').val());
			if (ev.date.valueOf() > endDate.valueOf()){
				jQuery('#alert').show().find('strong').text('The start date should be lesser than the end date');
			} else {
				jQuery('#alert').hide();

			}
			jQuery('.datepickerchange2').datepicker('hide');
		});
		jQuery('.datepickerchange2').datepicker({'format': 'dd-mm-yyyy','startDate':'today'})
		.on('changeDate', function(ev){
			var startDate = new Date(jQuery('.datepickerchange1').val());
			if (ev.date.valueOf() < startDate.valueOf()){
				jQuery('#alert').show().find('strong').text('The end date should be greater than the start date');
			} else {
				jQuery('#alert').hide();
			}
			jQuery('.datepickerchange2').datepicker('hide');
		});
		jQuery('.datepickerchange1').datepicker({'format': 'dd-mm-yyyy','startDate':'today'});
		jQuery('.datepickerchange2').datepicker({'format': 'dd-mm-yyyy','startDate':'today'})
	}

jQuery('body').on('blur','#product_price', function() {
    var orginal_price = jQuery(this).val();
    var commision_after = orginal_price - ((parseFloat(orginal_price) * parseFloat(commission_price) )/ 100);
    jQuery('.commission_price').html(commision_after);
});

jQuery('body').on('blur','#product_spl_price', function() {
    var orginal_special_price = jQuery(this).val();
    var commision_after = orginal_special_price - ((parseFloat(orginal_special_price) * parseFloat(commission_price) )/ 100);
    jQuery('.commission_special_price').html(commision_after);
});
</script>
<?php /*	
<style>
#common_form .chosen-container {
    min-width: 200px !important;
}
.form_field {height:40px;}
.remove_gallery { width: 35px;
float: left; 
}
.input_box {
    position: relative;
}
.custom_browsefile input[type=file]{ height: 34px; width: 100%; opacity: 0; filter: alpha(opacity=0);cursor: pointer; }
.result_browsefile{ border: 1px solid #dcd9d9;position: absolute; height: 34px; color: #aaa7a7; line-height: 34px; left:0; top:0; width: 100%; pointer-events: none; text-align: center; font-size: 15px; overflow: hidden;}
.result_browsefile:before{content: ""; height: 100%; width: 0; display: inline-block; vertical-align: middle;}
.brows{display: inline-block;}

.more_link{ display: inline-block; width: 30px; height: 30px; background: #E74C3C; text-align: center; line-height: 30px; color: #fff; border-radius: 100%; -webkit-border-radius: 100%; margin: 2px 0; font-size: 18px; cursor: pointer;}
.gallery_images_flow{ overflow-y: auto; max-height: 275px; display: inline-block;}
.show_image_box .thumbnail, .image_outer .thumbnail{ display: inline-block; position: relative; margin: 3px;}
.show_image_box .thumbnail:before, .image_outer .thumbnail:before{ content: ""; position: absolute; right:0; top:0; left:0; bottom: 0; background: rgba(255, 255, 255, 0.6) url(../images/cross-out.png) no-repeat center;  opacity: 0; filter: alpha(opacity=0); transition: all 400ms; -webkit-transition: all 400ms; pointer-events: none;}
.show_image_box .thumbnail:hover, .image_outer .thumbnail:hover{ box-shadow: 0 0 3px 0 #b8b8b8; -webkit-box-shadow: 0 0 3px 0 #b8b8b8; border-color: #dcd9d9;  transition: all 400ms; -webkit-transition: all 400ms;}
.show_image_box .thumbnail:hover:before, .image_outer .thumbnail:hover:before{ opacity: 1; filter: alpha(opacity=100);}

a.thumbnail.active, a.thumbnail:focus, a.thumbnail:hover{ border-color: #252525;}


.tabs-left {
    width: 100%;
    float: left;
    margin-top: 10px;
    border: 0px;
}

.ui-tabs .ui-tabs-nav {
	background: none;
	border: 0px;
	padding:0px;
	width: 200px;
	float: left;
	margin-right: 10px;
}
.ui-tabs .ui-tabs-nav li, .ui-tabs .ui-tabs-nav li a {
	width:100%;
}
.ui-tabs .ui-tabs-nav li a > div {
	width:25px;
	float: left;
}
.ui-tabs .ui-tabs-nav li a .step-title {
    width: calc(100% - 25px) !important;
    font-size: 14px;
}
.tab-content {
    width: calc(100% - 210px);
    float: left;
}
#common_form .chosen-container {
	width: 100% !important;
	margin-top:0px !important;
}
.col-sm-2 {
	width:15%;
	float:left;
}
.col-sm-8 {
	width:80%;
	float:left;
}
.form-group {
    margin: 15px 5px;
}
.card-header {
	width: 100%;
	float: left;
	clear: both;
	margin-top: 21px;
	padding-right: 30px;
}
.card-title{
	text-align: center;
	font-size: 16px;
	font-weight: bold;
	width: calc(100% - 100px);
	float: left;
}
#common_form {
    clear: both;
    float: left;
    width: 100%;
    margin: 5px;
}
.btn_submit_div {
	width: 100%;
	text-align: center;
}
table { width:100%; text-align:center; }
.custom_file { display:none; }
.brows { border:0px; }
.shipping_method, .associate_product_tab { overflow-x:auto; max-width: 100%; }
</style>*/ ?>