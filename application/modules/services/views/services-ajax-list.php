
<?php if(!empty($records)) { ?>
	<?php $i=0; foreach($records as $record) {  ?>
		<div class="listing-two-item">
			<div class="cover-photo">
				<img src="img/photographer.jpg" alt="">
				<div class="cover-photo-hover">
					<div class="share-like-two">
						<a href="#"><i class="fa fa-heart-o"></i></a>
						<a href="#"><i class="fa fa-share-alt"></i></a>
						<a href="#"><i class="fa fa-bookmark-o"></i></a>
					</div>
				</div>
			</div>
			<div class="listing-two-item-info">
				<div class="user-two-pic">
					<img src="img/avatar2.jpg" alt="">
				</div>
				<h3><?php echo $record['ser_title']; ?></h3>
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
						<span class="new-price"><?php echo show_price($record['ser_discount_price']);?></span></p>
						<?php } else {
							$sprice = $record['ser_price'];
						?>
						<p><span class="new-price"><?php echo show_price($record['ser_price']);?></span></p>
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