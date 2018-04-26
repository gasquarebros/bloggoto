<?php if(!empty($records)) { ?>
<?php $i=0; foreach($records as $record) {  ?>

<div class="list_row">
	<div class="list_col">
		<div class="list_col_inner">
			<div class="list_img">
				<?php if($record['product_thumbnail'] !=''){ $photo=media_url().$this->lang->line ( 'product_main_image_folder_name' )."/".$record['product_thumbnail']; } else { $photo=media_url().$this->lang->line('post_photo_folder_name')."default.png"; } ?>
				<img src="<?php echo $photo; ?>" alt="<?php echo $record['product_name']; ?>" />
			</div>
			<div class="list_decp">
				<h3><a href="<?php echo base_url().$module.'/view/'.$record['product_slug']; ?>"><?php echo $record['product_name']; ?></a></h3>

				<?php echo substr_close_tags($record['product_short_description']); ?>
				<div class="post_by">
					<p><span class="product_price"><?php echo $record['product_price']; ?></span></p>
					<a href="<?php echo base_url().$module.'/view/'.$record['product_slug']; ?>" class="read">Buy Now</a>
				</div>
			</div>
		</div>
	</div>
	<?php $i++; ?>
</div>
<?php } } else if($offset == 0) { ?>
	<div class="list_row">
		<p class="no_records">No Products Found</p>
	</div>
<?php } ?>