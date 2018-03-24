<link href="<?php echo load_lib()?>bootstrap-datepicker/css/bootstrap-datetimepicker.css" rel="stylesheet">
<link rel="stylesheet" href="<?php echo load_lib()?>timepicker-master/jquery-ui-1.10.0.custom.min.css" type="text/css" />
<link rel="stylesheet" href="<?php echo load_lib()?>timepicker-master/jquery.ui.timepicker.css" type="text/css" />
<script type="text/javascript" src="<?php echo load_lib()?>timepicker-master/jquery.ui.core.min.js"></script>
<script type="text/javascript" src="<?php echo load_lib()?>timepicker-master/jquery.ui.timepicker.js"></script>
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
								
								<li role="step" class=""><a aria-expanded="false"
									aria-controls="home" data-toggle="tab" role="tab"
									id="step9-vtab" href="#stepv9">
										<div class="icon fa fa-dollar"></div>
										<div class="step-title">
											<div class="title"><?php echo get_label('product_tab9').get_required();?></div>

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
									data-toggle="tab" id="step6-vtab" role="tab" href="#stepv6"
									aria-expanded="true">
										<div class="icon fa fa-tags"></div>
										<div class="step-title">
											<div class="title"><?php echo get_label('product_tab6');?></div>
											<div class="description"></div>
										</div>
								</a></li> 
                            </ul>
							<div class="tab-content">
								<!-- tab1  -->
								<div aria-labelledby="home-tab" id="stepv1" class="tab-pane fade active in " role="tabpanel">

				
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
											<div class="input_box"><?php  echo form_textarea('product_long_description',set_value('product_long_description'),' class="form-control" title="'.sprintf(get_label('product_errors'),get_label('product_long_description')).'"   ');?></div>
										</div>
									</div>

									
									
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('product_sku').get_required();?></label>
										<div class="col-sm-8">
											<div class="input_box"><?php  echo form_input('product_sku',set_value('product_sku'),' class="form-control required"   title="'.sprintf(get_label('product_errors'),get_label('product_sku')).'"  ');?></div>
										</div>
									</div>

									<div class="form-group">
										<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('product_sequence');?></label>
										<div class="col-sm-8">
											<div class="input_box">
												<input type="number" value="" class="form-control "
													name="product_sequence" id="product_sequence"
													onkeypress="return isNumber(event)">

											</div>
										</div>
									</div>
									
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('product_customer').get_required();?></label>
										<div class="col-sm-8">
											<div class="input_box"><?php  echo form_dropdown('product_customer_id',$all_users,set_value('product_customer_id'),'class="required"    title="'.sprintf(get_label('product_errors'),get_label('product_customer')).'"  ');?></div>
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
								
								<!-- tab 9  -->
								<div aria-labelledby="dropdown1-tab" id="stepv9"
									class="tab-pane fade " role="tabpanel">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('product_cost').add_tooltip('product_cost');?> </label>
											<div class="col-sm-8">
												<div class="input_box">
													<input type="number" value="" class="form-control   "
														name="product_cost" id="product_cost"
														onkeypress="return isFloat(event)">
												</div>
											</div>
										</div>

										<div class="form-group">
											<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('product_price').get_required().add_tooltip('product_price');?></label>
											<div class="col-sm-8">
												<div class="input_box">
													<input type="number" value="" class="form-control required"
														title="<?php echo sprintf(get_label('product_errors'),get_label('product_price')); ?>"
														name="product_price" onkeypress="return isFloat(event)"
														id="product_price">
												</div>
											</div>
										</div>
										
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('product_spl_price').add_tooltip('product_spl_price');?></label>
											<div class="col-sm-8">
												<div class="input_box">
													<input type="number" value="" class="form-control "
														name="product_spl_price" onkeypress="return isFloat(event)"
														id="product_spl_price">
												</div>
											</div>
										</div>

										<div class="form-group">
											<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('product_spl_price_from').add_tooltip('product_spl_price_from');?></label>
											<div class="col-sm-8">
												<div class="input_box">
													<input type="text" value=""
														class="form-control datepickerchange1 "
														name="product_spl_price_from" id="product_spl_price_from"
														onkeypress="return isFloat(event)">
												</div>
											</div>
										</div>

										<div class="form-group">
											<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('product_spl_price_to').add_tooltip('product_spl_price_to');?></label>
											<div class="col-sm-8">
												<div class="input_box">
													<input type="text" value=""
														class="form-control datepickerchange2 "
														name="product_spl_price_to" id="product_spl_price_to"
														onkeypress="return isFloat(event)">
												</div>
											</div>
										</div> 
								</div>
								
								
								
								<!-- tab2  -->
								<div aria-labelledby="profile-tab" id="stepv2"
									class="tab-pane fade " role="tabpanel">

															
                                    <div class="form-group" id="">
										<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('product_categorie').get_required().add_tooltip('product_categorie');?></label>
										<div class="col-sm-8">
											<div class="input_box"><?php  echo get_product_category(array('pro_cate_status'=>'A'),'', '  class="search_select required" id="product_category" ','pro_cate_id');?></div>
										</div>
									</div>
									<div id="category_div"></div>

									
									<!------------------------ catring available ------------------------>
                                </div>


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
											<span class="add_field_button fa fa-plus  more_link"></span>
										</div>
									</div>

								</div>


								
								<!-- tab 6  -->
								<div aria-labelledby="dropdown1-tab" id="stepv6"
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


							</div>
						</div>


						<div  class="form-group">
							<div
								class="col-sm-offset-6 col-sm-<?php echo get_form_size();?>  btn_submit_div">
								<button type="submit" class="btn btn-primary " name="submit"
									value="Submit"><?php echo get_label('submit');?></button>
								<a class="btn btn-info" href="<?php echo camp_url().$module;?>"><?php echo get_label('cancel');?></a>
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
