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
								<a href="<?php echo admin_url().$module;?>" class="btn btn-info"><?php echo get_label('back');?></a>
							</div>
						</div>


					</div>
					     <?php echo form_open_multipart(admin_url().$module.'/add',' class="form-horizontal" id="common_form" autocomplete="'.form_autocomplte().'" ' );?>
                      <div class="card-body">
						<div class="container_div">
							<ul class=" alert_msg  alert-danger  alert container_alert"
								style="display: none;">
							</ul>
						</div>
						<div class="step tabs-left card-no-padding">
							<ul role="tablist" class="nav nav-tabs">
								<li role="step" class="active"><a aria-expanded="false"
									aria-controls="home" data-toggle="tab" role="tab"
									id="step1-vtab" href="#stepv1">
										<div class="icon fa fa-cutlery"></div>
										<div class="step-title">
											<div class="title"><?php echo get_label('product_tab1').get_required();?></div>

										</div>
								</a></li>
								<li role="step" class=""><a aria-controls="profile"
									data-toggle="tab" id="step2-vtab" role="tab" href="#stepv2"
									aria-expanded="false">
										<div class="icon fa fa-object-group"></div>
										<div class="step-title">
											<div class="title"><?php echo get_label('product_tab2').get_required();?></div>
										</div>
								</a></li>
								
								<li role="step" class=""><a aria-expanded="false"
									aria-controls="home" data-toggle="tab" role="tab"
									id="step3-vtab" href="#stepv3">
										<div class="icon fa fa-dollar"></div>
										<div class="step-title">
											<div class="title"><?php echo get_label('product_tab3').get_required();?></div>

										</div>
								</a></li>
								<li role="step" class=""><a aria-controls="profile"
									data-toggle="tab" id="step7-vtab" role="tab" href="#stepv7"
									aria-expanded="true">
										<div class="icon fa fa-truck"></div>
										<div class="step-title">
											<div class="title"><?php echo get_label('product_tab7');?></div>
											<div class="description"></div>
										</div>
								</a></li>
								<li role="step" class=""><a aria-controls="profile"
									data-toggle="tab" id="step4-vtab" role="tab" href="#stepv4"
									aria-expanded="true">
										<div class="icon fa fa-image"></div>
										<div class="step-title">
											<div class="title"><?php echo get_label('product_tab4');?></div>
											<div class="description"></div>
										</div>
								</a></li>
								<li role="step" class=""><a aria-controls="profile"
									data-toggle="tab" id="step5-vtab" role="tab" href="#stepv5"
									aria-expanded="true">
										<div class="icon fa fa-tags"></div>
										<div class="step-title">
											<div class="title"><?php echo get_label('product_tab5');?></div>
											<div class="description"></div>
										</div>
								</a></li> 
								<li role="step" class="associate_product_tab" style="display:none;">
									<a aria-controls="profile" data-toggle="tab" id="step6-vtab" role="tab" href="#stepv6" aria-expanded="true">
										<div class="icon fa fa-tags"></div>
										<div class="step-title">
											<div class="title"><?php echo get_label('product_tab6');?></div>
											<div class="description"></div>
										</div>
									</a>
								</li> 
							</ul>
							
							<div class="tab-content">
								<!-- tab1  -->
								<div aria-labelledby="home-tab" id="stepv1" class="tab-pane fade active in " role="tabpanel">
                                    <div class="form-group">
										<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('product_parent');?></label>
										<div class="col-sm-8">
											<div class="input_box">
												<?php echo get_product_list(array('product_status'=>'A','product_parent_id' =>''),'','class="form-control search_select check_option" id="products_list"  data-placeholder="'.get_label('select_products').'" ','','','1','parent_product');?>
											</div>
										</div>
									</div>
									<div class="form-group">
										<label for="product_customer_id" class="col-sm-2 control-label"><?php echo get_label('product_customer');?></label>
										<div class="col-sm-8">
											<div class="input_box">
										 <?php echo get_product_customer(array('customer_status'=>'A'),'','class="form-control search_select" id="product_customer_id"  data-placeholder="'.get_label('product_customer_id').'" ','','','1','');?></div>
										</div>
									</div>
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('product_name').get_required();?></label>
										<div class="col-sm-8">
											<div class="input_box"><?php  echo form_input('product_name',set_value('product_name'),' class="form-control required" title="'.sprintf(get_label('product_errors'),get_label('product_name')).'"  ');?></div>
										</div>
									</div>
                                    <div class="form-group">
										<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('product_alias');?></label>
										<div class="col-sm-8">
											<div class="input_box"><?php  echo form_input('product_alias_text',set_value('product_alias'),'class="form-control" ');?></div>
										</div>
									</div>
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('product_short_description');?></label>
										<div class="col-sm-8">
											<div class="input_box"><?php  echo form_textarea('product_short_description',set_value('product_short_description'),' class="form-control"  ');?></div>
										</div>
									</div>
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('product_long_description');?></label>
										<div class="col-sm-8">
											<div class="input_box"><?php  echo form_textarea('product_long_description',set_value('product_long_description'),' class="form-control" title="'.sprintf(get_label('product_long_description'),get_label('product_long_description')).'"   ');?></div>
										</div>
									</div>
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('product_sku').get_required();?></label>
										<div class="col-sm-8">
											<div class="input_box"><?php  echo form_input('product_sku',set_value('product_sku'),' class="form-control required"   title="'.sprintf(get_label('product_sku'),get_label('product_sku')).'"  ');?></div>
										</div>
									</div>
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('product_quantity').get_required();?></label>
										<div class="col-sm-8">
											<div class="input_box"><?php  echo form_input('product_quantity',set_value('product_quantity'),' class="form-control required"   title="'.sprintf(get_label('product_quantity'),get_label('product_quantity')).'"  ');?></div>
										</div>
									</div>
									<?php /*
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('product_barcode');?></label>
										<div class="col-sm-8">
											<div class="input_box"><?php  echo form_input('product_barcode',set_value('product_barcode'),' class="form-control"   ');?></div>
										</div>
									</div> */ ?>
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('product_sequence');?></label>
										<div class="col-sm-8">
											<div class="input_box">
												<input type="number" value="" class="form-control " name="product_sequence" id="product_sequence" onkeypress="return isNumber(event)">
											</div>
										</div>
									</div>
									<?php /*
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('product_tags') .add_tooltip('product_tags');?></label>
										<div class="col-sm-8">
											<div class="input_box"><?php  echo get_product_tags(array('pro_tag_status'=>'A'),'','  title="'.sprintf(get_label('product_errors'),get_label('product_tags')).'"   class="form-control multi_select "   data-placeholder="'.get_label('tag_select').'" ','multiple="multiple"');?></div>
										</div>
									</div> */ ?>
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('status').get_required();?></label>
										<div class="col-sm-<?php echo get_form_size();?>">
											<div class="input_box"><?php  echo get_status_dropdown('A','','class="required"    title="'.sprintf(get_label('product_errors'),get_label('status')).'"  ');;?></div>
										</div>
									</div>
								</div>
								
								<!-- tab2  -->
								<div aria-labelledby="profile-tab" id="stepv2" class="tab-pane fade " role="tabpanel">
									<div class="form-group" id="">
										<label for="product_settings_type" class="col-sm-2 control-label"><?php echo get_label('product_settings').get_required().add_tooltip('product_settings');?></label>
										<div class="col-sm-8">
											<div class="input_box"><?php  echo form_dropdown('product_settings',array('simple'=>'Simple Product','attribute'=>'Attribute Product'),'simple','class="form-control required" onchange="get_attribute_enabled()" id="product_settings_type"' );?></div>
										</div>
									</div>
									
									<div class="form-group" id="">
										<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('product_categorie').get_required().add_tooltip('product_categorie');?></label>
										<div class="col-sm-8">
											<div class="input_box"><?php  echo get_product_category_select_edit(array('pro_cate_status'=>'A'),'', '  class="search_select required" id="prod_category" onchange="get_attribute_enabled()" ','pro_cate_id');?></div>
										</div>
									</div>
									<div id="category_div"></div>
									
									<div class="form-group  associate_product_tab" style="display:none">
										<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('category_modifier').add_tooltip('modifier_enabled');?></label>
										<div class="col-sm-8"><div class="input_box modi_div"><?php  echo get_product_modifier(array('pro_modifier_status' => 'A'),'','class="form-control search_select " onchange="get_attribute_enabled()" id="product_modifier" ',' multiple="multiple" data-placeholder="'.get_label('product_modifier_select').'" ','pro_modifier_id');?></div></div>
									</div>
								</div>
								
								<!-- tab 3  -->
								<div aria-labelledby="dropdown1-tab" id="stepv3" class="tab-pane fade " role="tabpanel">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('product_price').get_required().add_tooltip('product_price');?></label>
										<div class="col-sm-8">
											<div class="input_box">
												<input type="number" value="" class="form-control required" title="<?php echo sprintf(get_label('product_errors'),get_label('product_price')); ?>" name="product_price" onkeypress="return isFloat(event)" id="product_price">
											</div>
										</div>
									</div>

                                    <div class="form-group">
										<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('product_price_after_commission').get_required().add_tooltip('product_price');?></label>
										<div class="col-sm-8">
											<div class="input_box commission_price">
											</div>
										</div>
									</div>

									<div class="form-group">
										<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('product_spl_price').add_tooltip('product_spl_price');?></label>
										<div class="col-sm-8">
											<div class="input_box">
												<input type="number" value="" class="form-control " name="product_spl_price" onkeypress="return isFloat(event)" id="product_spl_price">
											</div>
										</div>
									</div>

                                    <div class="form-group">
										<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('product_price_after_commission').get_required().add_tooltip('product_price');?></label>
										<div class="col-sm-8">
											<div class="input_box commission_special_price">
											</div>
										</div>
									</div>

									<div class="form-group">
										<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('product_spl_price_from').add_tooltip('product_spl_price_from');?></label>
										<div class="col-sm-8">
											<div class="input_box">
												<input type="text" value="" class="form-control datepickerchange1 " name="product_spl_price_from" id="product_spl_price_from" onkeypress="return isFloat(event)">
											</div>
										</div>
									</div>

									<div class="form-group">
										<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('product_spl_price_to').add_tooltip('product_spl_price_to');?></label>
										<div class="col-sm-8">
											<div class="input_box">
												<input type="text" value="" class="form-control datepickerchange2 " name="product_spl_price_to" id="product_spl_price_to" onkeypress="return isFloat(event)">
											</div>
										</div>
									</div> 
								</div>
                                <!-- tab 7 -->
								<div aria-labelledby="dropdown1-tab" id="stepv7" class="tab-pane fade " role="tabpanel">
									<table class="table table-bordered table-striped">
										<thead>
											<tr>
												<th>Shipping Method</th>
												<th>Shipping Delivery Price</th>
												<th>Shipping Delivery Is Combined</th>
												<th class="text-center" style="width: 90px;">
													<button type="button" class="add-shipping btn btn-success btn-xs"><span class="fa fa-plus"></span></button>
												</th>
											</tr>
										</thead>
										<tbody class="container-shippingitems" data-count="1">
											<?php $shipping_methods_list = get_shipping_list(array('ship_method_status'=>'A')); ?>
											<tr class="shipping-item" >
												<td>
													<select class="form-control" name="ProductShipping[prod_ass_ship_method_shipid][]">
														<option value="">Select Shipping Method</option>
														<?php foreach($shipping_methods_list as $shippingmethod) {  ?>
														<option value="<?php echo $shippingmethod['ship_method_id']; ?>"><?php echo $shippingmethod['ship_method_name']; ?></option>
														<?php } ?>
													</select>
												</td>
												<td>
													<input class="form-control input" name="ProductShipping[prod_ass_ship_method_price][]" type="text">
												</td>
												<td>
													<input name="ProductShipping[prod_ass_ship_method_uncheck][0]" value="0" class="shipping_free_unassign" type="hidden">
													<label>
														<input class="display shipping_free_assign" name="ProductShipping[prod_ass_ship_method_is_combined][0]" value="1" type="checkbox"> 
														Is Combined
													</label>
												</td>
												<td class="text-center vcenter" style="width: 90px; verti">
													<button type="button" class="remove-shipping btn btn-danger btn-xs"><span class="fa fa-minus"></span></button>
												</td>
											</tr>
										</tbody>
									</table>
								</div>
                                
								<!-- tab 7 -- >
							   
								<!-- tab 4  -->
								<div aria-labelledby="dropdown1-tab" id="stepv4"
									class="tab-pane fade " role="tabpanel">

									<div class="form-group">
										<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('product_thumbnail');?></label>
										<div class="col-sm-8">
											<div class="input_box">
												<div class="custom_browsefile"> <?php echo form_upload('product_thumbnail');?> <span class="result_browsefile"><span class="brows"></span> + <?php echo get_label('product_thumbnail');?></span>
												</div>
											</div>
										</div>
									</div>
									<div class="form-group multi_field">
										<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('product_gallery');?></label>
										<div class="col-sm-8 ">
											<div class="input_box">
												<div class="custom_browsefile"> <?php echo form_upload('product_gallery[]');?> <span class="result_browsefile"><span class="brows"></span> + <?php echo get_label('product_gallery');?></span>
												</div>
											</div>
											<span class="hint"><?php echo "* ". get_label('product_max_image_count');?></span>
										</div>
										<div class="col-sm-2 ">
											<span class="add_field_button fa fa-plus  more_link"></span>
										</div>
									</div>
								</div>

								
								<!-- tab 5  -->
								<div aria-labelledby="dropdown1-tab" id="stepv5"
									class="tab-pane fade " role="tabpanel">

									<div class="form-group">
										<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('product_meta_title');?></label>
										<div class="col-sm-8">
											<div class="input_box"><?php  echo form_input('product_meta_title',set_value('product_meta_title'),' class="form-control"  ');?></div>
										</div>
									</div>

									<div class="form-group">
										<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('product_meta_keywords');?></label>
										<div class="col-sm-8">
											<div class="input_box"><?php  echo form_textarea('product_meta_keywords',set_value('product_meta_keywords'),' class="form-control "  ');?></div>
										</div>
									</div>

									<div class="form-group">
										<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('product_meta_description');?></label>
										<div class="col-sm-8">
											<div class="input_box"><?php  echo form_textarea('product_meta_description',set_value('product_meta_description'),' class="form-control"  ');?></div>
										</div>
									</div>
								</div>

                                                           
                                <!-- tab 6  -->
								<div aria-labelledby="dropdown1-tab" id="stepv6" class="tab-pane fade associate_product_tab" role="tabpanel">
									<div class="">
										<table class="table table-bordered table-striped">
											<thead>
												<tr>
													<th>Product Name</th>
													<th>Product Sku</th>
													<th>Product Attributes</th>
													<th>Product Price</th>
													<th>Product Special Price</th>
													<th>Product Qty</th>
													<th style="width: 90px;" class="text-center">
														<button class="add-associates btn btn-success btn-xs" type="button"><span class="fa fa-plus"></span></button>
													</th>
												</tr>
											</thead>
											<tbody class="container-items1 product_associate_section">
												
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>


						<div class="form-group">
							<div
								class="col-sm-offset-6 col-sm-<?php echo get_form_size();?>  btn_submit_div">
								<button type="submit" class="btn btn-primary " name="submit"
									value="Submit"><?php echo get_label('submit');?></button>
								<a class="btn btn-info" href="<?php echo admin_url().$module;?>"><?php echo get_label('cancel');?></a>
							</div>
						</div>
					</div>
					<input type="hidden" id="form_action"  value="add" >
					<input type="hidden" id="form_id"  value="" >
				                		<?php
					echo form_hidden ( 'action', 'Add' );
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