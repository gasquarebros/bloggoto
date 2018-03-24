<script type="text/javascript" src="<?php echo skin_url(); ?>js/products.js"></script>
<section>
    <div class="container">
		<?php if(!empty($records)) { ?>
			<?php foreach($records as $record) { ?>
				<div class="single_feed">
					<div class="feed_wrapper">
						<div class="feed_header">
							<div class="lft_feed_img">
								<?php if(trim($record['product_images']) != '') {
									$gallery = explode(',',$record['product_images']);
								?>
								<ul>
									<?php foreach($gallery as $productimages) { if($productimages !='') { ?>
										<li>
											<?php $photo=media_url().$this->lang->line('product_gallery_image_folder_name')."/".trim($productimages); ?>
											<img src="<?php echo $photo; ?>" alt="Product Gallery" />
										</li>
									<?php } } ?>
								</ul>
								<?php } ?>
							</div>
							<div class="feed_name">
								<h4><?php echo $record['product_name']; ?></h4>
								<p><?php echo $record['product_cost']; ?></p>
								<p><?php echo $record['product_long_description']; ?></p>
							</div>
							<div class="clear"></div>
						</div>

						<div class="feed_body_text">
							<p><span>Product For Sale : </span><?php echo $record['pro_cate_name']; ?></p>
							<p><span>Condition : </span></p>
							<div class="qty_label produ_det_qlt">
								<label>Quantity</label>
								<div class="qlt_select">
									<a href="javascript:;" class="page_lefter lefter_cart"><</a>
									<span><input value="1" onkeypress="return isNumberKey(event)" maxlength="3" id="<?php echo encode_value($record['product_id']); ?>-qty" type="text"></span>
									<a href="javascript:;" class="page_righter righter_cart">></a>
								</div>                        
							</div>
						</div>
						<div class="feed_like_share">
							
							<?php if(get_user_id() !='') {
								$buy_url = base_url()."products/add_to_cart";
								$class="buy_now add_cart";
							} else { 
								$buy_url = base_url();
								$class="buy_now";
							} ?>
							<a id="<?php echo encode_value($record['product_id']); ?>" class="<?php echo $class; ?>" data-id ="<?php echo encode_value($record['product_id']); ?>" href="<?php echo $buy_url; ?>">Add to Cart</a>
						</div>
						<div class="text-center">
						   <div class="" id="" data-id="cart_item_success" style="display:none;">
						   <i class="fa fa-thumbs-o-up" id="cart_item_success1">success</i>
						   </div>
						</div>
					 </div>
				</div>
			<?php }
		} ?>
	</div>
</section>	