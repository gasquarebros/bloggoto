<link href="<?php echo load_lib()?>bootstrap-datepicker/css/bootstrap-datetimepicker.css" rel="stylesheet">
<link rel="stylesheet" href="<?php echo load_lib()?>timepicker-master/jquery-ui-1.10.0.custom.min.css" type="text/css" />
<link rel="stylesheet" href="<?php echo load_lib()?>timepicker-master/jquery.ui.timepicker.css" type="text/css" />
<script type="text/javascript" src="<?php echo load_lib()?>timepicker-master/jquery.ui.core.min.js"></script>
<script type="text/javascript" src="<?php echo load_lib()?>timepicker-master/jquery.ui.timepicker.js"></script>
<script type="text/javascript" src="<?php echo admin_skin()?>js/timepicker_outlet.js"></script>
<script type="text/javascript" src="<?php echo load_lib()?>bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?php echo admin_skin()?>js/products.js"></script>
<script>
var validation_container ="Yes";
var gallery_image_label = "<?php echo get_label('product_gallery');?>";

</script>
<div class="container-fluid">
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
                                <a  href="<?php echo admin_url().$module;?>" class="btn btn-info">Back</a>
                            </div>
                        </div>
                        
                        
					</div>                    
					<div class="card-body">
					<ul class=" alert_msg  alert-danger  alert container_alert" style="display: none;">
					
					</ul>	          
                <?php echo form_open_multipart(admin_url().$module.'/add',' class="form-horizontal" id="common_form" ' );?>

						<div class="form-group">
							<label for="product_customer_id" class="col-sm-2 control-label"><?php echo get_label('service_customer').get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>"">
								<div class="input_box">
								<?php echo get_product_customer(array('customer_status'=>'A'),'','class="form-control search_select" id="product_customer_id"  data-placeholder="'.get_label('product_customer_id').'" ','','','1','');?></div>
							</div>
						</div>

                        <div class="form-group">
							<label for="post_category" class="col-sm-2 control-label"><?php echo get_label('ser_category').get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php echo get_service_category($where='',$selected='',$extra='class="form-control" id="ser_category" required onchange="get_subcategory()" ',$product_id='ser_cate_primary_id'); ?></div></div>
						</div>

						<div class="form-group">
							<label for="post_subcategory" class="col-sm-2 control-label"><?php echo get_label('ser_subcategory').get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box modi_div"><?php echo get_service_subcategory($where='',$selected='',$extra='class="form-control" required id="ser_subcategory"',''); ?></div></div>
						</div>
						
						<div class="form-group">
							<label for="ser_title" class="col-sm-2 control-label"><?php echo get_label('ser_title').get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('ser_title',set_value('ser_title'),' class="form-control required"  ');?></div></div>
						</div>

						<div class="form-group">
							<label for="ser_description" class="col-sm-2 control-label"><?php echo get_label('ser_description').get_required();?></label>
                            <div class="col-sm-8">
								<div class="input_box"><?php  echo form_textarea('ser_description',set_value('ser_description'),' class="form-control"  ');?></div>
							</div>
						</div>

						<div class="form-group multi_field">
							<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('ser_gallery');?></label>
							<div class="col-sm-8 ">
								<div class="input_box">
									<div class="custom_browsefile"> <?php echo form_upload('product_gallery[]');?> <span class="result_browsefile"><span class="brows"></span> + <?php echo get_label('ser_gallery');?></span>
									</div>
								</div>
								<span class="hint"><?php echo "* ". get_label('product_max_image_count');?></span>
							</div>
							<div class="col-sm-1 ">
								<span class="add_field_button fa fa-plus  more_link"></span>
							</div>
						</div>

						

						<div class="form-group">
							<label for="ser_pricet_type" class="col-sm-2 control-label"><?php echo get_label('ser_pricet_type').get_required();?></label>
							<div class="col-sm-8"><div class="input_box"><?php echo form_dropdown('ser_pricet_type',array('day'=>'Day','hour'=>'Hour'),'','class="form-control required" id="ser_pricet_type"'); ?></div></div>
						</div>

						<div class="form-group">
							<label for="ser_price" class="col-sm-2 control-label"><?php echo get_label('ser_price').get_required();?></label>
							<div class="col-sm-8">
								<div class="input_box">
									<input type="number" value="" required class="form-control required" title="<?php echo get_label('ser_price'); ?>" name="ser_price" onkeypress="return isFloat(event)" id="ser_price">
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="ser_discount_price" class="col-sm-2 control-label"><?php echo get_label('ser_discount_price');?></label>
							<div class="col-sm-8">
								<div class="input_box">
									<input type="number" value="" class="form-control " name="ser_discount_price" onkeypress="return isFloat(event)" id="ser_discount_price">
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="ser_discount_start_date" class="col-sm-2 control-label"><?php echo get_label('ser_discount_start_date');?></label>
							<div class="col-sm-8">
								<div class="input_box">
									<input type="text" value="" class="form-control datepickerchange1 " name="ser_discount_start_date" id="ser_discount_start_date" >
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="ser_discount_end_date" class="col-sm-2 control-label"><?php echo get_label('ser_discount_end_date');?></label>
							<div class="col-sm-8">
								<div class="input_box">
									<input type="text" value="" class="form-control datepickerchange2 " name="ser_discount_end_date" id="ser_discount_end_date">
								</div>
							</div>
						</div> 

						<div class="form-group">
							<label for="ser_availability" class="col-sm-2 control-label"><?php echo get_label('ser_availability').get_required();?></label>
							<div class="col-sm-8"><div class="input_box"><?php echo form_dropdown('ser_availability[]',array(''=>'Select Availability','mon'=>'Monday','tue'=>'Tuesday','wed'=>'Wednesday','thu'=>'Thursday','fri'=>'Friday','sat'=>'Saturday','sun'=>'Sunday'),'','class="form-control required" multiple="multiple" data-placeholder="Select Availability"  id="ser_avail"'); ?></div></div>
						</div>

						<div class="form-group">
							<label for="customer_city" class="col-sm-2 control-label"><?php echo get_label('customer_city').get_required();?></label>
							<div class="col-sm-8"><div class="input_box">
							<?php echo get_all_cities('','','class="form-control" required data-placeholder="Select City" id="customer_city" multiple="multiple" data-placeholder="Select City"','customer_city[]'); ?>
							</div></div>
						</div>
						
						<div class="form-group">
							<label for="status" class="col-sm-2 control-label"><?php echo get_label('status').get_required();?></label>
							<div class="col-sm-8"><div class="input_box"><?php  echo form_dropdown('status',array ('' => get_label('select_status'),'A' => 'Active','I' => 'Inactive'),'','class="form-control required" id="status" style="width:374px;"');?></div></div>
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
					echo form_hidden ( 'action', 'Add' );
					echo form_close ();
					?>
			
				</div>
			</div>
		</div>
	</div>
</div>
<script>

function get_subcategory()
{
	var service_category = $('#ser_category').val();
	$.ajax({
		url : admin_url + module + "/get_subcategory",
		data : {
			secure_key : secure_key,
			'service_category' : service_category,
		},
		type : 'POST',
		dataType : "json",
		success : function(data) {
			if (data.html != "") {
				$(".modi_div").html(data.html);
				$('#ser_subcategory').chosen({});
			}

		}
	});
}
</script>
