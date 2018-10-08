<style>
/*shipping address start*/
.progress_bar{margin-bottom:35px;}
/*.progress_bar ul{padding:0px;position: relative;}*/
.progress_bar ul{padding: 0px;position: relative;font-size: 0;text-align: center;}
.progress_bar ul:after{clear: both;display: block;content:'';}
.progress_bar ul li{list-style: none; /*float: left;*/display: inline-block;width:25%; text-align: center;position:relative;}
.progress_bar ul:before{width: 100%;height: 6px;background: #eeeeee;position: absolute;left: 0;right: 0;bottom: 30px;content: '';z-index: 1;}
.progress_bar ul li a, .progress_bar ul li span{display: block;}
.progress_bar ul li span{width:70px;height: 70px;margin:15px auto 0;line-height: 70px;background: #eeeeee;border-radius: 3px;
	-webkit-border-radius:3px;    position: relative; transition: all 0.6s ease; -webkit-transition: all 0.6s ease;border:1px solid transparent;}
.progress_bar ul li span .lazy{position: absolute;left: 0;top: 0;right: 0;bottom: 0;margin: auto;}
.progress_bar ul li span .alternate{top: 0;bottom: 0px;}
.progress_bar ul li a:hover span, .progress_bar ul li.active a span{border:1px solid #f39125;}
.progress_bar ul li a {color: #909090;font-family: 'proxima_nova_rgbold';text-transform: uppercase;position: relative;z-index:2;    font-size: 16px;}
.progress_bar ul li a:hover, .progress_bar ul li.active a{color:#3b3b3b;}
.progress_bar ul li:hover .alternate, .progress_bar ul li.active .alternate,
.progress_bar > li > a.active .alternate { opacity:1;}

.ship_add_full{padding:35px;background:#fff;}
.ship_add_full h3{color:#3b3b3b; text-transform: inherit; margin-bottom: 30px;}
.ship_add{margin-bottom:30px;}
.address_list{padding:0;position: relative;}
.address_list:after{clear: both;display: block;content: '';}
.address_list li{ list-style: none;float: left;width: 48%;margin-bottom: 4%;     border: 2px solid transparent;}
.address_list li.active{border: 2px solid #fe9b1a;}
.address_list li:nth-child(even){float:right;}

.address_list .address {background: #eeeeee;border-radius: 3px;-webkit-border-radius: 3px;position: relative;}
.address_list .address.add{background:transparent;}
.address_list .address h6 {color: #3b3b3b;text-transform: inherit;font-size: 17px;border-bottom: 1px solid #d4d4d4;
	margin-bottom: 0;padding:20px 185px 19px 90px; position: relative; min-height: 60px; overflow: hidden; white-space: nowrap;text-overflow: ellipsis;}
.address_list .address h6:before {background: url(../images/full_sprite.png) no-repeat scroll -191px -312px transparent;width: 41px;height: 41px;content: ''; position: absolute;left: 30px;top: 8px;}
.address_list .address .description {font:16px/26px 'proxima_nova_rgregular';color: #3b3b3b;padding: 24px 30px;}

.address_list .address .three-icons{position: absolute;right:0;top:0; font-size:0;}
.address_list .address .edit_icon{ width:60px; height:60px; line-height:60px; border-left: 1px solid #d4d4d4;  background:url(../images/full_sprite.png) no-repeat scroll -180px -365px transparent; display:inline-block;}
.address_list .address .edit_icon:hover{background:url(../images/full_sprite.png) no-repeat scroll -240px -365px transparent;}

.address_list .address .delete_icon {background:url(../images/full_sprite.png) no-repeat scroll -442px -193px transparent;}
.address_list .address .delete_icon:hover{background: url(../images/full_sprite.png) no-repeat scroll -391px -193px transparent;}

.address_list .address .delivery_icon{background:url(../images/full_sprite.png) no-repeat scroll -445px -250px transparent;}
.address_list .address .delivery_icon:hover{background:url(../images/full_sprite.png) no-repeat scroll -394px -250px transparent;}


.address_list .address .address_inner{border:2px dashed #cdcdcd; min-height:180px;}
.address_list .address .address_inner .add_address{color: #909090;position: relative;display: block; /*height: 180px;*/ font:19px 'proxima_nova_rgbold';text-transform: uppercase; cursor:pointer}
.address_list .address .address_inner .add_address:hover{color:#2a2a2a;}
.address_list .address .address_inner .add_address:before {background: url(../images/full_sprite.png) no-repeat scroll -412px -89px transparent;width: 64px;height: 64px;content: '';
position: relative;top: 30px;display: block;margin: auto;margin-bottom: 50px;}
.address_list .address .address_inner .add_address:hover:before{background: url(../images/full_sprite.png) no-repeat scroll -412px -1px transparent;}
.address_list .address .address_inner{-webkit-transform: rotateX(0);-moz-transform: rotateX(0);-o-transform: rotateX(0);-ms-transform: rotateX(0);transform: rotateX(0);-webkit-backface-visibility: hidden;-moz-backface-visibility: hidden;-ms-backface-visibility: hidden;backface-visibility: hidden;-webkit-transition: all .4s linear;-moz-transition: all .4s linear;-o-transition: all .4s linear;-ms-transition: all .4s linear;
transition: all .4s linear;}
.address_list .address.edit_address .address_inner {-webkit-transform: rotateY(180deg);-moz-transform: rotateY(180deg);-o-transform: rotateY(180deg);-ms-transform: rotateY(180deg);transform: rotateY(180deg);}
.address_list .address .address_form{min-height: 375px;position: absolute;z-index: 100;top: 0;left: 0;background-color: #efefef;-webkit-border-radius: 2px;border-radius: 2px;border: 1px solid #ccc;-webkit-box-shadow: 0 5px 25px rgba(0,0,0,.2);box-shadow: 0 5px 25px rgba(0,0,0,.2);
display:none;max-width: 1140px;}
.address_list .address:nth-child(even) .address_form {left: -110%;right: 0;}
.address_list .address:nth-child(odd) .address_form {left:0;right: -110%;}
.address_list .address .address_form {display: block;-webkit-transform: rotateY(-180deg) scale(.3,.8);-moz-transform: rotateY(-180deg) scale(.3,.8);-o-transform: rotateY(-180deg) scale(.3,.8);-ms-transform: rotateY(-180deg) scale(.3,.8);transform: rotateY(-180deg) scale(.3,.8);
-webkit-backface-visibility: hidden;-moz-backface-visibility: hidden;-ms-backface-visibility: hidden;backface-visibility: hidden;
opacity: 0;filter: alpha(opacity=0);-ms-filter: "alpha(Opacity=0)";-webkit-transition: all .4s linear;-moz-transition: all .4s linear;
-o-transition: all .4s linear;-ms-transition: all .4s linear;transition: all .4s linear;}
.address_list .address.edit_address .address_form {opacity: 1;-ms-filter: none;filter: none;-webkit-transform: rotateY(0) scale(1);-moz-transform: rotateY(0) scale(1);-o-transform: rotateY(0) scale(1);-ms-transform: rotateY(0) scale(1);transform: rotateY(0) scale(1);}
.ship_add .address_list .address{background:transparent;}
.ship_add .address_list .address .address_one_inner{background: #eeeeee;}
.ship_add .address .address_one_inner{-webkit-transform: rotateX(0);-moz-transform: rotateX(0);-o-transform: rotateX(0);-ms-transform: rotateX(0); transform: rotateX(0);-webkit-backface-visibility: hidden;-moz-backface-visibility: hidden;-ms-backface-visibility: hidden;backface-visibility: hidden;-webkit-transition: all .4s linear;-moz-transition: all .4s linear;-o-transition: all .4s linear;-ms-transition: all .4s linear;transition: all .4s linear;}
.ship_add .address.ship_edit .address_one_inner{-webkit-transform: rotateY(180deg);-moz-transform: rotateY(180deg);-o-transform: rotateY(180deg);-ms-transform: rotateY(180deg);transform: rotateY(180deg);}
.close_icon{position: absolute;right: 0;top: 0;width: 30px;height: 30px;line-height: 30px;text-align: center;color: #fff;background: #2a2a2a;font-size: 13px;display:inline-block;cursor: pointer;}
.close_icon:hover{background:#fe9b1a;}

.delivery_address input[type="button"]{margin-top: 15px; white-space: normal; height: auto; padding: 10px 16px;}
.delivery_address .delivery_add_left .odd, .delivery_address .delivery_add_left .even{float: left; width:48.5%;}
.delivery_address .delivery_add_left .even{float:right;}

.delivery_address{position: relative;}
.delivery_address .delivery_add_left {width: 51.30890052356021%;padding: 30px 20px 20px 20px; /*min-height: 350px;*/position: relative;}
.delivery_address .title {position: relative;font-size: 24px;color: #3a3a3a;padding-left: 50px;min-height:28px;}
.delivery_address .title span {font:20px 'proxima_novasemibold';background: #fe9b1a;width: 35px;height: 35px;position: absolute;
left: 0;content: '';text-align: center;line-height: 35px;color: #fff;border-radius: 50%;-webkit-border-radius: 50%; top: -7px;}
.delivery_address .delivery_add_left form{}
.delivery_address form .form-field{}
.delivery_address form .form-field .odd{width:48%;}
.delivery_address form .form-field .even{float:right;}
.delivery_address form label {font:13px 'proxima_novasemibold'; display: block; margin-bottom:5px;}
.delivery_address form input[type="text"]{}
.delivery_address form input[type="submit"]{border-radius: 3px; -webkit-border-radius: 3px; margin-top: 20px; /*position: absolute;right: 20px;bottom: 20px;*/}
.delivery_address .delivery_add_right{width:48.69109947643979%;}
.delivery_add_two{padding:30px;}
.delivery_add_two .require{ color: red;}
.delivery_add_two .form-field-left{ width: 48%; float: left;}
.delivery_add_two .form-field-right{ width: 48%; float: right;}
.delivery_add_two .form-field-right textarea{ height: 110px;}
.delivery_add_two .form-field-right .form-field label{ text-transform: uppercase;}
.form_change{ width: 100%; display: inline-block;}
.form_change_inner{ margin: 25px 0 0 0;}
.form_change .form_left{ float: left;}
.form_change .form_left i{ padding-right: 10px; color: ;}
.form_change .form_left span{  color:#787878; font-family: 'proxima_novasemibold'; text-transform: uppercase;}
.form_change .form_right{ float: right;}
.next_but input[type="submit"] {font: 19px 'proxima_novaextrabold';border-radius: 5px;-webkit-border-radius: 5px;padding: 11px 16px;height: auto;min-width: 150px;}

/*shipping address*/
.ship_add_full{padding:35px;background:#fff;}
.ship_add_full h3{color: #3b3b3b;text-transform: inherit;margin-bottom: 40px;font-size: 30px;}
.ship_add_left {background: #eeeeee;border-radius: 3px;-webkit-border-radius: 3px;}
.ship_add_com{float: left; width: 47.34042553191489%;}
.ship_add_com:nth-of-type(even){float:right;}
.ship_add{margin-bottom:30px;}
.ship_add_left{position: relative;}
.ship_add_left h6 {color: #3b3b3b;text-transform: inherit;font-size: 17px;border-bottom: 1px solid #d4d4d4;margin-bottom: 0;padding:20px 65px 19px 90px;position: relative;}
.ship_add_left h6:before {background: url(../images/full_sprite.png) no-repeat scroll -191px -312px transparent;width: 41px;height: 41px;content: '';
position: absolute;left: 30px;top: 8px;}
.ship_add_left .edit_icon{position: absolute;right:0;top:0; width:60px; height:60px; line-height:60px; border-left: 1px solid #d4d4d4; background:url(../images/full_sprite.png) no-repeat scroll -180px -365px transparent;}
.ship_add_left .edit_icon:hover{background:url(../images/full_sprite.png) no-repeat scroll -240px -365px transparent;}
.ship_add_left .description {font: 15px/24px 'proxima_nova_rgregular';color: #3b3b3b;padding: 24px 30px;}
.ship_add_right{border:2px dashed #cdcdcd; min-height:180px;}
.ship_add_right a {color: #909090;position: relative;display: block; /*height: 180px;*/ font:19px 'proxima_nova_rgbold';text-transform: uppercase;}
.ship_add_right a:hover{color:#2a2a2a;}
.ship_add_right a:before {background: url(../images/full_sprite.png) no-repeat scroll -237px -233px transparent;width: 64px;height: 64px;content: '';
position: relative;top: 30px;display: block;margin: auto;margin-bottom: 50px;}
.ship_add_right a:hover:before{background: url(../images/full_sprite.png) no-repeat scroll -237px -157px transparent;}
</style>
<!-- merchant part-->
<div class="inner-main">
	<div class="container">
		<!-- Select your Shipping Address -->
		<div class="ship_add_full">
			<div class="progress_bar">
				<ul>
					<li>
						<a href="javascript:void(0);">
							Profile
							<span>
								<img class="lazy" src="<?php echo skin_url(); ?>/images/profile-icon.png" alt="" />
								<img class="alternate" src="<?php echo skin_url(); ?>/images/profile-icon-hover.png" alt="" />
							</span>
						</a>
					</li>
					<li class="active">
						<a href="javascript:void(0);">
							Shipping address
							<span>
								<img class="lazy" src="<?php echo skin_url(); ?>/images/ship-icon.png" alt="" />
								<img class="alternate" src="<?php echo skin_url(); ?>/images/ship-icon-hover.png" alt="" />
							</span>
						</a>
					</li>
					<li>
						<a href="javascript:void(0);">
							Payment
							<span>
								<img class="lazy" src="<?php echo skin_url(); ?>/images/payment-icon.png" alt="" />
								<img class="alternate" src="<?php echo skin_url(); ?>/images/payment-icon-hover.png" alt="" />
							</span>
						</a>
					</li>
					<li>
						<a href="javascript:void(0);">
							completed
							<span>
								<img class="lazy" src="<?php echo skin_url(); ?>/images/complete-icon.png" alt="" />
								<img class="alternate" src="<?php echo skin_url(); ?>/images/complete-icon-hover.png" alt="" />
							</span>
						</a>
					</li>
				</ul>
			</div>
			<div class="shipping_address my_acc_part">
			<div class="ship_add">
						<h3 class="txtc">Select your Shipping Address</h3>
						<input type="hidden" name="url" id="url" value="<?php echo base_url(); ?>/checkout/shipping">
						<?php if(!empty($form_error)) { 
							foreach($form_error as $formerror) {
								echo "<p class='error'>".$formerror."</p>";
							}
						}
						else if(!empty($error)) { 
							echo "<p class='error'>".$error."</p>";
						}
						?>
						<ul class="address_list">
							<?php
							$is_default = 0;
							if(!empty($shippingaddress)) { 
	
								foreach ($shippingaddress as $address) {
									if($address['is_default']==1) {
										$is_default = $address['address_id'];
									}

									?>
									<li class="address address_one edit  <?=($address['is_default']=='1')?'active':''?>" id="<?=$address['address_id']?>">
										<div class="address_one_inner">
											<h6 class="set_active" id="<?=$address['address_id']?>">
												<?=ucwords($address['first_name'].' '.$address['last_name'])?>
											</h6>
											<div class="three-icons">
													<a href="javascript:void(0);" class="delviery <?=($address['is_default']=='1')?'edit_icon delivery_icon':''?> " title="Set Default" id="<?=$address['address_id']?>"></a>
													<a href="javascript:void(0);" class="edit_icon edit_address"></a>
													<a href="javascript:void(0);" class="edit_icon delete_icon delete_address "id="<?=$address['address_id']?>" title="Delete"></a>
											</div>
											<div class="set_active description" id="<?=$address['address_id']?>">
											<?php /*
												# <?=$address['floor'].'-'.$address['unit'].' '.$address['building_name'].'<br />SINGAPORE '.$address['postal_code']*/?>
												# <?=$address['floor'].'-'.$address['unit'].' '.$address['building_name']?>
											</div>
										</div>
										<div class="ship_edit_icon">
										   <h3> Edit your delivery address</h3>
                                           <?php echo form_open(base_url(),array("class"=>"action_form"));?>
										   <?php //echo "<pre>"; print_r($shippingaddress); exit; ?>
											<ul class="ship_edit_iconinner">
												<li>
													<div class="form-field">
														<?= $form->field($model, 'first_name')->textInput(['maxlength' => 50,'value'=>$address['first_name']]); ?>

													</div>
												</li>
												<li>
													<div class="form-field">
														<?= $form->field($model, 'last_name')->textInput(['maxlength' => 50,'value'=>$address['last_name']]); ?>
													</div>
												</li>
												<li>
													<div class="form-field">
														<?= $form->field($model, 'building_name')->textInput(['maxlength' => 50,'value'=>$address['building_name'],'readonly'=>'readonly']); ?>
													</div>
												</li>
												<li>
													<div class="form-field">
														<?= $form->field($model, 'postal_code')->textInput(['maxlength' => 50,'value'=>$address['postal_code'],'readonly'=>'readonly']); ?>
													</div>
												</li>
												<li>
												   <div class="ship_icon_left_one">
														<div class="form-field">
															<?= $form->field($model, 'floor')->textInput(['maxlength' => 50,'value'=>$address['floor']]); ?>
														</div>
													</div>
													<div class="ship_icon_left_two">
														<div class="form-field">
															<?= $form->field($model, 'unit')->textInput(['maxlength' => 50,'value'=>$address['unit']]); ?>
														</div>
													</div>
												</li>
												<li>
													<div class="form-field">
														<?= $form->field($model, 'company_name')->textInput(['maxlength' => 50,'value'=>$address['company_name']]); ?>
													</div>
												</li>

												<li class="shipping_address">
													<div class="form-field">
														<?= $form->field($model, 'special_info')->textarea(['maxlength' => 50,'value'=>$address['special_info']]); ?>
													</div>
												</li>
												<div class="form_delete">
													<div class="form_delete_inner">
														<div class="form_delete_left">
															<?php /*<span><i class="fa fa-angle-left"></i>Close</span>*/ ?>
														</div>
														<div class="form_deleteright">
															<input type="hidden" name="address_id" value="<?=$address['address_id']?>">
															<input type="hidden" name="action" value="update">
															<input value="save" type="submit">
														</div>
													</div>
												</div>
											</ul>
											<?php echo form_close();?>  
											<span class="close_icon"><i class="fa fa-times" aria-hidden="true"></i></span>
										</div>
									</li>

									<?php
								}
							}
							?>
							<li class="address add">

                            <?php echo form_open(base_url(),array("id"=>'shipping_form',"class"=>"action_form"));?>
								<div class="address_inner txtc">
									<span class="add_address">Add new delivery address</span>
								</div>
								<div class="address_form">
									<div class="delivery_address" >
										<div class="delivery_add_one" >
											<div class="delivery_add_left fl">
												<p class="title"><span class="count">1</span> Add a Delivery Address</p>
													<div class="form-field">
														<label>ENTER YOUR POSTAL CODE</label>
														<input type="text" name="addressSearch" id="addressSearch" class="required">
													</div>
													<div class="form-field required has-error">
														<!-- <label>BUILDING NAME (OPTIONAL)</label> -->
														<input type="text" maxlength="50" name="building_name" value="" class="required">
													</div>
													<div class="form-field required has-error">
														<div class="odd fl">
															<!-- <label>FLOOR <span class="required">*</span></label> -->
                                                            <input type="text" maxlength="50" name="floor" value="" class="required">
															
														</div>
														<div class="odd even fr required has-error">
															<!-- <label>UNIT</label> -->
                                                            <input type="text" maxlength="50" name="unit" value="" class="required">
															
														</div>
														<div class="clear"></div>
													</div>
													<input type="button" value="Select This Address" id="address_next">
											</div>
											<div class="delivery_add_right fr">
												
											</div>
											<span class="close_icon"><i class="fa fa-times" aria-hidden="true"></i></span>
											<div class="clear"></div>
										</div>
										<div class="delivery_add_two" style="display:none;">
											<p class="title"><span class="count">2</span> Just a bit more</p>
											<p>We'll need your name to be able to address you for the delivery.</p>

												<div class="form-field-left fl">
													<div class="form-field">
                                                        <input type="text" maxlength="50" name="first_name" value="" class="required">
														
													</div>
													<div class="form-field">
														<!-- <label>LAST NAME <span class="require">*</span></label> -->
														<input type="text" maxlength="50" name="last_name" value="" class="required">

													</div>
													<div class="form-field">
														<!-- <label>COMPANY NAME (OPTIONAL)</label> -->
                                                        <input type="text" maxlength="50" name="company_name" value="" class="required">
														
													</div>
												</div>
												<div class="form-field-left form-field-right fr">
													<div class="form-field">
														<!-- <label>Address specific instructions (optional)<span class="require">*</span></label> -->
                                                        <textarea name="special_info"></textarea>
													</div>
												</div>
												<div class="form_change">
													<div class="form_change_inner">
														<div class="form_left">
															<span id="initial_address"><i class="fa fa-angle-left"></i>Change address</span>
														</div>
														<div class="form_right">
															<input type="submit" value="save" id="save_address">
															<input type="hidden" name="action" value="create">
														</div>
													</div>
												</div>
												<div class="clear"></div>
											<span class="close_icon"><i class="fa fa-times" aria-hidden="true"></i></span>
										</div>
									</div>
								</div>
								<?php echo form_close();?>  
							</li>
						</ul>

						<div class="clear"></div>
					</div>
					<div class="contact_info">
						<h3>Just for this Order <span>( We require this information )</span></h3>
						<?php echo form_open(base_url(),array("class"=>"action_form"));?>
							<input type="hidden" name="is_default" id="is_default" value="<?=$is_default?>">
							<div class="form-field">
								<div class="label_part fl">
									<label>Contact Number<span class="required">*</span></label>
								</div>
								<div class="input_part fl">
									<div class="input_part_left fl">
									<?php
									$contact_number = '';
									?>
                                        <input type="text" maxlength="50" name="contact_number" value="<?php echo $contact_number; ?>" placeholder='Enter Your Contact Number' class="required">
									</div>
									<div class="input_part_right fr">
										<span class="sidetext"><span class="required">*</span>Just in case we need to call or sms you regarding the delivery</span>
									</div>
								</div>
								<div class="clear"></div>
							</div>

							<div class="form-field">
								<div class="label_part fl">
									<label>Any Special Instructions?</label>
								</div>
								<div class="input_part fl">
									<div class="input_part_left fl">
										<?php $additional_info  = ''; ?>
                                        <textarea placeholder="Message" name="additional_info"><?php echo $additional_info; ?></textarea>             
									</div>
									<div class="input_part_right fr">
										<span class="sidetext">(Optional)</span>
									</div>
								</div>
								<div class="clear"></div>
							</div>
							<p class="txtc next_but" style="margin-bottom:0px;"><input type="submit" value="Next"></p>
                        <?php echo form_close();?>  
					</div>

			</div>
		</div>
	</div>
</div>
<script type="text/javascript" src="<?php echo skin_url(); ?>js/shipping.js"></script>