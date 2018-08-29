<link href="<?php echo load_lib()?>bootstrap-datepicker/css/bootstrap-datetimepicker.css" rel="stylesheet">
<link rel="stylesheet" href="<?php echo load_lib()?>timepicker-master/jquery-ui-1.10.0.custom.min.css" type="text/css" />
<link rel="stylesheet" href="<?php echo load_lib()?>timepicker-master/jquery.ui.timepicker.css" type="text/css" />
<script type="text/javascript" src="<?php echo load_lib()?>timepicker-master/jquery.ui.core.min.js"></script>
<script type="text/javascript" src="<?php echo load_lib()?>timepicker-master/jquery.ui.timepicker.js"></script>
<script type="text/javascript" src="<?php echo admin_skin()?>js/timepicker_outlet.js"></script>	
<script type="text/javascript"
	src="<?php echo load_lib()?>bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript"
	src="<?php echo admin_skin()?>js/products.js"></script>
<script>
var validation_container ="Yes";
var gallery_image_label = "<?php echo get_label('product_gallery');?>";
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
					<?php echo form_open_multipart(admin_url().$module."/$module_action",' class="form-horizontal" id="common_form" ' );?>

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
								<li role="step" class="associate_product_tab" <?php if($records['product_type'] !='attribute') { ?> style="display:none;" <?php } ?>>
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
										 <?php echo get_product_customer(array('customer_status'=>'A'),$records['product_customer_id'],'class="form-control search_select" id="product_customer_id"  data-placeholder="'.get_label('product_customer_id').'" ','','','1','');?></div>
										</div>
									</div>
									
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('product_name').get_required();?></label>
										<div class="col-sm-8">
											<div class="input_box"><?php  echo form_input('product_name',stripslashes($records['product_name']),' class="form-control required" title="'.sprintf(get_label('product_errors'),get_label('product_name')).'"  ');?></div>
										</div>
									</div>
                                    <div class="form-group">
										<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('product_alias');?></label>
										<div class="col-sm-8">
											<div class="input_box"><?php  echo form_input('product_alias_text',stripslashes($records['product_alias']),'class="form-control" ');?></div>
										</div>
									</div>
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('product_short_description');?></label>
										<div class="col-sm-8">
											<div class="input_box"><?php  echo form_textarea('product_short_description',stripslashes($records['product_short_description']),' class="form-control"  ');?></div>
										</div>
									</div>

									<div class="form-group">
										<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('product_long_description');?></label>
										<div class="col-sm-8">
											<div class="input_box"><?php  echo form_textarea('product_long_description',stripslashes($records['product_long_description']),' class="form-control"   title="'.sprintf(get_label('product_errors'),get_label('product_long_description')).'" ');?></div>
										</div>
									</div>

									<div class="form-group">
										<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('product_sku').get_required();?></label>
										<div class="col-sm-8">
											<div class="input_box"><?php  echo form_input('product_sku',stripslashes($records['product_sku']),' class="form-control required"  title="'.sprintf(get_label('product_errors'),get_label('product_sku')).'" ');?></div>
										</div>
									</div>
									<?php /*
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('product_barcode');?></label>
										<div class="col-sm-8">
											<div class="input_box"><?php  echo form_input('product_barcode',stripslashes($records['product_barcode']),' class="form-control"   ');?></div>
										</div>
									</div>
									*/ ?>

									
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('product_sequence');?></label>
										<div class="col-sm-8">
											<div class="input_box">
												<input type="number"
													value="<?php echo output_integer($records['product_sequence']); ?>"
													class="form-control " name="product_sequence"
													id="product_sequence" onkeypress="return isNumber(event)">

											</div>
										</div>
									</div>

									<div class="form-group">
										<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('status').get_required();?></label>
										<div class="col-sm-<?php echo get_form_size();?>">
											<div class="input_box"><?php  echo get_status_dropdown($records['product_status'],'','class="required"  title="'.sprintf(get_label('product_errors'),get_label('status')).'"   ');;?></div>
										</div>
									</div>



								</div>
								
								
								
								<!-- tab2  -->
								<div aria-labelledby="profile-tab" id="stepv2" class="tab-pane fade " role="tabpanel">
									<div class="form-group" id="">
										<label for="product_settings_type" class="col-sm-2 control-label"><?php echo get_label('product_settings').get_required().add_tooltip('product_settings');?></label>
										<div class="col-sm-8">
											<div class="input_box"><?php  echo form_dropdown('product_settings',array('simple'=>'Simple Product','attribute'=>'Attribute Product'),$records['product_type'],'class="form-control required" onchange="get_attribute_enabled()" id="product_settings_type"' );?></div>
										</div>
									</div>
									
									<div class="form-group" id="">
										<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('product_categorie').get_required().add_tooltip('product_categorie');?></label>
										<div class="col-sm-8">
											<div class="input_box"><?php  echo get_product_category_select_edit(array('pro_cate_status'=>'A'),$records['product_category_id']."~".$records['product_subcategory_id'], '  class="search_select required" id="prod_category" onchange="get_attribute_enabled()" ','pro_cate_id');?></div>
										</div>
									</div>
									<div id="category_div"></div>
									
									<div class="form-group  associate_product_tab" <?php if($records['product_type'] !='attribute') { ?>style="display:none" <?php } ?>>
										<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('category_modifier').add_tooltip('modifier_enabled');?></label>
										<div class="col-sm-8"><div class="input_box modi_div"><?php  echo get_product_modifier(array('pro_modifier_status' => 'A','pro_modifier_category_id'=>$records['product_category_id']),$assigned_modifiers,'class="form-control search_select " onchange="get_attribute_enabled()" id="product_modifier" ',' multiple="multiple" data-placeholder="'.get_label('product_modifier_select').'" ','pro_modifier_id');?></div></div>
									</div>
								</div>
								
								
								<!-- tab3 -->
								<div aria-labelledby="dropdown1-tab" id="stepv3"
									class="tab-pane fade " role="tabpanel">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('product_price').get_required().add_tooltip('product_price');?></label>
											<div class="col-sm-8">
												<div class="input_box">
													<input type="number"
														title="<?php echo sprintf(get_label('product_errors'),get_label('product_price')); ?>"
														value="<?php echo output_integer($records['product_price']);?>"
														class="form-control required" name="product_price"
														onkeypress="return isFloat(event)" id="product_price">
												</div>
											</div>
										</div>
										
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('product_spl_price').add_tooltip('product_spl_price');?></label>
											<div class="col-sm-8"><div class="input_box"><input type="number"  value="<?php echo  output_integer($records['product_special_price']);?>" class="form-control " name="product_spl_price" onkeypress="return isFloat(event)"  id="product_spl_price"> </div></div>
										</div>
															
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('product_spl_price_from').add_tooltip('product_spl_price_from');?></label>
											<div class="col-sm-8"><div class="input_box">
												<input type="text"  value="<?php echo ($records['product_special_price_from_date'] !='' && $records['product_special_price_from_date'] !="NULL" && $records['product_special_price_from_date'] != '0000-00-00 00:00:00' && $records['product_special_price_from_date'] != '1970-01-01')?stripslashes(date('d-m-Y',strtotime($records['product_special_price_from_date']))):"";?>" class="form-control datepickerchange1 valid" name="product_spl_price_from" id="product_spl_price_from" onkeypress="return isFloat(event)" >
											</div></div>
											<!--output_date( $records['product_special_price_from_date']) -->
											<!--div class="col-sm-8"><div class="input_box"><?php  echo form_input('product_spl_price_from',($records['product_special_price_from_date'] !='' && $records['product_special_price_from_date'] !="NULL" && $records['product_special_price_from_date'] != '0000-00-00 00:00:00' )?stripslashes(date('d-m-Y',strtotime($records['product_special_price_from_date']))):"",' class="form-control datepickerchange1 required"  ','onkeypress="return isFloat(event)"');?></div></div-->					
										</div>
															
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('product_spl_price_to').add_tooltip('product_spl_price_to');?></label>
											<div class="col-sm-8"><div class="input_box">
											<input type="text"  value="<?php echo ($records['product_special_price_to_date'] !='' && $records['product_special_price_to_date'] !="NULL" && $records['product_special_price_to_date'] != '0000-00-00 00:00:00' && $records['product_special_price_to_date'] != '1970-01-01' )?stripslashes(date('d-m-Y',strtotime($records['product_special_price_to_date']))):"" ;?>" class="form-control datepickerchange2 valid" name="product_spl_price_to" id="product_spl_price_to" onkeypress="return isFloat(event)" >
											</div></div>
											<!--div class="col-sm-8"><div class="input_box"><?php  echo form_input('product_spl_price_to',($records['product_special_price_to_date'] !='' && $records['product_special_price_to_date'] !="NULL" && $records['product_special_price_to_date'] != '0000-00-00 00:00:00' )?stripslashes(date('d-m-Y',strtotime($records['product_special_price_to_date']))):"",' class="form-control datepickerchange2 required"  ','onkeypress="return isFloat(event)"');?></div></div-->					
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
											<?php if(!empty($assigned_shipping)) { 
												foreach($assigned_shipping as $shipping) {
											?>
											<tr class="shipping-item" >
												<td>
													<select class="form-control" name="ProductShipping[prod_ass_ship_method_shipid][]">
														<option value="">Select Shipping Method</option>
														<?php foreach($shipping_methods_list as $shippingmethod) {  ?>
														<option <?php if($shipping['prod_ass_ship_method_shipid'] == $shippingmethod['ship_method_id']) { echo "selected='selected'"; } ?>value="<?php echo $shippingmethod['ship_method_id']; ?>"><?php echo $shippingmethod['ship_method_name']; ?></option>
														<?php } ?>
													</select>
												</td>
												<td>
													<input class="form-control input" name="ProductShipping[prod_ass_ship_method_price][]" type="text" value="<?php echo $shipping['prod_ass_ship_method_price']; ?>">
												</td>
												<td>
													<input name="ProductShipping[prod_ass_ship_method_uncheck][0]" value="0" class="shipping_free_unassign" type="hidden">
													<label>
														<input class="display shipping_free_assign" name="ProductShipping[prod_ass_ship_method_is_combined][0]" value="1" type="checkbox" <?php if($shipping['prod_ass_ship_method_is_combined'] == 1) { echo "checked='checked'"; } ?>> 
														Is Combined
													</label>
												</td>
												<td class="text-center vcenter" style="width: 90px; verti">
													<button type="button" class="remove-shipping btn btn-danger btn-xs"><span class="fa fa-minus"></span></button>
												</td>
											</tr>
											<?php } } ?>
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
												<div class="custom_browsefile"> <?php echo form_upload('product_thumbnail');?> <span
														class="result_browsefile"><span class="brows"></span> + <?php echo get_label('product_thumbnail');?></span>
												</div>
											</div>
										</div>
									</div>
																												
									<?php if($records['product_thumbnail']){ ?>
									 <div class="form-group show_image_box">
										<div class="col-sm-offset-2 col-xs-10 col-md-10 ">
											<a class="thumbnail" href="javascript:;"
												title="<?php echo get_label('remove_image_title');?>"> <img
												class="img-responsive common_delete_image"
												style="width: 250px; height: 250px;"
												src="<?php echo media_url().get_company_folder()."/". $this->lang->line('product_main_image_folder_name')."/".$records['product_thumbnail'];?>">
											</a>
										</div>
									</div>
									<?php } ?>
															
									<div class="form-group multi_field">
										<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('product_gallery');?></label>
										<div class="col-sm-8 ">
											<div class="input_box">
												<div class="custom_browsefile"> <?php echo form_upload('product_gallery[]');?> <span
														class="result_browsefile"><span class="brows"></span> + <?php echo get_label('product_gallery');?></span>
												</div>
											</div>
											<span class="hint"><?php echo "* ". get_label('product_max_image_count');?></span>
										</div>
										<div class="col-sm-2 ">
											<span class="more_link add_field_button fa fa-plus"></span>
										</div>


									</div>
									<?php if(!empty($gallery_images)) { ?>
															
															
									<div class="gallery_images">

										<div class="form-group image_outer ">

											<div class="col-sm-offset-2 col-xs-9 col-md-9 ">
												<div class="gallery_images_flow">
															<?php foreach($gallery_images as $gallery ) { ?>
															 
														<a class="thumbnail gallery_delete"
														id="<?php echo  encode_value($gallery['pro_gallery_primary_id']);?>"
														href="javascript:;"
														title="<?php echo get_label('remove_image_title');?>"> <img
														class="img-responsive "
														style="width: 250px; height: 250px;"
														src="<?php echo media_url().get_company_folder()."/". $this->lang->line('product_gallery_image_folder_name')."/".$gallery['pro_gallery_image'];?>">
													</a>
													
							                         <?php } ?>
                                                                  </div>
											</div>
										</div>
									</div>
															
									<?php } ?>
															
														
                                </div>
 		
                                <!-- tab 5  -->
								<div aria-labelledby="dropdown1-tab" id="stepv5"
									class="tab-pane fade " role="tabpanel">

									<div class="form-group">
										<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('product_meta_title');?></label>
										<div class="col-sm-8">
											<div class="input_box"><?php  echo form_input('product_meta_title',stripslashes($records['product_meta_title']),' class="form-control"  ');?></div>
										</div>
									</div>

									<div class="form-group">
										<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('product_meta_keywords');?></label>
										<div class="col-sm-8">
											<div class="input_box"><?php  echo form_textarea('product_meta_keywords',stripslashes($records['product_meta_keywords']),' class="form-control "  ');?></div>
										</div>
									</div>

									<div class="form-group">
										<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('product_meta_description');?></label>
										<div class="col-sm-8">
											<div class="input_box"><?php  echo form_textarea('product_meta_description',stripslashes($records['product_meta_description']),' class="form-control"  ');?></div>
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
												<?php if(!empty($assigned_products)) {
													foreach($assigned_products as $subproduct) { 
												?>
														<tr class="associates-item">
															<td>
																<div class="form-group field-productassociates-0-product_name">
																	<input name="ProductAssociates[0][product_name][]" class="form-control" id="productassociates-0-product_name" value="<?php echo $subproduct['product_name']; ?>" type="text">
																	<input name="ProductAssociates[0][product_ids][]" class="form-control" id="productassociates-0-product_ids" value="<?php echo $subproduct['product_primary_id']; ?>" type="hidden">
																</div>									
															</td>
															<td>
																<div class="form-group field-productassociates-0-product_sku">
																	<input name="ProductAssociates[0][product_sku][]" class="form-control" id="productassociates-0-product_sku" value="<?php echo $subproduct['product_sku']; ?>" type="text">
																</div>									
															</td>
															<td class="associates_dropdown">
																<?php if(!empty($assigned_modifiers)) { 
																	$sel_ass_att_val = array();
																	if(!empty($assigned_associate_attributes)){
																		foreach($assigned_associate_attributes as $ass_asso_att)
																		{
																			$sel_ass_att_val[$ass_asso_att['prod_ass_att_product_id']][] = $ass_asso_att['prod_ass_att_attribute_value_id'];
																		}
																	}
																	$subprodid= $subproduct['product_primary_id'];
																	foreach($assigned_modifiers as $sel_modifier) { 
																		$assigned_modifier_values = get_modifier_list(array('pro_modifier_value_modifier_id'=>$sel_modifier));

																		if(!empty($assigned_modifier_values)) { 
																?>
																			<select name="ProductAssociates[<?php echo $sel_modifier; ?>][]">
																				<?php 
																				foreach($assigned_modifier_values as $modifiervalue) { ?>
																					<option value="<?php echo $modifiervalue['pro_modifier_value_id']; ?>" <?php if(!empty($sel_ass_att_val[$subprodid]) && in_array($modifiervalue['pro_modifier_value_id'],$sel_ass_att_val[$subprodid])){ echo "selected='selected'"; } ?>><?php echo $modifiervalue['pro_modifier_value_name']; ?></option>
																				<?php 
																				}
																				?>
																			</select>	
																<?php	}
																?>
																		
																<?php }
																} ?>
															</td>
															<td>
																<div class="form-group field-productassociates-0-product_price">
																	<input name="ProductAssociates[0][product_price][]" class="form-control" id="productassociates-0-product_price" value="<?php echo $subproduct['product_price']; ?>" type="text">
																</div>									
															</td>
															<td>
																<div class="form-group field-productassociates-0-product_special_price">
																	<input name="ProductAssociates[0][product_special_price][]" class="form-control" id="productassociates-0-product_special_price" value="<?php echo $subproduct['product_special_price']; ?>" type="text">
																</div>									
															</td>
															<td>
																<div class="form-group field-productassociates-0-product_qty">
																	<input name="ProductAssociates[0][product_qty][]" class="form-control" id="productassociates-0-product_qty" value="<?php echo $subproduct['product_quantity']; ?>" type="text">
																</div>									
															</td>
															<td style="width: 90px; verti" class="text-center vcenter">
																<button class="remove-associates btn btn-danger btn-xs" type="button"><span class="fa fa-minus"></span></button>
															</td>
														</tr>	
												<?php	
													}
												}
												?>
											</tbody>
										</table>
									</div>
								</div>
								

							</div>
						</div>


						<div class="form-group">
							<div
								class="col-sm-offset-5 col-sm-<?php echo get_form_size();?>  btn_submit_div">
								<button type="submit" class="btn btn-primary " name="submit"
									value="Submit"><?php echo get_label('submit');?></button>
								<a class="btn btn-info" href="<?php echo admin_url().$module;?>"><?php echo get_label('cancel');?></a>
							</div>
						</div>





					</div>

					<input type="hidden" id="form_action" value="edit_from"> <input
						type="hidden" value="" name="remove_image" id="remove_image">
					<?php
					echo form_hidden ( 'edit_id', $records ['product_primary_id'] );
					echo form_hidden ( 'action', 'edit' );
					echo form_close ();
					?>
			</div>
			</div>
		</div>
	</div>

