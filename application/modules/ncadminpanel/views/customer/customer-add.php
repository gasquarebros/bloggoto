<script type="text/javascript" src="<?php echo load_lib()?>bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
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
                                <a  href="<?php echo admin_url().$module;?>" class="btn btn-info"><?php echo get_label('back');?></a>
                            </div>
                        </div>
                        
                        
					</div>

					<div class="card-body">
					<ul class=" alert_msg  alert-danger  alert container_alert" style="display: none;">
					
					</ul>	          
                <?php echo form_open_multipart(admin_url().$module.'/add',' class="form-horizontal" id="common_form" ' );?>
                         <div class="form-group">
							<label for="customer_first_name" class="col-sm-2 control-label"><?php echo get_label('customer_first_name').get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('customer_first_name',set_value('customer_first_name'),' class="form-control required"  ');?></div></div>
						</div>
						
                         <div class="form-group">
							<label for="customer_last_name" class="col-sm-2 control-label"><?php echo get_label('customer_last_name');?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('customer_last_name',set_value('customer_last_name'),' class="form-control"  ');?></div></div>
						</div>
						 
                         <div class="form-group">
							<label for="customer_email" class="col-sm-2 control-label"><?php echo get_label('customer_email').get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('customer_email',set_value('customer_email'),' class="form-control required email"  ');?></div></div>
						</div>
						
                         <div class="form-group">
							<label for="customer_phone" class="col-sm-2 control-label"><?php echo get_label('customer_phone').get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('customer_phone',set_value('customer_phone'),' class="form-control required number" maxlength="'.get_label('phone_max_length').'"  ');?></div></div>
						</div>
						
                         <div class="form-group">
							<label for="customer_birthdate" class="col-sm-2 control-label"><?php echo get_label('customer_birthdate');?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('customer_birthdate',set_value('customer_birthdate'),' class="form-control datepicker"  ');?></div></div>
						</div>
						
						<div class="form-group">
							<label for="customer_password" class="col-sm-2 control-label"><?php echo get_label('customer_password').get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_password('customer_password',set_value('customer_password'),' class="form-control required" minlength="'.get_label('customer_password_minlength').'"  id="customer_password" ');?></div></div>
						</div>
						<?php /*
						<div class="form-group">
							<label for="customer_address_name" class="col-sm-2 control-label"><?php echo get_label('customer_address_name');?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('customer_address_name',set_value('customer_address_name'),' class="form-control"  ');?></div></div>
						</div>
						
						<div class="form-group">
							<label for="customer_address_name2" class="col-sm-2 control-label"><?php echo get_label('customer_address_name2');?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('customer_address_name2',set_value('customer_address_name2'),' class="form-control"  ');?></div></div>
						</div>
						
						<div class="form-group">
							<label for="customer_address_line1" class="col-sm-2 control-label"><?php echo get_label('customer_address_line1');?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('customer_address_line1',set_value('customer_address_line1'),' class="form-control"  ');?></div></div>
						</div>
						
						<div class="form-group">
							<label for="customer_address_line1" class="col-sm-2 control-label"><?php echo get_label('customer_address_line2');?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('customer_address_line2',set_value('customer_address_line2'),' class="form-control"  ');?></div></div>
						</div>
						*/ ?>
						<div class="form-group">
							<label for="customer_city" class="col-sm-2 control-label"><?php echo get_label('customer_city');?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('customer_city',set_value('customer_city'),' class="form-control"  ');?></div></div>
						</div>
						
						<div class="form-group">
							<label for="customer_state" class="col-sm-2 control-label"><?php echo get_label('customer_state');?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('customer_state',set_value('customer_state'),' class="form-control"  ');?></div></div>
						</div>
						
						<div class="form-group">
							<label for="customer_country" class="col-sm-2 control-label"><?php echo get_label('customer_country');?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php echo get_all_countries(); ?></div></div>
						</div> 
						
						
						<div class="form-group">
							<label for="customer_postal_code" class="col-sm-2 control-label"><?php echo get_label('customer_postal_code').get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('customer_postal_code',set_value('customer_postal_code'),' class="form-control required number" maxlength="'.get_label('postal_code_max_length').'"  ');?></div></div>
						</div>
						<?php /*
						<div class="form-group">
							<label for="customer_company_name" class="col-sm-2 control-label"><?php echo get_label('customer_company_name');?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('customer_company_name',set_value('customer_company_name'),' class="form-control"  ');?></div></div>
						</div>
						
						<div class="form-group">
							<label for="customer_company_address" class="col-sm-2 control-label"><?php echo get_label('customer_company_address');?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_textarea('customer_company_address',set_value('customer_company_address'),' class="form-control"  ');?></div></div>
						</div>
						
						<div class="form-group">
							<label for="customer_company_phone" class="col-sm-2 control-label"><?php echo get_label('customer_company_phone');?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('customer_company_phone',set_value('customer_company_phone'),' class="form-control number"  maxlength="'.get_label('phone_max_length').'" ');?></div></div>
						</div>
						*/ ?>
						<div class="form-group">
							<label for="customer_photo" class="col-sm-2 control-label"><?php echo get_label('customer_photo');?></label>
							<div class="col-sm-4"> <div class="input_box"> <div class="custom_browsefile"> <?php echo form_upload('customer_photo');?> <span class="result_browsefile"><span class="brows"></span>+ <?php echo get_label('upload_image');?></span> </div> </div> </div>
						</div>
						
						<div class="form-group">
							<label for="customer_notes" class="col-sm-2 control-label"><?php echo get_label('customer_notes');?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_textarea('customer_notes',set_value('customer_notes'),' class="form-control"  ');?></div></div>
						</div>
						
						<div class="form-group">
							<label for="customer_hobbies" class="col-sm-2 control-label"><?php echo get_label('customer_hobbies');?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('customer_hobbies',set_value('customer_hobbies'),' class="form-control"');?></div></div>
						</div>
						
						<div class="form-group">
							<label for="customer_maritial_status" class="col-sm-2 control-label"><?php echo get_label('customer_maritial_status');?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_dropdown('customer_maritial_status',array(''=>'Select Martial Status','single'=>'Single','married'=>'Married','divorced'=>'Divorced','widowed'=>'Widowed'),'','class="form-control" id="customer_maritial_status"' );?></div></div>
						</div>

						<div class="form-group">
							<label for="customer_facebook_link" class="col-sm-2 control-label"><?php echo get_label('customer_facebook_link');?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('customer_facebook_link',set_value('customer_facebook_link'),' class="form-control"');?></div></div>
						</div>
						
						<div class="form-group">
							<label for="customer_instagram_link" class="col-sm-2 control-label"><?php echo get_label('customer_instagram_link');?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('customer_instagram_link',set_value('customer_instagram_link'),' class="form-control"');?></div></div>
						</div>
						<div class="form-group">
							<label for="customer_twitter_link" class="col-sm-2 control-label"><?php echo get_label('customer_twitter_link');?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('customer_twitter_link',set_value('customer_twitter_link'),' class="form-control"');?></div></div>
						</div>
						
						<div class="form-group">
							<label for="customer_youtube_link" class="col-sm-2 control-label"><?php echo get_label('customer_youtube_link');?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('customer_youtube_link',set_value('customer_youtube_link'),' class="form-control"');?></div></div>
						</div>
						
						<div class="favourite">
							<div class="row form-group">
								<label class="col-sm-4 control-label">Customer Favourites:</label>
							</div>
							<div class="form-group">
								<label for="customer_fav_color" class="col-sm-2 control-label"><?php echo get_label('customer_fav_color');?></label>
								<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('customer_fav_color',set_value('customer_fav_color'),' class="form-control"');?></div></div>
							</div>
							
							<div class="form-group">
								<label for="customer_fav_brand" class="col-sm-2 control-label"><?php echo get_label('customer_fav_brand');?></label>
								<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('customer_fav_brand',set_value('customer_fav_brand'),' class="form-control"');?></div></div>
							</div>
							
							<div class="form-group">
								<label for="customer_fav_place" class="col-sm-2 control-label"><?php echo get_label('customer_fav_place');?></label>
								<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('customer_fav_place',set_value('customer_fav_place'),' class="form-control"');?></div></div>
							</div>
							
							<div class="form-group">
								<label for="customer_fav_celebrates" class="col-sm-2 control-label"><?php echo get_label('customer_fav_celebrates');?></label>
								<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('customer_fav_celebrates',set_value('customer_fav_celebrates'),' class="form-control"');?></div></div>
							</div>
							
							<div class="form-group">
								<label for="customer_fav_sports" class="col-sm-2 control-label"><?php echo get_label('customer_fav_sports');?></label>
								<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('customer_fav_sports',set_value('customer_fav_sports'),' class="form-control"');?></div></div>
							</div>
							
							<div class="form-group">
								<label for="customer_fav_movie" class="col-sm-2 control-label"><?php echo get_label('customer_fav_movie');?></label>
								<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('customer_fav_movie',set_value('customer_fav_movie'),' class="form-control"');?></div></div>
							</div>
							
							<div class="form-group">
								<label for="customer_fav_food" class="col-sm-2 control-label"><?php echo get_label('customer_fav_food');?></label>
								<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('customer_fav_food',set_value('customer_fav_food'),' class="form-control"');?></div></div>
							</div>
							
							<div class="form-group">
								<label for="customer_fav_music" class="col-sm-2 control-label"><?php echo get_label('customer_fav_music');?></label>
								<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('customer_fav_music',set_value('customer_fav_music'),' class="form-control"');?></div></div>
							</div>
							
							<div class="form-group">
								<label for="customer_fav_book" class="col-sm-2 control-label"><?php echo get_label('customer_fav_book');?></label>
								<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('customer_fav_book',set_value('customer_fav_book'),' class="form-control"');?></div></div>
							</div>
							
							<div class="form-group">
								<label for="customer_fav_author" class="col-sm-2 control-label"><?php echo get_label('customer_fav_author');?></label>
								<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('customer_fav_author',set_value('customer_fav_author'),' class="form-control"');?></div></div>
							</div>
							
							<div class="form-group">
								<label for="customer_fav_drink" class="col-sm-2 control-label"><?php echo get_label('customer_fav_drink');?></label>
								<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('customer_fav_drink',set_value('customer_fav_drink'),' class="form-control"');?></div></div>
							</div>
							
							<div class="form-group">
								<label for="customer_fav_things" class="col-sm-2 control-label"><?php echo get_label('customer_fav_things');?></label>
								<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('customer_fav_things',set_value('customer_fav_things'),' class="form-control"');?></div></div>
							</div>
						</div>
						
						<div class="Professional">
							<div class="row form-group">
								<label class="col-sm-4 control-label">Customer Professional:</label>
							</div>
							<div class="form-group">
								<label for="customer_prof_school" class="col-sm-2 control-label"><?php echo get_label('customer_prof_school');?></label>
								<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('customer_prof_school',set_value('customer_prof_school'),' class="form-control"');?></div></div>
							</div>
							
							<div class="form-group">
								<label for="customer_prof_college" class="col-sm-2 control-label"><?php echo get_label('customer_prof_college');?></label>
								<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('customer_prof_college',set_value('customer_prof_college'),' class="form-control"');?></div></div>
							</div>
							
							<div class="form-group">
								<label for="customer_prof_work" class="col-sm-2 control-label"><?php echo get_label('customer_prof_work');?></label>
								<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('customer_prof_work',set_value('customer_prof_work'),' class="form-control"');?></div></div>
							</div>
							
							<div class="form-group">
								<label for="customer_prof_profession" class="col-sm-2 control-label"><?php echo get_label('customer_prof_profession');?></label>
								<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('customer_prof_profession',set_value('customer_prof_profession'),' class="form-control"');?></div></div>
							</div>
							
							<div class="form-group">
								<label for="customer_prof_official_website" class="col-sm-2 control-label"><?php echo get_label('customer_prof_official_website');?></label>
								<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('customer_prof_official_website',set_value('customer_prof_official_website'),' class="form-control"');?></div></div>
							</div>
							
							<div class="form-group">
								<label for="customer_prof_official_email" class="col-sm-2 control-label"><?php echo get_label('customer_prof_official_email');?></label>
								<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('customer_prof_official_email',set_value('customer_prof_official_email'),' class="form-control"');?></div></div>
							</div>
							
							<div class="form-group">
								<label for="customer_prof_official_phone" class="col-sm-2 control-label"><?php echo get_label('customer_prof_official_phone');?></label>
								<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('customer_prof_official_phone',set_value('customer_prof_official_phone'),' class="form-control"');?></div></div>
							</div>
							
							<div class="form-group">
								<label for="customer_prof_specialized" class="col-sm-2 control-label"><?php echo get_label('customer_prof_specialized');?></label>
								<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('customer_prof_specialized',set_value('customer_prof_specialized'),' class="form-control"');?></div></div>
							</div>
							
							<div class="form-group">
								<label for="customer_prof_types" class="col-sm-2 control-label"><?php echo get_label('customer_prof_types');?></label>
								<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('customer_prof_types',set_value('customer_prof_types'),' class="form-control"');?></div></div>
							</div>
							
							<div class="form-group">
								<label for="customer_prof_rewards" class="col-sm-2 control-label"><?php echo get_label('customer_prof_rewards');?></label>
								<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('customer_prof_rewards',set_value('customer_prof_rewards'),' class="form-control"');?></div></div>
							</div>
							<div class="form-group">
								<label for="customer_type" class="col-sm-2 control-label"><?php echo get_label('customer_type');?></label>
								<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php echo form_dropdown('customer_type',array(''=>'Select Customer Type','0'=>'Writer','1'=>'Brand'),'','class="form-control" id="customer_type"' ); ?></div></div>
							</div>
							
						</div>
						
						
						<div class="form-group">
							<label for="status" class="col-sm-2 control-label"><?php echo get_label('status').get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo get_status_dropdown('A','','class="required" style="width:374px;" ');?></div></div>
						</div>


                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-<?php echo get_form_size();?>  btn_submit_div">
                                <button type="submit" class="btn btn-primary " name="submit"
                                    value="Submit"><?php echo get_label('submit');?></button>
                                <a class="btn btn-info" href="<?php echo camp_url().$module;?>"><?php echo get_label('cancel');?></a>
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
