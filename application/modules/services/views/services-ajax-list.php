
<?php if(!empty($records)) { ?>
	<?php $i=0; foreach($records as $record) {  ?>
		<div class="listing-two-item">
			<div class="cover-photo">
				<?php $page_url = base_url()."services/view/".$record['ser_slug']; ?>
				<a href="<?php echo $page_url; ?>">
				<?php if($record['galleryimages'] !='') {  ?>
					<?php $gallery = explode('~',$record['galleryimages']); ?>
					<img src="<?php echo media_url(). $this->lang->line('service_gallery_image_folder_name')."/".$gallery[0]; ?>" alt="">
				<?php } else { ?>
					<img src="<?php echo media_url().$this->lang->line('post_photo_folder_name')."default.png"; ?>" alt="">
				<?php } ?>
				</a>	

				
                
				<div class="cover-photo-hover">
					<div class="share-like-two">
						<a target="_blank" href="https://www.facebook.com/sharer.php?u=<?php echo $page_url; ?>"><i class="fa fa-facebook"></i></a>
						<a target="_blank" href="https://plus.google.com/share?url=<?php echo $page_url; ?>"><i class="fa fa-google"></i></a>
						<a class="copy_to_clipboard" data-text="<?php echo $page_url; ?>" ><i class="fa fa-copy"></i></a>
						<a target="_blank" href="https://twitter.com/share?text=<?php echo $page_url; ?>"><i class="fa fa-twitter"></i></a>
						<a target="_blank" href="mailto:?subject=Referal&amp;body=<?php echo $page_url; ?>"><i class="fa fa-envelope"></i></a>
					</div>
				</div>
			</div>
			<div class="listing-two-item-info">
				<div class="user-two-pic">
					<?php if($record['customer_photo'] !='') { ?>
                        <img class="service_prof_photo" src="<?php echo media_url(). $this->lang->line('customer_image_folder_name').$record['customer_photo'];?>" alt="profile" />
                    <?php } else { ?> 
                        <img class="service_prof_photo" src="<?php echo skin_url(); ?>images/profile.jpg" alt="profile" />
                    <?php } ?>
				</div>
				<h3><a href="<?php echo $page_url; ?>"><?php echo $record['ser_title']; ?></a></h3>
				<strong><a href="<?php echo base_url().urlencode($record['customer_username']); ?>" class=""><?php echo $record['customer_username']; ?></a> -&gt; </strong> <span class="text-info"><?php echo $record['ser_cate_name']; ?></span>
				<p><?php echo substr_close_tags($record['ser_description']); ?></p>
				<div class="rating-bt">
					<div class="rating-stars">
						<?php $discount = find_discount($record['ser_price'],$record['ser_discount_price'],$record['ser_discount_start_date'],$record['ser_discount_end_date']);
						$sprice = ""; 
						if($record['ser_discount_price'] !='' && $discount > 0) {
							$sprice = $record['ser_discount_price'];
						?>
						<p>
						<span class="old-price"><?php echo show_price($record['ser_price']);?></span>
						<span class="new-price"><?php echo show_price($record['ser_discount_price']);?>/<?php echo $record['ser_pricet_type']; ?></span></p>
						<?php } else {
							$sprice = $record['ser_price'];
						?>
						<p><span class="new-price"><?php echo show_price($record['ser_price']);?></span>/<?php echo $record['ser_pricet_type']; ?></p>
						<?php } ?>
					</div>
					<?php /*<div class="rating-stars">
						<i class="fa fa-star yel"></i>
						<i class="fa fa-star yel"></i>
						<i class="fa fa-star yel"></i>
						<i class="fa fa-star-half-empty"></i>
						<i class="fa fa-star-o yel"></i>
						<span>(4.4/345 Reviews)</span>
					</div>*/ ?>
					<a href="<?php echo base_url().$module.'/view/'.$record['ser_slug']; ?>"><strong>View</strong> <i class="fa fa-angle-right"></i></a>
				</div>
			</div>
		</div>
	<?php } ?>
	<div class="clear"></div>
	<div class="more_details_par txtc">
		<h5> <span> <span class="display_current_count"><?php echo $current_records; ?></span> of <span class="total_current_count"><?php echo $total_rows; ?></span> </span> </h5>
		<?php if($current_records < $total_rows) { ?>
			<a data-nextpage="<?php echo $page+1; ?>" class="common_but lazy_load_flashsale load_more"> <span>Show more</span> </a> 
		<?php }  ?>
	</div>
<?php } else if($offset == 0) { ?>
	<div class="list_row" style="width:100%;">
		<p class="no_records">No Products Found</p>
	</div>
<?php } ?>