<style>
.discount-tag {
    position: absolute;
    left: 0;
	bottom: 0;
    background: #53a318;
    color: #ffffff;
    font-family: "proxima_nova_rgbold";
    padding: 5px 10px 5px 10px;
}
.product_merchant {
    font-size: 14px;
    font-family: 'proxima_nova_rgbold';
    color: #2a2a2a;
	font-weight:bold;
    clear: both;
    display: block;
    transition: all 0.3s ease;
    -webkit-transition: all 0.3s ease;
    margin-bottom: 12px;
    max-height: 34px;
    overflow: hidden;
}
.list_prod_section {
	height:400px;
}
</style>
<?php if(!empty($records)) { ?>
<ul>
<?php $i=0; foreach($records as $record) {  ?>
	<li class="list_prod_section">
		<?php $discount = find_discount($record['product_price'],$record['product_special_price'],$record['product_special_price_from_date'],$record['product_special_price_to_date']); ?>
		<div class="img_part">
			<?php if($record['product_thumbnail'] !=''){ $photo=media_url().$this->lang->line ( 'product_main_image_folder_name' )."/".$record['product_thumbnail']; } else { $photo=media_url().$this->lang->line('post_photo_folder_name')."default.png"; } ?>
			
			<a class="main-title" title="<?php echo $record['product_name']; ?>" href="<?php echo base_url().$module.'/view/'.$record['product_slug']; ?>"> 
				<img src="<?php echo $photo; ?>" alt="<?php echo $record['product_name']; ?>" />
			</a>
			<?php if($discount > 0 ) {?>
				<span class="discount-tag">
					<?php echo $discount; ?>% Off 
				</span>
			<?php } ?>
		</div>
		<div class="cont_part">
			<a class="main-title " title="<?php echo $record['product_name']; ?>" href="<?php echo base_url().$module.'/view/'.$record['product_slug']; ?>"><?php echo $record['product_name']; ?></a> 
			<p><?php echo substr_close_tags($record['product_short_description']); ?></p>

			<a href="<?php echo base_url().urlencode($record['customer_username']).'#products'; ?>" class="product_merchant">
				<?php if($record['customer_gst_no'] !='' ) { ?>
                    <i class="fa fa-check-circle"></i> 
                <?php } ?>
			<?php echo $record['customer_username']; ?></a> 

			<?php 
			if($record['product_special_price'] !='' && $discount > 0) {?>
				<div class="price-part fr txtr">
					<p class="old-price"><?php echo show_price($record['product_price']);?></p>
					<p class="new-price"><?php echo show_price($record['product_special_price']);?></p>
				</div>
			<?php } else { ?>
				<div class="price-part fr">
					<p class="new-price"><?php echo show_price($record['product_price']);?></p>
				</div>
			<?php } ?>
			<div class="clear"></div>
		</div>
		<div class="button_bar"> 
			<a href="<?php echo base_url().$module.'/view/'.$record['product_slug']; ?>" class=" common_but"> <span>Buy Now</span> </a> 
		</div>
	</li>
<?php } ?> 
</ul>
<div class="clear"></div>
<div class="more_details_par txtc">
	<h5> <span> <span class="display_current_count"><?php echo $current_records; ?></span> of <span class="total_current_count"><?php echo $total_rows; ?></span> </span> </h5>
	<?php if($current_records < $total_rows) { ?>
		<a data-nextpage="<?php echo $page+1; ?>" class="common_but lazy_load_flashsale load_more"> <span>Show more</span> </a> 
	<?php }  ?>
</div>
<?php
} else if($offset == 0) { ?>
	<div class="list_row">
		<p class="no_records">No Products Found</p>
	</div>
<?php } ?>