<?php if($info['customer_id'] == get_user_id()) { if($info['customer_type'] == 0) {  ?>
				<?php echo form_open_multipart(base_url().'myprofile',' class="form-horizontal" id="common_form" ' );?>
					<h3>General</h3>
					<div class="form_field">
						<label>First Name</label>
						<div class="input_field">
							<?php  echo form_input('customer_first_name',stripslashes($info['customer_first_name']),' class="form-control"');?>
						</div>
						<div class="clear"></div>
					</div>
				
					<div class="form_field">
						<label>Last Name</label>
						<div class="input_field">
							<?php  echo form_input('customer_last_name',stripslashes($info['customer_last_name']),' class="form-control"');?>
						</div>
						<div class="clear"></div>
					</div>
				
					<div class="form_field">
						<label>Phone</label>
						<div class="input_field">
							<?php  echo form_input('customer_phone',stripslashes($info['customer_phone']),' class="form-control"');?>
						</div>
						<div class="clear"></div>
					</div>
				
					<div class="form_field">
						<label>Birthday </label>
						<div class="input_field">
							<?php  echo form_input('customer_birthdate',($info['customer_birthdate'] !='' && $info['customer_birthdate'] !='0000-00-00' && $info['customer_birthdate'] != '1970-01-01')?date('d-m-Y',strtotime($info['customer_birthdate'])):'',' class="form-control birthday datepicker"');?>
						</div>
						<div class="clear"></div>
					</div>
				
					<div class="form_field">
						<label>Place Of Country </label>
						<div class="input_field">
							<?php  echo get_all_countries('',$info['customer_country'],'class="form-control" id="customer_country" required="required" onchange="get_state()" '); ?>
						</div>
						<div class="clear"></div>
					</div>
					<div class="form_field">
						<label>Place Of Living</label>
						<div class="input_field state_field">
							<?php  echo get_all_states(array('intCountryId'=>$info['customer_country']),$info['customer_state'],'class="form-control" id="customer_state" onchange="get_city()"'); ?>
						</div>
						<div class="clear"></div>
					</div>
					<div class="form_field">
						<label>Place Of Hometown</label>
						<div class="input_field city_field">
							<?php  echo get_all_cities(array('city_state'=>$info['customer_state']),$info['customer_city'],'class="form-control" id="customer_city"'); ?>
						</div>
						<div class="clear"></div>
					</div>
					<div class="form_field">
						<label>Postal Code</label>
						<div class="input_field">
							<?php  echo form_input('customer_postal_code',stripslashes($info['customer_postal_code']),' class="form-control"');?>
						</div>
						<div class="clear"></div>
					</div>
					<div class="form_field">
						<label>Profession</label>
						<div class="input_field">
						
						
						
							<?php $cust_prof = explode(',',$info['customer_prof_profession']); echo form_dropdown('customer_prof_profession[]',$professions,$cust_prof,'multiple="multiple"'); 
							?>
						</div>
						<div class="clear"></div>
					</div>
					<?php /*
					<div class="form_field">
						<label>Qualification</label>
						<div class="input_field">
							<input type="text" placeholder="BE">
						</div>
						<div class="clear"></div>
					</div> */ ?>
					<div class="form_field">
						<label>Gender</label>
						<div class="input_field">
							<?php  echo form_dropdown('customer_gender',array(''=>'Select Gender','M'=>'Male','F'=>'Female','O'=>'Other'),stripslashes($info['customer_gender']),'class="form-control" id="customer_gender"' );?>
						</div>
						<div class="clear"></div>
					</div>
					<div class="form_field">
						<label>Status</label>
						<div class="input_field">
							<?php  echo form_dropdown('customer_maritial_status',array(''=>'Select Martial Status','single'=>'Single','married'=>'Married','divorced'=>'Divorced','widowed'=>'Widowed'),stripslashes($info['customer_maritial_status']),'class="form-control" id="customer_maritial_status"' );?>
						</div>
						<div class="clear"></div>
					</div>
					<div class="form_field">
						<label for="customer_notes"><?php echo get_label('customer_notes');?></label>
						<div class="input_field"><?php  echo form_textarea('customer_notes',$info['customer_notes'],' class="form-control"  ');?></div>
						<div class="clear"></div>
					</div>
					
					<div class="form_field">
						<label for="customer_photo"><?php echo get_label('customer_photo');?></label>
						<div class="input_field"> <div class="custom_browsefile"> <?php echo form_upload('customer_photo');?> <span class="result_browsefile"><span class="brows"></span>+ <?php echo get_label('upload_image');?></span> </div> </div>
						<div class="clear"></div>
					</div>
					
					<div class="form_field">
						<?php if($info['customer_photo']){ ?>
						<label></label>
						<div class="input_field show_image_box">
							<img class="img-responsive common_delete_image" style="width: 100px; height:100px;"  src="<?php echo media_url(). $this->lang->line('customer_image_folder_name')."/".$info['customer_photo'];?>">
						</div><?php } ?>
						<div class="clear"></div>
					</div>
					
					<h3>Social Media</h3>
					<div class="form_field">
						<label>Facebook Link</label>
						<div class="input_field">
							<?php  echo form_input('customer_facebook_link',stripslashes($info['customer_facebook_link']),' class="form-control"');?>
						</div>
						<div class="clear"></div>
					</div>
					
					<div class="form_field">
						<label>Instagram Link</label>
						<div class="input_field">
							<?php  echo form_input('customer_instagram_link',stripslashes($info['customer_instagram_link']),' class="form-control"');?>
						</div>
						<div class="clear"></div>
					</div>
					
					<div class="form_field">
						<label>Twitter Link</label>
						<div class="input_field">
							<?php  echo form_input('customer_twitter_link',stripslashes($info['customer_twitter_link']),' class="form-control"');?>
						</div>
						<div class="clear"></div>
					</div>
					
					<div class="form_field">
						<label>Youtube Link</label>
						<div class="input_field">
							<?php  echo form_input('customer_youtube_link',stripslashes($info['customer_youtube_link']),' class="form-control"');?>
						</div>
						<div class="clear"></div>
					</div>
					<h3>Interest</h3>
					<div class="form_field">
						<label>Hobbies</label>
						<div class="input_field">
							<?php  echo form_input('customer_hobbies',stripslashes($info['customer_hobbies']),' class="form-control"');?>
						</div>
						<div class="clear"></div>
					</div>
					<div class="form_field">
						<label>Favourite Color</label>
						<div class="input_field">
							<?php  echo form_input('customer_fav_color',stripslashes($info['customer_fav_color']),' class="form-control"');?>
						</div>
						<div class="clear"></div>
					</div>
					<div class="form_field">
						<label>Favourite Place</label>
						<div class="input_field">
							<?php  echo form_input('customer_fav_place',stripslashes($info['customer_fav_place']),' class="form-control"');?>
						</div>
						<div class="clear"></div>
					</div>
					<div class="form_field">
						<label>Favourite Dish</label>
						<div class="input_field">
							<?php  echo form_input('customer_fav_food',stripslashes($info['customer_fav_food']),' class="form-control"');?>
						</div>
						<div class="clear"></div>
					</div>
					<div class="form_field">
						<label>Favourite Brand</label>
						<div class="input_field">
							<?php  echo form_input('customer_fav_brand',stripslashes($info['customer_fav_brand']),' class="form-control"');?>
						</div>
						<div class="clear"></div>
					</div>
					<div class="form_field">
						<label>Favourite Music</label>
						<div class="input_field">
							<?php  echo form_input('customer_fav_music',stripslashes($info['customer_fav_music']),' class="form-control"');?>
						</div>
						<div class="clear"></div>
					</div>
					
					<div class="form_field">
						<label>Favourite Book</label>
						<div class="input_field">
							<?php  echo form_input('customer_fav_book',stripslashes($info['customer_fav_book']),' class="form-control"');?>
						</div>
						<div class="clear"></div>
					</div>
					
					<div class="form_field">
						<label>Favourite Author</label>
						<div class="input_field">
							<?php  echo form_input('customer_fav_author',stripslashes($info['customer_fav_author']),' class="form-control"');?>
						</div>
						<div class="clear"></div>
					</div>
					
					<div class="form_field">
						<label>Favourite Drink</label>
						<div class="input_field">
							<?php  echo form_input('customer_fav_drink',stripslashes($info['customer_fav_drink']),' class="form-control"');?>
						</div>
						<div class="clear"></div>
					</div>
					
					<div class="form_field">
						<label>Favourite Thing</label>
						<div class="input_field">
							<?php  echo form_input('customer_fav_things',stripslashes($info['customer_fav_things']),' class="form-control"');?>
						</div>
						<div class="clear"></div>
					</div>
					
					<div class="form_field">
						<label>Favourite Game</label>
						<div class="input_field">
							<?php  echo form_input('customer_fav_sports',stripslashes($info['customer_fav_sports']),' class="form-control"');?>
						</div>
						<div class="clear"></div>
					</div>
					
					<div class="form_field">
						<label>Favourite Celebrity</label>
						<div class="input_field">
							<?php  echo form_input('customer_fav_celebrates',stripslashes($info['customer_fav_celebrates']),' class="form-control"');?>
						</div>
						<div class="clear"></div>
					</div>
					<div class="form_field">
						<label>Favourite Movie</label>
						<div class="input_field">
							<?php  echo form_input('customer_fav_movie',stripslashes($info['customer_fav_movie']),' class="form-control"');?>
						</div>
						<div class="clear"></div>
					</div>

					<div class="form_field">
						<label>Set as Private</label>
						<div class="input_field">
							<input type="hidden" name="customer_private" value="0" />
							<?php  echo form_checkbox('customer_private',1,set_checkbox('customer_private', $info['customer_private'], false) , ' class="form-control"');?>
						</div>
						<div class="clear"></div>
					</div>
					
					<div class="clear"></div>
					<div class="btn_wrap">
						<input type="submit" value="Update Profile">
					</div>
				<?php
				echo form_hidden('edit_id',$info['customer_id']);
				echo form_hidden ( 'action', 'edit' );
				echo form_close ();
				?>	
			
<?php } if($info['customer_type'] == 1) { ?> 
				<?php echo form_open_multipart(base_url().'myprofile',' class="form-horizontal" id="common_form" ' );?>
					<h3>General</h3>
					<div class="form_field">
						<label>Business Model</label>
						<div class="input_field">
							<?php  echo form_dropdown('business_model',array('sales'=>'Sales','service'=>'Service','sale-service'=>'Sales/Services'),stripslashes($info['business_model']),' class="form-control"');?>
						</div>
						<div class="clear"></div>
					</div>
					
					<div class="form_field">
						<label>Nature of Business</label>
						<div class="input_field">
							<?php $cust_prof = explode(',',$info['customer_prof_profession']); echo form_dropdown('customer_prof_profession[]',$professions,$cust_prof,'multiple="multiple"'); 
							?>
						</div>
						<div class="clear"></div>
					</div>
					
					
					<div class="form_field">
						<label>Lead Person of Business</label>
						<div class="input_field">
							<?php  echo form_input('customer_first_name',stripslashes($info['customer_first_name']),' class="form-control"');?>
						</div>
						<div class="clear"></div>
					</div>
				
					<div class="form_field">
						<label>Point of Contact</label>
						<div class="input_field">
							<?php  echo form_input('customer_last_name',stripslashes($info['customer_last_name']),' class="form-control"');?>
						</div>
						<div class="clear"></div>
					</div>
					
					<div class="form_field">
						<label>Business Place Of Country </label>
						<div class="input_field">
							<?php  echo get_all_countries('',$info['customer_country'],'class="form-control" id="customer_country" required="required" onchange="get_state()" '); ?>
						</div>
						<div class="clear"></div>
					</div>
					<div class="form_field">
						<label>Business Place Of Living</label>
						<div class="input_field state_field">
							<?php  echo get_all_states(array('intCountryId'=>$info['customer_country']),$info['customer_state'],'class="form-control" id="customer_state" onchange="get_city()"'); ?>
						</div>
						<div class="clear"></div>
					</div>
					<div class="form_field">
						<label>Business Place of City</label>
						<div class="input_field city_field">
							<?php  echo get_all_cities(array('city_state'=>$info['customer_state']),$info['customer_city'],'class="form-control" id="customer_city"'); ?>
						</div>
						<div class="clear"></div>
					</div>
					
					<div class="form_field">
						<label>Business Sector</label>
						<div class="input_field">
							<?php  echo form_dropdown('business_sector',array('local'=>'Local','national'=>'National','international'=>'International'),stripslashes($info['business_sector']),' class="form-control"');?>
						</div>
						<div class="clear"></div>
					</div>
					
					<div class="form_field">
						<label>Branches</label>
						<div class="input_field">
							<?php  echo form_dropdown('branches',array('0'=>'No','1'=>'Yes'),stripslashes($info['branches']),' class="form-control"');?>
						</div>
						<div class="clear"></div>
					</div>
					
					<div class="form_field">
						<label>Business Establishment</label>
						<div class="input_field">
							<?php  echo form_input('business_establishment',stripslashes($info['business_establishment']),' class="form-control" placeholder="Year of the Establishment" ');?>
						</div>
						<div class="clear"></div>
					</div>
					
					<div class="form_field">
						<label>Business Customer Target</label>
						<div class="input_field">
							<?php  echo form_input('customer_prof_specialized',stripslashes($info['customer_prof_specialized']),' class="form-control" placeholder="Men,Women..." ');?>
						</div>
						<div class="clear"></div>
					</div>
					
					<div class="form_field">
						<label>18+?</label>
						<div class="input_field">
							<?php  echo form_dropdown('is_adult_only',array('0'=>'No','1'=>'Yes'),stripslashes($info['is_adult_only']),' class="form-control"');?>
						</div>
						<div class="clear"></div>
					</div>
					
					<div class="form_field">
						<label for="customer_notes"><?php echo get_label('customer_notes');?></label>
						<div class="input_field"><?php  echo form_textarea('customer_notes',set_value('customer_notes'),' class="form-control"  ');?></div>
						<div class="clear"></div>
					</div>
					
					<div class="form_field">
						<label for="customer_photo"><?php echo get_label('customer_photo');?></label>
						<div class="input_field"> <div class="custom_browsefile"> <?php echo form_upload('customer_photo');?> <span class="result_browsefile"><span class="brows"></span>+ <?php echo get_label('upload_image');?></span> </div> </div>
						<div class="clear"></div>
					</div>
					<div class="form_field">
						<?php if($info['customer_photo']){ ?>
						<label></label>
						<div class="input_field show_image_box">
							<img class="img-responsive common_delete_image" style="width: 100px; height:100px;"  src="<?php echo media_url(). $this->lang->line('customer_image_folder_name')."/".$info['customer_photo'];?>">
						</div><?php } ?>
						<div class="clear"></div>
					</div>
					
					<h3>Social Media</h3>
					<div class="form_field">
						<label>Facebook Link</label>
						<div class="input_field">
							<?php  echo form_input('customer_facebook_link',stripslashes($info['customer_facebook_link']),' class="form-control"');?>
						</div>
						<div class="clear"></div>
					</div>
					
					<div class="form_field">
						<label>Instagram Link</label>
						<div class="input_field">
							<?php  echo form_input('customer_instagram_link',stripslashes($info['customer_instagram_link']),' class="form-control"');?>
						</div>
						<div class="clear"></div>
					</div>
					
					<div class="form_field">
						<label>Twitter Link</label>
						<div class="input_field">
							<?php  echo form_input('customer_twitter_link',stripslashes($info['customer_twitter_link']),' class="form-control"');?>
						</div>
						<div class="clear"></div>
					</div>
					
					<div class="form_field">
						<label>Youtube Link</label>
						<div class="input_field">
							<?php  echo form_input('customer_youtube_link',stripslashes($info['customer_youtube_link']),' class="form-control"');?>
						</div>
						<div class="clear"></div>
					</div>
					
					<h3>Contact</h3>
					
					
					<div class="form_field">
						<label>Mobile</label>
						<div class="input_field">
							<?php  echo form_input('customer_phone',stripslashes($info['customer_phone']),' class="form-control"');?>
						</div>
						<div class="clear"></div>
					</div>
					
					<div class="form_field">
						<label>Office</label>
						<div class="input_field">
							<?php  echo form_input('customer_prof_official_phone',stripslashes($info['customer_prof_official_phone']),' class="form-control"');?>
						</div>
						<div class="clear"></div>
					</div>
					
					<div class="form_field">
						<label>Email</label>
						<div class="input_field">
							<?php  echo form_input('customer_prof_official_email',stripslashes($info['customer_prof_official_email']),' class="form-control"');?>
						</div>
						<div class="clear"></div>
					</div>
					
					<div class="form_field">
						<label>Website</label>
						<div class="input_field">
							<?php  echo form_input('customer_prof_official_website',stripslashes($info['customer_prof_official_website']),' class="form-control"');?>
						</div>
						<div class="clear"></div>
					</div>
					
					<div class="form_field">
						<label>Fax</label>
						<div class="input_field">
							<?php  echo form_input('fax',stripslashes($info['fax']),' class="form-control"');?>
						</div>
						<div class="clear"></div>
					</div>
				
					<h3>Location</h3>
					<div class="form_field">
						<label>Google Map Location</label>
						<div class="input_field">
							<?php  echo form_textarea('address',stripslashes($info['address']),' class="form-control"');?>
						</div>
						<div class="clear"></div>
					</div>
					
					<div class="form_field">
						<label>Set as Private</label>
						<div class="input_field">
							<input type="hidden" name="customer_private" value="0" />
							<?php  echo form_checkbox('customer_private',1,set_checkbox('customer_private', $info['customer_private'], false) , ' class="form-control"');?>
						</div>
						<div class="clear"></div>
					</div>
					<div class="clear"></div>
					<div class="btn_wrap">
						<input type="submit" value="Update Profile">
					</div>
				<?php
				echo form_hidden('edit_id',$info['customer_id']);
				echo form_hidden ( 'action', 'edit' );
				echo form_close ();
				?>	
<?php } } else if($info['customer_type'] == 0) { ?> 


	<div class="form_field">
		<label>First Name</label>
		<div class="input_field">
			<?php echo "<label class='display_info'>".stripslashes($info['customer_first_name'])."</label>"; ?>
		</div>
		<div class="clear"></div>
	</div>

	<div class="form_field">
		<label>Last Name</label>
		<div class="input_field">
			<?php echo "<label class='display_info'>".stripslashes($info['customer_last_name'])."</label>"; ?>
		</div>
		<div class="clear"></div>
	</div>

	<div class="form_field">
		<label>Phone</label>
		<div class="input_field">
			<?php echo "<label class='display_info'>".stripslashes($info['customer_phone'])."</label>"; ?>
		</div>
		<div class="clear"></div>
	</div>

	<div class="form_field">
		<label>Birthday</label>
		<div class="input_field">
			<?php echo "<label class='display_info'>".date('d-m-Y',strtotime($info['customer_birthdate']))."</label>"; ?>
		</div>
		<div class="clear"></div>
	</div>

	<div class="form_field">
		<label>Place Of Country </label>
		<div class="input_field">
			<?php echo "<label class='display_info'>"; ?>
				<?php  echo get_country_name($info['customer_country']); ?>
			<?php echo "</label>"; ?>
		</div>
		<div class="clear"></div>
	</div>
	<div class="form_field">
		<label>Place Of Living</label>
		<div class="input_field">
			<?php echo "<label class='display_info'>"; ?>
				<?php  echo get_state_name($info['customer_state']); ?>
			<?php echo "</label>"; ?>
		</div>
		<div class="clear"></div>
	</div>
	<div class="form_field">
		<label>Place Of Hometown</label>
		<div class="input_field">
			<?php echo "<label class='display_info'>"; ?>
				<?php  echo get_city_name($info['customer_city']); ?>
			<?php echo "</label>"; ?>
		</div>
		<div class="clear"></div>
	</div>
	<div class="form_field">
		<label>Postal Code</label>
		<div class="input_field">
			<?php echo "<label class='display_info'>".stripslashes($info['customer_postal_code'])."</label>"; ?>
		</div>
		<div class="clear"></div>
	</div>
	<div class="form_field">
		<label>Profession</label>
		<div class="input_field">
			<?php echo "<label class='display_info'>".stripslashes($info['customer_prof_profession'])."</label>"; ?>
		</div>
		<div class="clear"></div>
	</div>
	<?php /*
	<div class="form_field">
		<label>Qualification</label>
		<div class="input_field">
			<input type="text" placeholder="BE">
		</div>
		<div class="clear"></div>
	</div> */ ?>
	<div class="form_field">
		<label>Gender</label>
		<div class="input_field">
			<?php  $gender = array(''=>'','M'=>'Male','F'=>'Female','O'=>'Other'); 
			echo "<label class='display_info'>".$gender[$info['customer_gender']]."</label>"; ?>
		</div>
		<div class="clear"></div>
	</div>
	<div class="form_field">
		<label>Status</label>
		<div class="input_field">
			<?php $status = array(''=>'','single'=>'Single','married'=>'Married','divorced'=>'Divorced','widowed'=>'Widowed'); echo "<label class='display_info'>".$status[$info['customer_maritial_status']]."</label>"; ?>
		</div>
		<div class="clear"></div>
	</div>
	
	<div class="form_field">
		<label>Facebook Link</label>
		<div class="input_field">
			<?php echo "<label class='display_info'>".stripslashes($info['customer_facebook_link'])."</label>"; ?>
		</div>
		<div class="clear"></div>
	</div>
	
	<div class="form_field">
		<label>Instagram Link</label>
		<div class="input_field">
			<?php echo "<label class='display_info'>".stripslashes($info['customer_instagram_link'])."</label>"; ?>
		</div>
		<div class="clear"></div>
	</div>
	
	<div class="form_field">
		<label>Twitter Link</label>
		<div class="input_field">
			<?php echo "<label class='display_info'>".stripslashes($info['customer_twitter_link'])."</label>"; ?>
		</div>
		<div class="clear"></div>
	</div>
	
	<div class="form_field">
		<label>Youtube Link</label>
		<div class="input_field">
			<?php echo "<label class='display_info'>".stripslashes($info['customer_youtube_link'])."</label>"; ?>
		</div>
		<div class="clear"></div>
	</div>
	
	<div class="form_field">
		<label>Hobbies</label>
		<div class="input_field">
			<?php echo "<label class='display_info'>".stripslashes($info['customer_hobbies'])."</label>"; ?>
		</div>
		<div class="clear"></div>
	</div>
	<div class="form_field">
		<label>Favourite Color</label>
		<div class="input_field">
			<?php echo "<label class='display_info'>".stripslashes($info['customer_fav_color'])."</label>"; ?>
		</div>
		<div class="clear"></div>
	</div>
	<div class="form_field">
		<label>Favourite Place</label>
		<div class="input_field">
			<?php echo "<label class='display_info'>".stripslashes($info['customer_fav_place'])."</label>"; ?>
		</div>
		<div class="clear"></div>
	</div>
	<div class="form_field">
		<label>Favourite Dish</label>
		<div class="input_field">
			<?php echo "<label class='display_info'>".stripslashes($info['customer_fav_food'])."</label>"; ?>
		</div>
		<div class="clear"></div>
	</div>
	<div class="form_field">
		<label>Favourite Brand</label>
		<div class="input_field">
			<?php echo "<label class='display_info'>".stripslashes($info['customer_fav_brand'])."</label>"; ?>
		</div>
		<div class="clear"></div>
	</div>
	<div class="form_field">
		<label>Favourite Music</label>
		<div class="input_field">
			<?php echo "<label class='display_info'>".stripslashes($info['customer_fav_music'])."</label>"; ?>
		</div>
		<div class="clear"></div>
	</div>
	
	<div class="form_field">
		<label>Favourite Book</label>
		<div class="input_field">
			<?php echo "<label class='display_info'>".stripslashes($info['customer_fav_book'])."</label>"; ?>
		</div>
		<div class="clear"></div>
	</div>
	
	<div class="form_field">
		<label>Favourite Author</label>
		<div class="input_field">
			<?php echo "<label class='display_info'>".stripslashes($info['customer_fav_author'])."</label>"; ?>
		</div>
		<div class="clear"></div>
	</div>
	
	<div class="form_field">
		<label>Favourite Drink</label>
		<div class="input_field">
			<?php echo "<label class='display_info'>".stripslashes($info['customer_fav_drink'])."</label>"; ?>
		</div>
		<div class="clear"></div>
	</div>
	
	<div class="form_field">
		<label>Favourite Thing</label>
		<div class="input_field">
			<?php echo "<label class='display_info'>".stripslashes($info['customer_fav_things'])."</label>"; ?>
		</div>
		<div class="clear"></div>
	</div>
	
	<div class="form_field">
		<label>Favourite Game</label>
		<div class="input_field">
			<?php echo "<label class='display_info'>".stripslashes($info['customer_fav_sports'])."</label>"; ?>
		</div>
		<div class="clear"></div>
	</div>
	
	<div class="form_field">
		<label>Favourite Celebrity</label>
		<div class="input_field">
			<?php echo "<label class='display_info'>".stripslashes($info['customer_fav_celebrates'])."</label>"; ?>
		</div>
		<div class="clear"></div>
	</div>
	<div class="form_field">
		<label>Favourite Movie</label>
		<div class="input_field">
			<?php echo "<label class='display_info'>".stripslashes($info['customer_fav_movie'])."</label>"; ?>
		</div>
		<div class="clear"></div>
	</div>

<?php } else if($info['customer_type'] == 1) { ?> 

	<h3>General</h3>
	<div class="form_field">
		<label>Business Model</label>
		<div class="input_field">
			<?php  
			$business_model = array(''=>'','sales'=>'Sales','service'=>'Service','sale-service'=>'Sales/Services');
			echo "<label class='display_info'>".$business_model[$info['business_model']]."</label>";
			?>
		</div>
		<div class="clear"></div>
	</div>
	
	<div class="form_field">
		<label>Nature of Business</label>
		<div class="input_field">
			<?php echo "<label class='display_info'>".$info['customer_prof_profession']."</label>"; ?>
		</div>
		<div class="clear"></div>
	</div>
	
	
	<div class="form_field">
		<label>Lead Person of Business</label>
		<div class="input_field">
			<?php echo "<label class='display_info'>".stripslashes($info['customer_first_name'])."</label>"; ?>
		</div>
		<div class="clear"></div>
	</div>

	<div class="form_field">
		<label>Point of Contact</label>
		<div class="input_field">
			<?php echo "<label class='display_info'>".stripslashes($info['customer_last_name'])."</label>"; ?>
		</div>
		<div class="clear"></div>
	</div>
	
	<div class="form_field">
		<label>Business Place Of Country </label>
		<div class="input_field">
			<?php echo "<label class='display_info'>"; ?>
				<?php  echo get_country_name($info['customer_country']); ?>
			<?php echo "</label>"; ?>	
		</div>
		<div class="clear"></div>
	</div>
	<div class="form_field">
		<label>Business Place Of Living</label>
		<div class="input_field">
			<?php echo "<label class='display_info'>"; ?>
				<?php  echo get_state_name($info['customer_state']); ?>
			<?php echo "</label>"; ?>	
		</div>
		<div class="clear"></div>
	</div>
	<div class="form_field">
		<label>Business Place of City</label>
		<div class="input_field">
			<?php echo "<label class='display_info'>"; ?>
				<?php  echo get_city_name($info['customer_city']); ?>
			<?php echo "</label>"; ?>	
		</div>
		<div class="clear"></div>
	</div>
	
	<div class="form_field">
		<label>Business Sector</label>
		<div class="input_field">
			<?php 
			$business_sector = array(''=>'','local'=>'Local','national'=>'National','international'=>'International');
			echo "<label class='display_info'>".$business_sector[$info['business_sector']]."</label>"; ?>
		</div>
		<div class="clear"></div>
	</div>
	
	<div class="form_field">
		<label>Branches</label>
		<div class="input_field">
			<?php 
			$branch = array('0'=>'No','1'=>'Yes');
			echo "<label class='display_info'>".$branch[$info['branches']]."</label>"; ?>
		</div>
		<div class="clear"></div>
	</div>
	
	<div class="form_field">
		<label>Business Establishment</label>
		<div class="input_field">
			<?php echo "<label class='display_info'>".stripslashes($info['business_establishment'])."</label>"; ?>
		</div>
		<div class="clear"></div>
	</div>
	
	<div class="form_field">
		<label>Business Customer Target</label>
		<div class="input_field">
			<?php echo "<label class='display_info'>".stripslashes($info['customer_prof_specialized'])."</label>"; ?>
		</div>
		<div class="clear"></div>
	</div>
	
	<div class="form_field">
		<label>18+?</label>
		<div class="input_field">
			<?php $adult = array('0'=>'No','1'=>'Yes'); echo "<label class='display_info'>".$adult[$info['is_adult_only']]."</label>"; ?>
		</div>
		<div class="clear"></div>
	</div>
	
	<h3>Social Media</h3>
	<div class="form_field">
		<label>Facebook Link</label>
		<div class="input_field">
			<?php echo "<label class='display_info'>".stripslashes($info['customer_facebook_link'])."</label>"; ?>
		</div>
		<div class="clear"></div>
	</div>
	
	<div class="form_field">
		<label>Instagram Link</label>
		<div class="input_field">
			<?php echo "<label class='display_info'>".stripslashes($info['customer_instagram_link'])."</label>"; ?>
		</div>
		<div class="clear"></div>
	</div>
	
	<div class="form_field">
		<label>Twitter Link</label>
		<div class="input_field">
			<?php echo "<label class='display_info'>".stripslashes($info['customer_twitter_link'])."</label>"; ?>
		</div>
		<div class="clear"></div>
	</div>
	
	<div class="form_field">
		<label>Youtube Link</label>
		<div class="input_field">
			<?php echo "<label class='display_info'>".stripslashes($info['customer_youtube_link'])."</label>"; ?>
		</div>
		<div class="clear"></div>
	</div>
	
	<h3>Contact</h3>
	
	
	<div class="form_field">
		<label>Mobile</label>
		<div class="input_field">
			<?php echo "<label class='display_info'>".stripslashes($info['customer_phone'])."</label>"; ?>
		</div>
		<div class="clear"></div>
	</div>
	
	<div class="form_field">
		<label>Office</label>
		<div class="input_field">
			<?php echo "<label class='display_info'>".stripslashes($info['customer_prof_official_phone'])."</label>"; ?>
		</div>
		<div class="clear"></div>
	</div>
	
	<div class="form_field">
		<label>Email</label>
		<div class="input_field">
			<?php echo "<label class='display_info'>".stripslashes($info['customer_prof_official_email'])."</label>"; ?>
		</div>
		<div class="clear"></div>
	</div>
	
	<div class="form_field">
		<label>Website</label>
		<div class="input_field">
			<?php echo "<label class='display_info'>".stripslashes($info['customer_prof_official_website'])."</label>"; ?>
		</div>
		<div class="clear"></div>
	</div>
	
	<div class="form_field">
		<label>Fax</label>
		<div class="input_field">
			<?php echo "<label class='display_info'>".stripslashes($info['fax'])."</label>"; ?>
		</div>
		<div class="clear"></div>
	</div>

	<h3>Location</h3>
	<div class="form_field">
		<label>Google Map Location</label>
		<div class="input_field">
			<?php $address= urlencode($info['address']); echo "<iframe id='map_frame' width='100%' height='380px' frameborder='0' scrolling='no' marginheight='0' marginwidth='0' src='https://www.google.com/maps?f=q&amp;output=embed&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=https:%2F%2Fwww.google.com%2Fmaps%2Fms%3Fauthuser%3D0%26vps%3D5%26hl%3Dsk%26ie%3DUTF8%26oe%3DUTF8%26msa%3D0%26output%3Dkml%26msid%3D205427380680792264646.0004fe643d107ef29299a&amp;aq=".$address."&amp;sll=48.669026,19.699024&amp;sspn=4.418559,10.821533&amp;ie=UTF8&amp;q=".$address."&amp;spn=0.199154,0.399727&amp;t=m&amp;z=15></iframe>"; ?>
			
		</div>
		<div class="clear"></div>
	</div>

<?php } ?>

<script>
	$('.datepicker').datepicker({changeMonth: true,changeYear: true,dateFormat: 'dd-mm-yy'});
</script>