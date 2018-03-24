<script>
var module_action="addpost";
</script>
<section>
    <div class="container">
        <h2 class="main_heading">Magazines</h2>
        <div class="section_menu">
			<?php if(!empty($product_category)) { ?>
            <ul class="category_menu blog_category">
				<?php $active = "active";foreach($product_category as $prokey=>$productcategory) { ?>
					<li><a data-type="<?php echo $prokey?>" href="javascript:void(0)" class="<?php echo $active; ?>"><?php echo $productcategory; ?></a></li>
				<?php $active=''; } ?>
            </ul>
			<?php } ?>
            <a href="javascript:void(0)" class="more_items"><i class="fa fa-angle-double-down" aria-hidden="true"></i></a>
			
        </div>
		<div class="sort_by">
            <?php echo form_open('',' id="common_search" class="form-inline"');?>
                <div class="form_field">
					<?php 
					//echo form_dropdown('search_field',$product_category,'','style="width:200px" id="search_category"'); ?>
                </div>
                <div class="form_field">
                <?php 
				$sort_method = array(''=>'All','top_blog'=>'Top Blog');
					echo form_dropdown('order_field',$sort_method,'','style="width:200px"'); ?>
                </div>
				<input type="hidden" name="page_id" id="page_id" value="" />	
				<input type="hidden" name="offset" id="load_offset" value="" />	
            <?php echo form_close(); ?>    
        </div>
        <div class="listing_wrap cntloading_wrapper ">
			<div class="append_html"></div>
			<?php echo loading_image('cnt_loading');?>
        </div>
		<div class="load_more" style="display:none;">
			<button class="more_posts">Load More</button>
		</div>
    </div>
</section>


<script type="text/javascript" src="<?php echo skin_url(); ?>js/products.js"></script>
<script>
/*  load initial content.. */
$(window).load(function(){
	var selection = $('.blog_section li a.active').data('section');
	/*$("#search_category option").removeAttr('selected');
	var values = '';
	$("#search_category option").filter(function() {
		if(this.text == selection)
		values = this.value;
		return this.text == selection; 
	}).attr('selected', true);	
	$('#search_category').trigger("chosen:updated");*/
	get_content();
});
</script>