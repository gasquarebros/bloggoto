<script>
var module_action = "booknow";
var custom_redirect_url = "services/thankyou";
</script>

<div class="listing-detail">
        <!--main section-->
        <div class="detail-main-section">
            <div class="detail-cover-img">
                <?php 
                  $cover_photo = "";
                  if(!empty($gallery_images)) {
                    $gal_iamge = $gallery_images[0];
                    $cover_photo = media_url(). $this->lang->line('service_gallery_image_folder_name')."/".$gal_iamge['ser_gallery_image'];
                  } else {
                    $cover_photo = media_url().$this->lang->line('post_photo_folder_name')."default.png";
                  }
                ?>
                <img src="<?php echo $cover_photo; ?>" alt="">
                <div class="cover-shade">
                    <div class="user-picture">
                    <?php if($records['customer_photo'] !='') { ?>
                        <img class="service_prof_photo" src="<?php echo media_url(). $this->lang->line('customer_image_folder_name').$records['customer_photo'];?>" alt="profile" />
                      <?php } else { ?> 
                        <img class="service_prof_photo" src="<?php echo skin_url(); ?>images/profile.jpg" alt="profile" />
                      <?php } ?>
                    </div>
                    <h4><?php echo $records['ser_title']; ?></h4>
                    <h5 class="text-rose"><?php echo $records['ser_cate_name']; ?></h5>
                    <strong><i class="fa fa-list-alt text-info"></i> <?php echo $records['pro_subcate_name']; ?></strong>
                    <strong> 
                      <?php $discount = find_discount($records['ser_price'],$records['ser_discount_price'],$records['ser_discount_start_date'],$records['ser_discount_end_date']);
                      $price = ""; 
                      if($records['ser_discount_price'] !='' && $discount > 0) {
                        $price = $records['ser_discount_price'];
                      } else {
                        $price = $records['ser_price'];
                      } 
                      echo show_price($price)."/".$records['ser_pricet_type']; ?>
                    </strong>
                </div>
            </div>

            <div class="detail-action">
                <strong>Service Provided by <a href="<?php echo base_url().urlencode($records['customer_username']); ?>" class=""><?php echo $records['customer_username']; ?></a><!--<i class="fa fa-check-circle-o text-success"></i> Verified Listing--></strong>
                <div class="action">
                    <?php $page_url = base_url()."services/view/".$records['ser_slug']; ?>
                    <a target="_blank" href="https://www.facebook.com/sharer.php?u=<?php echo $page_url; ?>"><i class="fa fa-facebook"></i></a>
                    <a target="_blank" href="https://plus.google.com/share?url=<?php echo $page_url; ?>"><i class="fa fa-google"></i></a>
                    <a class="copy_to_clipboard" data-text="<?php echo $page_url; ?>" ><i class="fa fa-copy"></i></a>
                    <a target="_blank" href="https://twitter.com/share?text=<?php echo $page_url; ?>"><i class="fa fa-twitter"></i></a>
                    <a target="_blank" href="mailto:?subject=Referal&amp;body=<?php echo $page_url; ?>"><i class="fa fa-envelope"></i></a>
                </div>
            </div>
            <p class="detail-description">
                <?php echo $records['ser_description']; ?>
            </p>

            <div class="detail-content">
              <h5>Availability</h5>
                <?php 
                  if($records['ser_available'] !='') { 
                    $available = explode(',',$records['ser_available']);
                    $i=0;
                    foreach($available as $avail){
                      if($avail !='') {
                        if($i%2==0) {
                          $cls = "chip info text-white";
                        } else {
                          $cls = "chip info";
                        }
                        echo '<a href="javascript:;" class="'.$cls.'">'.ucwords($avail)."</a>";
                      }
                      $i++;
                    }
                  }
                ?>


                <div class="privileges">
                    <h5>Available City</h5>
                    <?php if(!empty($cities)) { 
                      foreach($cities as $ckey=>$city) {
                        if($ckey !='') {
                    ?>
                        <input checked="" disabled="" name="remember" id="<?php echo $ckey; ?>" type="checkbox">
                        <label for="<?php echo $ckey; ?>"><?php echo $city; ?></label>
                    <?php 
                        }
                      }
                    }
                    ?>
                </div>
                <div class="privileges gallery popup-gallery">
                    <h5>Gallery</h5>
                    <?php if(!empty($gallery_images)) { 
                      foreach($gallery_images as $gallery) { 
                        $cover_photo = media_url(). $this->lang->line('service_gallery_image_folder_name')."/".$gallery['ser_gallery_image'];
                    ?>
                    <a href="<?php echo $cover_photo; ?>">
                      <img class="responsive "  src="<?php echo $cover_photo; ?>" >
                    </a>  
                    <?php  }
                    } 
                    ?>
                </div>
                <?php /*
                <div class="reviews">
                    <h5>Reviews</h5>
                    <div class="comments-detail">
                        <div class="comment-sec">
                            <div class="comment-photo">
                                <div class="comm-img">
                                    <img src="img/avatar.jpg" class="img-fluid" alt="">
                                </div>
                                <i class="fa fa-heart"></i>
                                <i class="fa fa-share-alt"></i>
                            </div>
                            <div class="comment-info">
                                <h6 class="comment-name">Rachel Ivin</h6>
                                <i>Thursday Feb 4, 2015</i>
                                <p>
                                    Jowl cupim prosciutto meatloaf, andouille shoulder tail salami.
                                    Corned beef t-bone shoulder, biltong brisket chuck rump hamburger tri-tip.
                                    Short loin porchetta fatback chicken. Sausage venison tail
                                </p>
                                <div class="rating-stars">
                                    <i class="fa fa-star yel"></i>
                                    <i class="fa fa-star yel"></i>
                                    <i class="fa fa-star yel"></i>
                                    <i class="fa fa-star-half-empty"></i>
                                    <i class="fa fa-star-o yel"></i>
                                </div>
                            </div>
                        </div>
                        <div class="comment-sec">
                            <div class="comment-photo">
                                <div class="comm-img">
                                    <img src="img/user2.jpg" class="img-fluid" alt="">
                                </div>
                                <i class="fa fa-heart"></i>
                                <i class="fa fa-share-alt"></i>
                            </div>
                            <div class="comment-info">
                                <h6 class="comment-name">brandon Zen</h6>
                                <i>Thursday Feb 4, 2015</i>
                                <p>
                                    Jowl cupim prosciutto meatloaf, andouille shoulder tail salami.
                                    Corned beef t-bone shoulder, biltong brisket chuck rump hamburger tri-tip.
                                    Short loin porchetta fatback chicken. Sausage venison tail
                                </p>
                                <div class="rating-stars">
                                    <i class="fa fa-star yel"></i>
                                    <i class="fa fa-star yel"></i>
                                    <i class="fa fa-star yel"></i>
                                    <i class="fa fa-star-half-empty"></i>
                                    <i class="fa fa-star-o yel"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ui-pagination">
                        <a href="#" class="page"><i class="fa fa-angle-left"></i></a>
                        <a href="#" class="page">1</a>
                        <a href="#" class="page info text-white">2</a>
                        <a href="#" class="page">3</a>
                        <a href="#" class="page">4</a>
                        <a href="#" class="page"><i class="fa fa-angle-right"></i></a>
                    </div>

                    <!--review form-->
                    <div class="review-frm">
                        <h5>Add Review (<i class="fa fa-star text-rose"></i>)</h5>
                        <form action="" method="post">
                            <div class="rate">
                                <a href="#"><i class="fa fa-star-half-o"></i></a>
                                <a href="#"><i class="fa fa-star-half-o"></i></a>
                                <a href="#"><i class="fa fa-star-half-o"></i></a>
                                <a href="#"><i class="fa fa-star-half-o"></i></a>
                                <a href="#"><i class="fa fa-star-half-o"></i></a>
                                <span>Your Rating</span>
                            </div>
                            <div class="form-group">
                                <textarea name="msg" id="message" placeholder="Your Message Here ..." rows="3"></textarea>
                            </div>
                            <button type="submit" class="btn ui-btn dark-blue">Submit</button>
                        </form>
                    </div>
                    <!--end review form-->

                </div>
                */ ?>
            </div>

        </div>
        <!--end main section-->

        <!--aside section-->
        <aside class="detail-aside-section">
            <?php /*
            <div class="box">
                <div class="rating-b">
                    <h1 class="text-center">4.8</h1>
                    <div class="rating-stars text-center">
                        <i class="fa fa-star yel"></i>
                        <i class="fa fa-star yel"></i>
                        <i class="fa fa-star yel"></i>
                        <i class="fa fa-star-half-empty"></i>
                        <i class="fa fa-star-o yel"></i>
                    </div>
                    <p class="text-center"><small>(567 Reviews)</small></p>
                </div>
            </div>
            */ ?>
            <div class="service-sidebar">
                <h4>Contact</h4>
                <hr>
                <ul class="list-unstyled cont-info">
                    <?php if($records['customer_phone'] !='') { ?>
                    <li><i class="fa fa-phone text-mayan"></i> <span><?php echo $records['customer_phone']; ?></span></li>
                    <?php } ?>
                    <?php if($records['customer_email'] !='') { ?>
                    <li><i class="fa fa-envelope-o text-rose"></i> <a href="mailto:<?php echo $records['customer_email']; ?>"><?php echo $records['customer_email']; ?></a></li>
                    <?php } ?>
                    <?php if($records['customer_city'] !='') { ?>
                    <li><i class="fa fa-map-marker"></i> <span><?php echo get_city_name($records['customer_city']); ?></span></li>
                    <?php } ?>

                    <?php if($records['customer_linkedin_link'] !='') { ?>
                      <li><i class="fa fa-linkedin text-primary"></i> <a target="_blank" href='<?php echo addhttp($records['customer_linkedin_link']); ?>'><?php echo $records['customer_linkedin_link']; ?></a></li>
                    <?php } ?>  
                    <?php if($records['customer_youtube_link'] !='') { ?>
                      <li><i class="fa fa-youtube text-primary"></i> <a target="_blank" href='<?php echo addhttp($records['customer_youtube_link']); ?>'><?php echo $records['customer_youtube_link']; ?></a></li>
                    <?php } ?>  
                    <?php if($records['customer_instagram_link'] !='') { ?>
                      <li><i class="fa fa-instagram text-primary"></i> <a target="_blank" href='<?php echo addhttp($records['customer_instagram_link']); ?>'><?php echo $records['customer_instagram_link']; ?></a></li>
                    <?php } ?>  
                    <?php if($records['customer_twitter_link'] !='') { ?>
                      <li><i class="fa fa-twitter text-primary"></i> <a target="_blank" href='<?php echo addhttp($records['customer_twitter_link']); ?>'><?php echo $records['customer_twitter_link']; ?></a></li>
                    <?php } ?>  
                    <?php if($records['customer_facebook_link'] !='') { ?>
                      <li><i class="fa fa-facebook text-primary"></i> <a target="_blank" href='<?php echo addhttp($records['customer_facebook_link']); ?>'><?php echo $records['customer_facebook_link']; ?></a></li>
                    <?php } ?>  
                </ul>
                
                <?php echo form_open_multipart(base_url().$module.'/bookservice',' class="form-horizontal" id="common_form" autocomplete="'.form_autocomplte().'" ' );?>
                    <h4>Book Service</h4> 
                    <hr>
                    <ul class=" alert_msg  alert-danger  alert container_alert" style="display: none;">
						       	</ul>
                    <div class="form-group">
                      <?php  echo form_input('start_date',set_value('start_date'),' class="form-control required datepicker" placeholder="'.get_label('start_date').'" title="'.get_label('start_date').' is required"  ');?>
                    </div>
                    <div class="form-group">
                      <?php  echo form_input('end_date',set_value('end_date'),' class="form-control required datepicker" placeholder="'.get_label('end_date').'" title="'.get_label('end_date').'  is required"  ');?>
                    </div>
                    <?php if($records['ser_pricet_type'] == 'hour') { ?> 
                      <div class="form-group">
                          <?php  
                            $removed = array('start_time'=>$records['ser_service_start_time'],'end_time'=>$records['ser_service_end_time']);
                            echo get_time_dropdown('start_time','',$removed);
                          ?>
                      </div>
                      <div class="form-group">
                        <?php
                          echo get_time_dropdown('end_time','',$removed);
                        ?>
                      </div>
                      <br>
                    <?php } ?>
                    <div class="form-group">
                      <?php  echo form_input('address_line1',set_value('address_line1'),' class="form-control required" placeholder="'.get_label('address_line1').'"  title="'.get_label('address_line1').'  is required"   ');?>
                    </div>
                    <div class="form-group">
                      <?php  echo form_input('address_line2',set_value('address_line2'),' class="form-control" placeholder="'.get_label('address_line2').'" title="'.get_label('address_line2').'"  ');?>
                    </div>
                    <div class="form-group">
                      <?php  echo get_all_cities('','','class="form-control" title="City is required" id="customer_city" required');?>
                    </div>
                    <div class="form-group">
                      <?php  echo get_all_states('','','class="form-control" title="State is required" data-placeholder="Select State" id="customer_state" required');?>
                    </div>
                    <br>
                    <div class="form-group">
                      <?php  echo form_input('zipcode',set_value('zipcode'),' class="form-control required" placeholder="'.get_label('zipcode').'" title="'.get_label('zipcode').' is required"  ');?>
                    </div>
                    <div class="form-group">
                      <?php  echo form_input('landmark',set_value('landmark'),' class="form-control" placeholder="'.get_label('landmark').'" title="'.get_label('landmark').'"  ');?>
                    </div>
                    <div class="form-group">
                      <?php  echo form_input('order_service_message',set_value('order_service_message'),' class="form-control" placeholder="'.get_label('order_service_message').'" title="'.get_label('order_service_message').'"  ');?>
                    </div>
                    
                    <button type="submit" name="submit" class="btn ui-btn dark-blue btn-block">Book Now</button>
                  <?php
                  echo form_hidden ( 'service', $records['ser_service_id'] );
                  echo form_hidden ( 'cover_photo', $cover_photo );
                  echo form_hidden ( 'action', 'Add' );
                  echo form_close (); 
                  ?>
            </div>
        </aside>
        <!--end aside section-->
    </div>

    <style>
.error {
color: red;
}
.chosen-container {
  padding: 5px 0px;
}
    .listing-detail {
  width: 100%;
  padding: 2rem 4rem;
  font-size:16px;
  display: flex;
  color: #607d8b;
  justify-content: space-between; }
  .listing-detail h5, .listing-detail h4 {
    font-size: 1.25rem;
    margin-bottom: .5rem;
    color: #607d8b;
  }
  .listing-detail h1 {
  font-size: 2.5rem;
  color: #607d8b;
  margin-bottom: .5rem;
  }
.listing-detail .detail-main-section {
  flex-basis: 72%;
  margin-bottom: 2rem;
  border-radius: 6px;
  background: white; }
.listing-detail .detail-main-section .detail-cover-img {
  width: 100%;
  border-radius: 6px 6px 0 0;
  position: relative; }
.listing-detail .detail-main-section .detail-cover-img img {
  width: 100%;
  border-radius: inherit; }
.listing-detail .detail-main-section .detail-cover-img .cover-shade {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: linear-gradient(to bottom, transparent, rgba(0, 0, 0, 0.3));
  display: flex;
  flex-direction: column;
  justify-content: flex-end;
  padding: 1rem; }
.listing-detail .detail-main-section .detail-cover-img .cover-shade .user-picture {
  width: 73px;
  height: 73px;
  border-radius: 50%;
  border: 2px solid #3197EE; }
 .user-picture .service_prof_photo{
   height: 68px;
 } 
.listing-detail .detail-main-section .detail-cover-img .cover-shade .user-picture img {
  width: 100%;
  border-radius: inherit; }
.listing-detail .detail-main-section .detail-cover-img .cover-shade h4 {
  color: whitesmoke; }
  .text-rose {
    color: #ff3700 !important;
}
.text-info {
    color: #17a2b8 !important;
}
.listing-detail .detail-aside-section .box {
  border-radius: inherit; }
@media (max-width: 31.25em) {
  .listing-detail .detail-main-section .detail-cover-img .cover-shade h4 {
    font-size: 18px;
    margin-bottom: 4px; } }
@media (max-width: 30em) {
  .listing-detail .detail-main-section .detail-cover-img .cover-shade h5 {
    font-size: 1rem;
    margin-bottom: 4px; } }
.listing-detail .detail-main-section .detail-cover-img .cover-shade strong {
  color: white; }
.listing-detail .detail-main-section .detail-cover-img .cover-shade strong i {
  font-size: 20px; }
.listing-detail .detail-main-section .detail-action {
  width: 100%;
  min-height: 60px;
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 0 1rem;
  border-bottom: 1px solid #efefef; }
.listing-detail .detail-main-section .detail-action .action {
  display: flex; }
.listing-detail .detail-main-section .detail-action .action a {
  text-decoration: none;
  width: 38px;
  height: 38px;
  border-radius: 50%;
  border: 1px solid lightgrey;
  display: flex;
  justify-content: center;
  align-items: center;
  margin-right: 0.5rem;
  transition: all 600ms; }
.listing-detail .detail-main-section .detail-action .action a i {
  transition: color 600ms; }
.listing-detail .detail-main-section .detail-action .action a:last-child:hover {
  background: #ff008f;
  border-color: #ff008f; }
.listing-detail .detail-main-section .detail-action .action a:nth-child(2):hover {
  background: #17a3ff;
  border-color: #17a3ff; }
.listing-detail .detail-main-section .detail-action .action a:first-child:hover {
  background: #7305ff;
  border-color: #7305ff; }
.listing-detail .detail-main-section .detail-action .action a:hover i {
  color: white; }
.listing-detail .detail-main-section .detail-description {
  padding: 1rem; color: #607d8b; }
  .text-success {
    color: #28a745 !important;
}
.listing-detail .detail-main-section .detail-content {
  padding: 1rem; }
.listing-detail .detail-main-section .detail-content .privileges {
  margin-top: 2rem; }
.listing-detail .detail-main-section .detail-content .privileges h5 {
  margin-bottom: 1rem; }
.listing-detail .detail-aside-section {
  flex-basis: 25%;
  border-radius: 6px; }
.listing-detail .detail-aside-section .box {
  border-radius: inherit; }
.listing-detail .detail-aside-section .service-sidebar {
  padding: 1rem;
  background: white;
  border-radius: inherit; }
@media (max-width: 68.75em) {
  .listing-detail {
    display: block; }
  .listing-detail .detail-main-section {
    width: 100%; }
  .listing-detail .detail-aside-section {
    width: 100%; } }
@media (max-width: 36.25em) {
  .listing-detail {
    padding: 2rem 1rem; } }

.rating-b {
  padding: 1rem; }

  .detail-banner {
  width: 100%;
  position: relative; }
.detail-banner img {
  width: 100%; }
.detail-banner .shade {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: linear-gradient(to bottom, transparent, #001060); }

.service-container {
  background: white; }
.service-container .provider-info {
  transform: translateY(-100px);
  width: 80%;
  margin: 0 auto;
  background: white;
  box-shadow: 0 3px 10px -2px lightgrey;
  border-radius: 4px;
  padding: 2rem;
  display: flex; }
.service-container .provider-info .prov-info .provider-photo {
  width: 104px;
  height: 104px;
  border-radius: 50%;
  box-shadow: -2px 4px 15px 1px grey;
  margin-bottom: 0.6rem; }
.service-container .provider-info .prov-info .provider-photo img {
  width: 100%;
  border-radius: inherit; }
@media (max-width: 25em) {
  .service-container .provider-info .prov-info .provider-photo {
    margin: 0 auto 0.6rem auto; } }
.service-container .provider-info .prov-info h6 {
  margin-bottom: 0; }
.service-container .provider-info .prov-info p {
  margin: 0; }
.service-container .provider-info .prov-info p em {
  font-size: 0.8rem; }
@media (max-width: 25em) {
  .service-container .provider-info .prov-info {
    margin-bottom: 1rem; } }
.service-container .provider-info .prov-details {
  margin-left: 2rem;
  flex-basis: calc(100% - 140px); }
.service-container .provider-info .prov-details .loc span {
  font-size: 0.8rem;
  color: #17a3ff; }
.service-container .provider-info .prov-details .loc em {
  font-size: 0.77rem; }
.service-container .provider-info .prov-details p {
  font-size: 0.9rem;
  width: 90%; }
.service-container .provider-info .prov-social a {
  text-decoration: none;
  display: inline-block;
  margin-right: 0.5rem; }
.service-container .provider-info .prov-social a i {
  transition: color 500ms; }
.service-container .provider-info .prov-social a i:hover {
  color: #ff008f; }
@media (max-width: 47.5em) {
  .service-container .provider-info {
    width: 90%;
    transform: translateY(-40px); } }
@media (max-width: 25em) {
  .service-container .provider-info {
    width: 96%;
    display: block;
    transform: translateY(0px); } }
.service-container .service-info {
  width: 82%;
  transform: translateY(-50px);
  margin: 0 auto 2rem auto; }
.service-container .service-info .service-description {
  padding: 2rem 1rem;
  background: linear-gradient(to bottom, transparent, white); }
.service-container .service-info .service-description .description {
  width: 90%; }
.service-container .service-info .service-description .chips {
  margin-top: 3rem; }
.service-container .service-info .service-description .privileges {
  margin-top: 3.2rem; }
.service-container .service-info .service-description .privileges h5 {
  margin-bottom: 1.5rem; }
.service-container .service-info .service-description .privileges label {
  display: inline-block;
  margin-right: 1.1rem; }
  .detail-content .gallery .responsive {
    width:100px;
    height:100px;
  }
.popup-gallery a {
display: block;
float: left;
margin-right: 10px;
}
.service-container .service-info .service-description .reviews {
  margin-top: 3rem; }
.service-container .service-info .service-description .reviews h5 {
  margin-bottom: 1.5rem; }
.service-container .service-info .service-description .reviews .comments-detail .comment-sec {
  background: transparent;
  box-shadow: none; }
.service-container .service-info .service-description .review-frm {
  padding: 2rem;
  margin-top: 2rem;
  border-top: 1px solid #e8e8e8; }
.service-container .service-info .service-description .review-frm form .rate {
  margin-bottom: 1rem; }
.service-container .service-info .service-description .review-frm form .rate a {
  text-decoration: none;
  display: inline-block;
  margin-right: 7px;
  transition: transform 500ms; }
.service-container .service-info .service-description .review-frm form .rate a i {
  color: #ffa600; }
.service-container .service-info .service-description .review-frm form .rate a:hover {
  transform: scale(1.15); }
.service-container .service-info .service-description .review-frm form textarea {
  height: auto; }
.service-container .service-info .service-sidebar {
  padding: 2rem 1rem 0 0; }
.service-container .service-info .service-sidebar .cont-info {
  margin-bottom: 2rem; }
.service-container .service-info .service-sidebar .cont-info li {
  margin-bottom: 0.4rem; }
.service-container .service-info .service-sidebar .cont-info li i {
  display: inline-block;
  margin-right: 0.5rem; }
.service-container .service-info .service-sidebar #map {
  width: 100%;
  height: 350px; }
.service-container .service-info .service-sidebar form {
  margin-top: 2rem; }
.service-container .service-info .service-sidebar form textarea {
  height: auto; }
@media (max-width: 25em) {
  .service-container .service-info {
    transform: translateY(0); } }

.service-sidebar {
  padding: 2rem 1rem 0 0; }
.service-sidebar .cont-info {
  margin-bottom: 2rem; }
.service-sidebar .cont-info li {
  margin-bottom: 0.4rem; }
.service-sidebar .cont-info li i {
  display: inline-block;
  margin-right: 0.5rem; }
.service-sidebar #map {
  width: 100%;
  height: 350px; }
.service-sidebar form {
  margin-top: 2rem; }
.service-sidebar form textarea {
  height: auto; }

.reviews {
  margin-top: 3rem; }
.reviews h5 {
  margin-bottom: 1.5rem; }
.reviews .comments-detail .comment-sec {
  background: transparent;
  box-shadow: none; }

.review-frm {
  padding: 2rem;
  margin-top: 2rem;
  border-top: 1px solid #e8e8e8; }
.review-frm form .rate {
  margin-bottom: 1rem; }
.review-frm form .rate a {
  text-decoration: none;
  display: inline-block;
  margin-right: 7px;
  transition: transform 500ms; }
.review-frm form .rate a i {
  color: #ffa600; }
.review-frm form .rate a:hover {
  transform: scale(1.15); }
.review-frm form textarea {
  height: auto; }
@media (max-width: 25em) {
  .review-frm {
    padding: 0.5rem; } }


    /* -- chips -- */
.chip {
  display: inline-block;
  text-decoration: none;
  color: #6c757d;
  padding: 3px 15px;
  border-radius: 24px;
  margin: 0 0.5rem 0.5rem 0;
  font-size: 0.9rem;
  box-shadow: 0 1px 5px -1px grey;
  transition: all 500ms ease-in-out; }
.chip:hover {
  text-decoration: none;
  background: #ff00a5;
  color: white; }

/* -- end chips -- */

.reviews {
  margin-top: 3rem; }
.reviews h5 {
  margin-bottom: 1.5rem; }
.reviews .comments-detail .comment-sec {
  background: transparent;
  box-shadow: none; }

.review-frm {
  padding: 2rem;
  margin-top: 2rem;
  border-top: 1px solid #e8e8e8; }
.review-frm form .rate {
  margin-bottom: 1rem; }
.review-frm form .rate a {
  text-decoration: none;
  display: inline-block;
  margin-right: 7px;
  transition: transform 500ms; }
.review-frm form .rate a i {
  color: #ffa600; }
.review-frm form .rate a:hover {
  transform: scale(1.15); }
.review-frm form textarea {
  height: auto; }
@media (max-width: 25em) {
  .review-frm {
    padding: 0.5rem; } }

    
/* -- comments -- */
.comments-detail {
  width: 100%; }
.comments-detail .comment-sec {
  width: 100%;
  margin-bottom: 2rem;
  display: flex;
  background: white;
  padding: 0.9rem;
  border-radius: 4px;
  box-shadow: 0 1px 10px -3px grey; }
.comments-detail .comment-sec .comment-photo {
  flex-basis: auto;
  display: flex;
  flex-direction: column;
  align-items: center;
  margin-right: 1rem; }
.comments-detail .comment-sec .comment-photo .comm-img {
  width: 38px;
  height: 38px;
  border-radius: 50%;
  overflow: hidden; }
.comments-detail .comment-sec .comment-photo i {
  display: inline-block;
  cursor: pointer;
  transition: all 500ms; }
.comments-detail .comment-sec .comment-photo i.fa-heart {
  margin: 0.5rem 0 0.3rem 0;
  color: purple; }
.comments-detail .comment .comment-photo i.fa-share-alt {
  color: #17a3ff; }
.comments-detail .comment-sec .comment-photo i:hover {
  color: #ff008f;
  transform: scale(1.1); }
@media (max-width: 25em) {
  .comments-detail .comment-sec .comment-photo {
    flex-direction: row;
    margin-bottom: 1rem; }
  .comments-detail .comment-sec .comment-photo .comm-img {
    margin-right: 1rem; }
  .comments-detail .comment-sec .comment-photo .fa-heart {
    margin: 0.5rem 1rem 0.3rem 0 !important; } }
.comments-detail .comment-sec .comment-info .comment-name {
  margin-bottom: 0;
  font-weight: 600; }
.comments-detail .comment-sec .comment-info i {
  font-size: 0.70rem; }
.comments-detail .comment-sec .comment-info p {
  margin-bottom: 0;
  font-size: 0.92rem; }
@media (max-width: 25em) {
  .comments-detail .comment-sec {
    flex-direction: column; } }

/* -- end comments -- */

/* right side box section */
.box {
  width: 100%;
  border-radius: 2px;
  box-shadow: 0 2px 1px -1px lightgrey;
  background: white;
  margin-bottom: 2rem; }
.box .post {
  width: 100%;
  border-radius: inherit; }
.box .post img {
  width: 100%;
  border-radius: 2px 2px 0 0; }
.box .post .post-content {
  width: 100%;
  padding: 1rem 2rem; }
.box .post .post-content .post-tags {
  width: 100%;
  text-align: center;
  margin-bottom: 1rem; }
.box .post .post-content .post-tags span {
  display: inline-block;
  margin-right: 0.8rem;
  padding: 4px 15px;
  border: 2px solid rgba(0, 20, 121, 0.5);
  font-size: 0.7rem;
  font-weight: 600;
  text-transform: uppercase;
  border-radius: 3px;
  color: rgba(0, 20, 121, 0.5); }
.box .post .post-content .post-title {
  padding: 0 2rem;
  text-align: center;
  font-weight: 900;
  color: #373737;
  line-height: 1.4;
  margin-bottom: 2rem; }
@media (max-width: 25em) {
  .box .post .post-content .post-title {
    padding: 0 0.8rem;
    font-size: 0.9rem; } }
.box .post .post-content p {
  color: #435861; }
.box .post .post-action {
  width: 100%;
  border-top: 1px solid #e2e2e2;
  padding: 0.5rem 2rem;
  display: flex;
  justify-content: space-between; }
.box .post .post-action .date {
  display: inline-block;
  padding: 4px 15px;
  border: 1px solid lightgrey;
  border-radius: 3px;
  text-transform: uppercase;
  font-size: 0.6rem;
  font-weight: 600; }
.box .post .post-action .social i {
  display: inline-block;
  margin-right: 5px;
  cursor: pointer;
  font-size: 0.9rem;
  color: lightgrey;
  transition: color 500ms; }
.box .post .post-action .social i:hover {
  color: #3197EE; }
@media (max-width: 25em) {
  .box .post .post-action {
    display: block;
    text-align: center; } }
.box .post .post-comments {
  width: 100%;
  border-top: 1px solid #e2e2e2;
  padding: 2rem 2rem; }
.box .post .post-comments .comments .comment {
  box-shadow: 0 2px 1px -1px lightgrey; }
.box .post .post-comments textarea {
  height: auto;
  margin-top: 1rem; }
.box .abt {
  display: flex;
  flex-direction: column;
  align-items: center; }
.box .abt span {
  font-size: 0.9rem;
  text-align: center; }
.box .abt-img {
  width: 150px;
  height: 150px;
  border-radius: 50%;
  margin-bottom: 1rem; }
.box .abt-img img {
  width: 100%;
  border-radius: 50%; }
.box .connect-social {
  width: 100%;
  display: flex;
  justify-content: center; }
.box .connect-social a {
  text-decoration: none;
  display: inline-block;
  margin-right: 10px; }
.box .recent-stories a {
  display: block;
  font-weight: 600;
  font-size: 0.84rem;
  color: #465c66;
  margin-bottom: 10px; }

  .text-center {
    text-align: center !important;
}
/* right side box section ends heres*/

/* -- rating stars -- */
.rating-stars i {
  display: inline-block;
  margin: 0 0.1rem 0.3rem 0;
  color: #607d8b; }
.rating-stars i.yel {
  color: #ff9a06; }

/* -- end rating stars -- */

/*service side bar*/
.service-container .service-info .service-sidebar {
  padding: 2rem 1rem 0 0; }
.service-container .service-info .service-sidebar .cont-info {
  margin-bottom: 2rem; }
.service-container .service-info .service-sidebar .cont-info li {
  margin-bottom: 0.4rem; }
.service-container .service-info .service-sidebar .cont-info li i {
  display: inline-block;
  margin-right: 0.5rem; }
.service-container .service-info .service-sidebar #map {
  width: 100%;
  height: 350px; }
.service-container .service-info .service-sidebar form {
  margin-top: 2rem; }
.service-container .service-info .service-sidebar form textarea {
  height: auto; }
  .service-sidebar {
  padding: 2rem 1rem 0 0; }
.service-sidebar .cont-info {
  margin-bottom: 2rem; }
.service-sidebar .cont-info li {
  margin-bottom: 0.4rem; }
.service-sidebar .cont-info li i {
  display: inline-block;
  margin-right: 0.5rem; }
.service-sidebar #map {
  width: 100%;
  height: 350px; }
.service-sidebar form {
  margin-top: 2rem; }
.service-sidebar form textarea {
  height: auto; }

.listing-detail .detail-aside-section .service-sidebar {
  padding: 1rem;
  background: white;
  border-radius: inherit; }  

  .list-unstyled {
    padding-left: 0;
    list-style: none;
}
/* Ends Here */
    </style>
<script>
$('.datepicker').datepicker({minDate: +1,changeMonth: true,changeYear: true,dateFormat: 'dd-mm-yy'});
</script>
<script type='text/javascript' src='<?php echo skin_url(); ?>js/image_popup.js'></script>    