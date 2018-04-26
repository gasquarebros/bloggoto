<button title="Close (Esc)" type="button" class="mfp-close">×</button>
<style>
	.bootstrap-datetimepicker-widget {z-index: 999999999;}
</style>
<div class="customer_profie_section_width">
<div class="customer_profie_section clearfix">
   <div class="customer_profile">
      <div class="customer_profile_content">
         <div class="customer_profile_image">
             <?php
			 if($records['customer_photo']!="")
			 {
				?>
				 <img src="<?php echo base_url()."media/".get_company_folder() . "/".$this->lang->line('customer_image_folder_name').$records['customer_photo'];?>">
				<?php
			 } 
			 else
			 {
			 ?>
			  <img src="<?php echo load_lib();?>theme/images/no_profile_image.png">
			 <?php
		      }
		      ?>
         </div>
         
         <div class="date_section">
            <ul>
               <li>
                  <h4 class="date_joined_text">Date Joined</h4>
                  <p class="date"><?php echo ( isset($records['customer_created_on']) && $records['customer_created_on'] !='0000-00-00' )?get_date_formart($records['customer_created_on'],'d/m/Y'):"N/A"; ?></p>
               </li>
               <li>
                  <h4 class="date_joined_text">Date Of Last Visit</h4>
                  <p class="date"><?php echo ( isset($records['login_time']) && $records['login_time'] !='0000-00-00' )?get_date_formart($records['login_time'],'d/m/Y'):"N/A"; ?></p>
               </li>
            </ul>
         </div>
      </div>
   </div>
   <div class="customer_detail_block">
      <div class="customer_details">
         <h2 class="heading">customer details</h2>
         <div class="customer_detailed_table">
            <div class="row">
               <div class="col-md-5">
                  <table>
                     <tr>
                        <td class="text-uppercase">Name:</td>
                        <?php $customer_name = ucwords( strtolower( stripslashes( $records['customer_first_name'] ) ) ).' '.stripslashes($records['customer_last_name']); ?>
                        <td><?php echo $customer_name;?></td>
                     </tr>
                     <tr>
                        <td class="text-uppercase">Email:</td>
                        <td><?php echo ( isset($records['customer_email']) && !empty($records['customer_email']) )?stripslashes($records['customer_email']):"N/A";  ?></td>
                     </tr>
                     <tr>
                        <td class="text-uppercase">Contact No:</td>
                        <td> <?php echo ( isset($records['customer_phone']) && !empty($records['customer_phone']) )?stripslashes($records['customer_phone']):"N/A";  ?></td>
                     </tr>
                     <tr>
                        <td class="text-uppercase">Date Of Birth:</td>
                        <td><?php echo ( isset($records['customer_birthdate']) && $records['customer_birthdate'] !='0000-00-00' )?get_date_formart($records['customer_birthdate']):"N/A"; ?></td>
                     </tr>
                  </table>
               </div>
               <div class="col-md-7">
                  <table>
                     <tr>
                        <td class="text-uppercase" width="30%">Gender:</td>
                        <td><?php 
                           if($records['customer_gender'] == 'M'){
                           echo 'Male';
                           }elseif($records['customer_gender'] == 'F'){
                           echo 'Female';
                           }elseif($records['customer_gender'] == 'O'){
                           echo 'Others';
                           }else{
                           echo 'N/A';
                           }
                           ?>
                        </td>
                     </tr>
                     <tr>
                        <td class="text-uppercase">Postal Code:</td>
                        <td><?php echo ($records['customer_postal_code']!='')?$records['customer_postal_code']:'N/A';?></td>
                     </tr>
                     <tr>
                        <td class="text-uppercase">Address </td>
                        <td>
                           <?php $address = $records['customer_city'].','.$records['customer_state'].','.$records['customer_country'].','.$records['customer_postal_code'];
                              $address = implode(",",array_filter(explode(",",$address)));
                              echo ($address!='')?$address:'N/A';
                               ?>
                        </td>
                     </tr>
					 
					 <tr>
                        <td class="text-uppercase"><?php echo get_label('customer_notes'); ?> </td>
                        <td>
                           <?php $address = $records['customer_notes'];
                              echo ($address!='')?$address:'N/A';
                               ?>
                        </td>
                     </tr>
                  </table>
               </div>
            </div>
			
			<div class="clear"></div>
			<div class="row">
               <div class="col-md-5">
                  <table>
                     <tr>
                        <td class="text-uppercase"><?php echo get_label('customer_hobbies'); ?></td>
                        <td><?php echo output_value($records['customer_hobbies']);  ?></td>
                     </tr>
					 
					 
					 <tr>
                        <td class="text-uppercase"><?php echo get_label('customer_facebook_link'); ?></td>
                        <td><?php echo output_value($records['customer_facebook_link']);  ?></td>
                     </tr>
                     
					
                     
					 <tr>
                        <td class="text-uppercase"><?php echo get_label('customer_twitter_link'); ?></td>
                        <td><?php echo output_value($records['customer_twitter_link']);  ?></td>
                     </tr>
                     
                     
                  </table>
               </div>
               <div class="col-md-7">
                  <table>
                     <tr>
                        <td class="text-uppercase"><?php echo get_label('customer_maritial_status'); ?></td>
                        <td><?php echo output_value($records['customer_maritial_status']);  ?></td>
                     </tr>
					  <tr>
                        <td class="text-uppercase"><?php echo get_label('customer_instagram_link'); ?></td>
                        <td><?php echo output_value($records['customer_instagram_link']);  ?></td>
                     </tr>
					  <tr>
                        <td class="text-uppercase"><?php echo get_label('customer_youtube_link'); ?></td>
                        <td><?php echo output_value($records['customer_youtube_link']);  ?></td>
                     </tr>
                  </table>
               </div>
            </div>
			
		
			
			<div class="clear"></div>
			<div class="row">
				<div class="col-md-12 control-label customer_heading">
					<h3>Favourite</h3>
				</div>
			</div>
			<div class="clear"></div>
			<div class="row">
               <div class="col-md-5">
                  <table>
                     <tr>
                        <td class="text-uppercase"><?php echo get_label('customer_fav_color'); ?></td>
                        <td><?php echo output_value($records['customer_fav_color']);  ?></td>
                     </tr>
					 
					 
					 <tr>
                        <td class="text-uppercase"><?php echo get_label('customer_fav_brand'); ?></td>
                        <td><?php echo output_value($records['customer_fav_brand']);  ?></td>
                     </tr>
                     
					 <tr>
                        <td class="text-uppercase"><?php echo get_label('customer_fav_place'); ?></td>
                        <td><?php echo output_value($records['customer_fav_place']);  ?></td>
                     </tr>
					 
					 <tr>
                        <td class="text-uppercase"><?php echo get_label('customer_fav_celebrates'); ?></td>
                        <td><?php echo output_value($records['customer_fav_celebrates']);  ?></td>
                     </tr>
					 
					 
					 <tr>
                        <td class="text-uppercase"><?php echo get_label('customer_fav_sports'); ?></td>
                        <td><?php echo output_value($records['customer_fav_sports']);  ?></td>
                     </tr>
                     
					 <tr>
                        <td class="text-uppercase"><?php echo get_label('customer_fav_movie'); ?></td>
                        <td><?php echo output_value($records['customer_fav_movie']);  ?></td>
                     </tr>
                   
                     
                  </table>
               </div>
               <div class="col-md-7">
                  <table>
                     <tr>
                        <td class="text-uppercase"><?php echo get_label('customer_fav_food'); ?></td>
                        <td><?php echo output_value($records['customer_fav_food']);  ?></td>
                     </tr>
					 
					 
					 <tr>
                        <td class="text-uppercase"><?php echo get_label('customer_fav_music'); ?></td>
                        <td><?php echo output_value($records['customer_fav_music']);  ?></td>
                     </tr>
                     
					 <tr>
                        <td class="text-uppercase"><?php echo get_label('customer_fav_book'); ?></td>
                        <td><?php echo output_value($records['customer_fav_book']);  ?></td>
                     </tr>
					 
					 <tr>
                        <td class="text-uppercase"><?php echo get_label('customer_fav_author'); ?></td>
                        <td><?php echo output_value($records['customer_fav_author']);  ?></td>
                     </tr>
					 
					 
					 <tr>
                        <td class="text-uppercase"><?php echo get_label('customer_fav_drink'); ?></td>
                        <td><?php echo output_value($records['customer_fav_drink']);  ?></td>
                     </tr>
                     
					 <tr>
                        <td class="text-uppercase"><?php echo get_label('customer_fav_things'); ?></td>
                        <td><?php echo output_value($records['customer_fav_things']);  ?></td>
                     </tr>
                  </table>
               </div>
            </div>
			
			<div class="clear"></div>
			<div class="row">
				<div class="col-md-12 control-label customer_heading">
					<h3>Professional</h3>
				</div>
			</div>
			<div class="clear"></div>
			<div class="row">
               <div class="col-md-5">
                  <table>
                     <tr>
                        <td class="text-uppercase"><?php echo get_label('customer_prof_school'); ?></td>
                        <td><?php echo output_value($records['customer_prof_school']);  ?></td>
                     </tr>
					 
					 
					 <tr>
                        <td class="text-uppercase"><?php echo get_label('customer_prof_college'); ?></td>
                        <td><?php echo output_value($records['customer_prof_college']);  ?></td>
                     </tr>
                     
					 <tr>
                        <td class="text-uppercase"><?php echo get_label('customer_prof_work'); ?></td>
                        <td><?php echo output_value($records['customer_prof_work']);  ?></td>
                     </tr>
					 
					 <tr>
                        <td class="text-uppercase"><?php echo get_label('customer_prof_profession'); ?></td>
                        <td><?php echo output_value($records['customer_prof_profession']);  ?></td>
                     </tr>
					 
					 <tr>
                        <td class="text-uppercase"><?php echo get_label('customer_prof_rewards'); ?></td>
                        <td><?php echo output_value($records['customer_prof_rewards']);  ?></td>
                     </tr>
					 
					 
                     
                  </table>
               </div>
               <div class="col-md-7">
                  <table>
                     <tr>
                        <td class="text-uppercase"><?php echo get_label('customer_prof_official_website'); ?></td>
                        <td><?php echo output_value($records['customer_prof_official_website']);  ?></td>
                     </tr>
					 
					 
					 <tr>
                        <td class="text-uppercase"><?php echo get_label('customer_prof_official_email'); ?></td>
                        <td><?php echo output_value($records['customer_prof_official_email']);  ?></td>
                     </tr>
                     
					 <tr>
                        <td class="text-uppercase"><?php echo get_label('customer_prof_official_phone'); ?></td>
                        <td><?php echo output_value($records['customer_prof_official_phone']);  ?></td>
                     </tr>
					 
					 <tr>
                        <td class="text-uppercase"><?php echo get_label('customer_prof_specialized'); ?></td>
                        <td><?php echo output_value($records['customer_prof_specialized']);  ?></td>
                     </tr>
					 
					 
					 <tr>
                        <td class="text-uppercase"><?php echo get_label('customer_prof_types'); ?></td>
                        <td><?php echo output_value($records['customer_prof_types']);  ?></td>
                     </tr>
                     
                  </table>
               </div>
            </div>
			
         </div>
      </div>
   </div>
</div>
</div>


<script>
	
$('.datepickerchange1').datetimepicker({
	format: 'DD/MM/YYYY'
});

$('.datepickerchange2').datetimepicker({
	format: 'DD/MM/YYYY'
});

</script>



