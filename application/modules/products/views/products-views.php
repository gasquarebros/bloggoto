<script>
var module_action="addpost";
</script>
<style type="text/css">
.inner_content {
    padding: 50px 0;
}
.common_but {
    position: relative;
    margin: 0px auto;
    font: 14px 'proxima_nova_rgbold';
    overflow: hidden;
    color: #fff;
    display: inline-block;
    z-index: 8;
    transition: all 0.1s ease;
    -webkit-transition: all 0.1s ease;
    background: #25c0d5;
    text-transform: uppercase;
    padding: 7px 10px 6px 10px;
    border-radius: 5px;
    -webkit-border-radius: 5px;
    min-width: 90px;
    text-align: center
}

.common_but:hover,
.common_but:focus {
    background: #2a2a2a;
    color: #fff !important
}

.sale_banner {
    margin: 40px 0
}

.more_details_par .common_but {
    font: 13px/20px 'proxima_nova_rgbold';
    border-radius: 0px;
    background: transparent;
    border: 2px solid #787878;
    padding: 6px 10px 5px 10px;
    min-width: 200px;
    color: #787878
}

.more_details_par .common_but:hover {
    background: #25c0d5;
    color: #fff;
    border: 2px solid #25c0d5
}

.merchant-main .more_details_par .common_but:hover {
    background: #004282;
    color: #fff;
    border: 2px solid #004282
}

.flash_popup {
    background: #fff none repeat scroll 0 0;
    border-radius: 3px;
    box-shadow: 0 0 50px rgba(0, 0, 0, 0.5);
    margin: 80px auto;
    max-width: 1080px;
    padding: 40px;
    position: relative
}

.shopping_cart {
    padding-bottom: 30px
}

.shopping_cart>h2 {
    color: #3a3a3a;
    text-transform: none;
    margin-bottom: 8px
}

.shopping_cart>p {
    font-size: 20px;
    margin-bottom: 20px
}

.shopping_cart > p .small_desc {
    margin-right: 10px
}

.shopping_cart > p .small_desc a {
    transition: all 0.3s ease;
    -webkit-transition: all 0.3s ease;
    color: #787878
}

.shopping_cart > p .small_desc a:hover {
    color: #53a318
}

.shopping_cart > p .star {
    font-size: 17px
}

.shopping_cart > p .star .fa {
    color: #f39125
}

.shopping_cart_left {
    border-right: 1px solid #d3d3d3;
    margin-right: 1.53846%;
    padding-right: 1.53846%;
    width: 62.1538%
}

.shopping_cart_left .slider-part {
    overflow: hidden
}

.shopping_cart_left .slider-part .slider-desc {
    margin-top: 10px
}

.shopping_cart_left .slider-part .slider-desc p {
    line-height: 23px;
    font-size: 16px
}

.shopping_cart_left .slider-part .slider-desc p:last-of-type {
    margin-bottom: 0px
}

.shopping_cart_left .slider-part .desc-part {
    margin-top: 40px
}

.shopping_cart_left .slider-part .desc-part.desc-part-enquiry {
    display: none
}

.shopping_cart_left .ask-question-section {
    margin-bottom: 10px
}

.shopping_cart_left .slider-part .desc-part h3 {
    font-family: 'proxima_novasemibold';
    font-size: 18px;
    text-transform: none;
    color: #3a3a3a;
    line-height: inherit;
    padding-bottom: 15px;
    margin-bottom: 20px;
    position: relative
}

.shopping_cart_left .slider-part .desc-part h3:after {
    position: absolute;
    content: '';
    height: 1px;
    width: 100%;
    background: #d3d3d3;
    left: 0;
    bottom: 0
}

.shopping_cart_left .slider-part .desc-part ul {
    padding: 0 0 0 12px
}

.shopping_cart_left .slider-part .desc-part ul li {
    list-style: none;
    position: relative;
    font-size: 16px;
    padding-left: 18px;
    margin-bottom: 7px
}

.shopping_cart_left .slider-part .desc-part ul li:before {
    position: absolute;
    content: '';
    height: 7px;
    width: 7px;
    background: #3a3a3a;
    left: 0;
    top: 5px;
    border-radius: 50%
}

.shopping_cart_left .slider-part .reviews-part .star {
    font-size: 17px;
    margin-bottom: 15px;
    display: inline-block
}

.shopping_cart_left .slider-part .reviews-part .star .fa {
    color: #f39125;
    margin: 0 3px 0 0
}

.shopping_cart_left .slider-part .reviews-part ul {
    padding: 0px
}

.shopping_cart_left .slider-part .reviews-part ul li {
    padding: 0px;
    margin: 0 0 20px
}

.shopping_cart_left .slider-part .reviews-part ul li:before {
    display: none
}

.shopping_cart_left .slider-part .reviews-part ul li p {
    margin-bottom: 0px;
    color: #3a3a3a
}

.shopping_cart_left .slider-part .reviews-part ul li span {
    color: #888
}

.shopping_cart_left .slider-part .reviews-part .see_all_review {
    font: 17px 'proxima_novasemibold';
    color: #53a318
}

.shopping_cart_left .slider-part .reviews-part .see_all_review:hover {
    color: #3a3a3a
}

.shopping_cart_left .slider-part .desc-part .common_but {
    text-transform: none;
    font-size: 19px;
    background: #53a318;
    padding: 8px 32px;
    cursor: pointer
}

.shopping_cart_left .slider-part .desc-part .common_but:hover {
    background: #2a2a2a
}

.shopping_cart_left .product_enquiry form {
    margin-top: 15px
}

.shopping_cart_left .product_enquiry form:after {
    clear: both;
    display: block;
    content: ''
}

.shopping_cart_left .product_enquiry label {
    display: block;
    margin-bottom: 10px
}

.shopping_cart_left .product_enquiry textarea {
    border: 3px solid #eee;
    height: 140px;
    margin-bottom: 25px
}

.shopping_cart_left .product_enquiry input[type="submit"] {
    float: right;
    width: 150px;
    height: 45px;
    border-radius: 5px;
    -webkit-border-radius: 5px;
    text-transform: none;
    font-size: 20px;
    background: #53a318
}

.shopping_cart_left .product_enquiry input[type="submit"]:hover {
    background: #2a2a2a
}

.shopping_cart_right {
    width: 36.3077%
}

.shopping_cart_right .option-part.simple-product {
    padding-left: 0px
}

.shopping_cart_right .option-part {
    border-bottom: 1px solid #d3d3d3;
    margin-bottom: 20px;
    padding-bottom: 15px;
    position: relative;
}

.shopping_cart_right .option-part .field {
    position: absolute;
    left: 0;
    top: 25px
}

.shopping_cart_right .option-part .prdtitle {
    color: #3a3a3a;
    font: 18px/22px 'proxima_novasemibold';
    display: block;
    margin-bottom: 10px
}

.shopping_cart_right .price-part:after {
    clear: both;
    display: block;
    content: ''
}

.shopping_cart_right .option-part .field input[type=radio].css-radio:checked+label.css-label {
    background-image: url(/images/two-green.png)
}

.shopping_cart_right .attribute_add_error {
    color: #f00;
    margin: 0 0 5px;
    line-height: normal;
    font-size: 14px
}

.shopping_cart_right .price-part span {
    display: inline-block
}

.shopping_cart_right .price-part .price {
    text-align: right;
    float: right
}

.shopping_cart_right .price-part .old-price {
    display: block;
    text-decoration: line-through
}

.shopping_cart_right .price-part .old-price .priceval {
    text-decoration: line-through
}

.shopping_cart_right .price-part .price .new-price {
    font-size: 26px;
    font-family: 'proxima_nova_rgbold';
    color: #53a318
}

.shopping_cart_right .price-part .old-price,
.shopping_cart_right .price-part .price .new-price {
    text-transform: uppercase
}

.shopping_cart_right .price-part .offer {
    color: #53a318;
    border-radius: 3px;
    -webkit-border-radius: 3px;
    padding: 3px 9px;
    margin-right: 20px;
    float: left;
    border: 1px solid #53a318;
    position: relative;
    top: 15px
}

.shopping_cart_right .price-part .sold {
    font-size: 18px;
    position: relative;
    padding-left: 32px;
    float: left;
    position: relative;
    top: 15px;
    line-height: 28px
}

.shopping_cart_right .price-part .sold:before {
    position: absolute;
    left: 0;
    content: url(/images/tag_large.png)
}

.shopping_cart_right .qty-box-full {
    position: relative;
    padding-left: 135px
}

.color-size-ship {
    border-bottom: 1px solid #d3d3d3;
    margin-bottom: 15px;
    position: relative
}


.shopping_cart_right .qty-box {
    position: absolute;
    left: 0
}

.shopping_cart_right .qty-box .title {
    display: inline-block;
    vertical-align: middle;
    margin-right: 5px;
    color: #3a3a3a;
    font-family: 'proxima_nova_rgbold'
}

.qty-full {
    position: relative;
    display: inline-block;
    vertical-align: middle;
    border: 1px solid #d3d3d3;
    border-radius: 2px;
    color: #4e4e4e;
    font-size: 14px;
    font-family: "proxima_novasemibold"
}

.qty-full i {
    cursor: pointer;
    float: left;
    width: 20px;
    height: 40px;
    text-align: center;
    line-height: 40px;
    color: #4e4e4e;
    font-size: 10px
}

.qty-full input {
    float: left;
    border: 0 none;
    display: block;
    width: 40px;
    line-height: 14px;
    margin-top: 6px;
    text-align: center;
    margin: 0;
    padding: 0;
    height: 40px;
    color: #4e4e4e;
    font-size: 14px;
    font-family: "proxima_novasemibold"
}

.shopping_cart_right .common_but {
    display: block;
    font: 18px 'proxima_nova_rgbold';
    padding: 10px 10px;
    background: #53a318;
    max-width: 285px;
    margin: 0;
    cursor: pointer
}

.shopping_cart_right .common_but:hover {
    background: #2a2a2a
}

.shopping_cart_right #makefollow {
    background: #f39125;
    font-size: 15px;
    width: auto;
    display: inline-block;
    padding: 6px 14px;
    text-transform: none;
    vertical-align: middle;
    margin-right: 5px;
    border: none;
    font-family: 'proxima_nova_rgbold';
    color: #fff;
    cursor: pointer;
    border-radius: 5px;
    -webkit-border-radius: 5px;
    display: block
}

.shopping_cart_right #makefollow:hover {
    background: #2a2a2a
}






.deal-redeem {
    border-bottom: 1px solid #d3d3d3;
    padding-bottom: 10px
}

.deal-redeem ul {
    padding: 0px
}

.deal-redeem ul:after {
    clear: both;
    content: '';
    display: block
}

.deal-redeem ul li {
    list-style: none;
    float: left;
    width: 50%;
    text-align: center;
    font-size: 18px;
    line-height: 24px
}

.deal-redeem ul li .icon,
.deal-redeem ul li .day {
    display: block;
    color: #53a318;
    margin-bottom: 7px
}

.deal-redeem ul li .icon {
    font-size: 28px
}

.redeem-offer {
    border-bottom: 1px solid #d3d3d3;
    padding-bottom: 20px;
    padding-top: 20px
}

.redeem-offer-inner {
    position: relative;
    padding-left: 145px;
    min-height: 115px
}

.redeem-offer h6 {
    font-size: 18px;
    color: #3a3a3a;
    text-transform: none;
    margin-bottom: 10px;
    font-family: "proxima_novasemibold"
}

.redeem-offer .img-part {
    width: 130px;
    height: 115px;
    overflow: hidden;
    border: 1px solid #d3d3d3;
    position: absolute;
    left: 0px
}

.redeem-offer .img-part img {
    width: 100%;
    height: 100%;
    object-fit: cover
}

.redeem-offer .cont-part {}

.redeem-offer .cont-part p {
    font: 15px/24px 'proxima_nova_rgbold';
    color: #f39125;
    margin-bottom: 8px
}

.redeem-offer .cont-part h6,
.redeem-offer .cont-part h6 a {
    color: #3a3a3a;
    text-transform: none;
    font: 18px/22px 'proxima_nova_rgbold';
    transition: all 0.3s ease;
    -webkit-transition: all 0.3s ease
}

.redeem-offer .cont-part h6 a:hover {
    color: #53a318
}

.redeem-offer .cont-part .common_but {
    background: #f39125;
    font-size: 15px;
    width: auto;
    display: inline-block;
    padding: 6px 14px;
    text-transform: none;
    vertical-align: middle;
    margin-right: 5px
}

.redeem-offer .cont-part .common_but:hover {
    background: #2a2a2a
}

.redeem-offer .cont-part .show {
    color: #3a3a3a;
    text-decoration: underline
}

.redeem-offer .cont-part .show:hover {
    color: #53a318
}

.redeem-offer-inner .show-redeem-outlet {
    cursor: pointer;
    text-decoration: underline;
    color: #3a3a3a;
    display: inline-block;
    margin-bottom: 10px
}

.redeem-offer-inner .show-redeem-outlet:hover {
    color: #53a318
}

.redeem-offer-inner-section ul {
    padding: 0px;
    margin-top: 15px
}

.redeem-offer-inner-section ul li {
    list-style: none;
    border-bottom: 1px dashed #ccc;
    padding-bottom: 10px;
    margin-bottom: 10px
}

.redeem-offer-inner-section ul li:last-child {
    border: none;
    margin: 0;
    padding: 0
}

.redeem-offer-inner-section ul li .redeem_outlet_name {
    font: 16px 'proxima_novasemibold';
    color: #3a3a3a;
    margin: 0 0 5px
}

.redeem-offer-inner-section ul li .redeem_outlet_address {
    line-height: normal;
    font-size: 15px
}

.redeem-offer-inner-section ul li .redeem_outlet_address:last-of-type {
    margin-bottom: 0px
}

.share_icon {
    position: relative;
    padding-top: 20px;
    margin-bottom: 40px
}

.share_icon span {
    display: inline-block;
    text-transform: uppercase;
    font-size: 14px;
    margin-bottom: 10px
}

.share_icon ul {
    padding: 0px
}

.share_icon ul:after {
    clear: both;
    display: block;
    content: ''
}

.share_icon ul li {
    float: left;
    margin-right: 10px;
    list-style: none
}

.flash_detail_product_popup .shopping_cart_left .slider-part .elevatezoom>img {
    margin: 0 auto;
    display: block;
    max-width: 600px;
    max-height: 600px;
    overflow: hidden
}

.shopping_cart_left .slider-part .elevatezoom #galez {
    margin-top: 15px
}

.shopping_cart_left .slider-part .elevatezoom #galez:after {
    clear: both;
    display: block;
    content: ''
}

.shopping_cart_left .slider-part .elevatezoom #galez a {
    display: block;
    width: 90px;
    height: 90px;
    overflow: hidden;
    float: left;
    margin: 0 10px 10px 0;
    border: 1px solid #e4e4e4;
    padding: 5px;
    transition: all 0.3s ease;
    -webkit-transition: all 0.3s ease
}

.shopping_cart_left .slider-part .elevatezoom #galez a:hover,
.shopping_cart_left .slider-part .elevatezoom #galez a.zoomGalleryActive {
    border: 1px solid #53a318
}

.shopping_cart_left .slider-part .elevatezoom #galez a img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    padding: 0
}

.color-size-ship h6 {
    color: #3a3a3a;
    margin-bottom: 10px;
    font-size: 16px;
}

.color-size-ship ul {
    padding: 0px
}

.color-size-ship ul li {
    list-style: none
}

.color-size-ship .color-part {
    margin-bottom: 15px
}

.color-size-ship .color-part ul:after {
    clear: both;
    display: block;
    content: ''
}

.color-size-ship .color-part ul li.disabled a {
    filter: alpha(opacity=40);
    -moz-opacity: 0.4;
    -khtml-opacity: 0.4;
    opacity: 0.4
}

.color-size-ship .color-part ul li a {
    width: 60px;
    height: 60px;
    overflow: hidden;
    display: block;
    float: left;
    margin: 0 10px 10px 0;
    border: 2px solid #d3d3d3;
    transition: all 0.3s ease;
    -webkit-transition: all 0.3s ease;
    cursor: pointer
}

.color-size-ship .color-part ul li a:hover,
.color-size-ship .color-part ul li a.active {
    border: 2px solid #53a318
}

.color-size-ship .color-part ul li a img {
    width: 100%;
    height: 100%;
    object-fit: cover
}

.color-size-ship .size-part {
    margin-bottom: 20px
}

.color-size-ship .size-part ul:after {
    clear: both;
    display: block;
    content: ''
}

.color-size-ship .size-part ul li {
    float: left;
    margin-right: 10px;
    margin-top: 2px;
    margin-bottom: 2px;
    transition: all 0.2s ease;
    -webkit-transition: all 0.2s ease
}

.color-size-ship .size-part ul li.disabled a {
    filter: alpha(opacity=40);
    -moz-opacity: 0.4;
    -khtml-opacity: 0.4;
    opacity: 0.4
}

.color-size-ship .size-part ul li a {
    font: 14px 'proxima_novasemibold';
    min-width: 28px;
    height: 28px;
    overflow: hidden;
    text-align: center;
    line-height: 28px;
    color: #4e4e4e;
    display: block;
    transition: all 0.3s ease;
    -webkit-transition: all 0.3s ease;
    border: 1px solid #d3d3d3;
    border-radius: 3px;
    -webkit-border-radius: 3px;
    cursor: pointer;
    text-transform: uppercase;
    padding: 0 3px
}

.color-size-ship .size-part ul li a:hover,
.color-size-ship .size-part ul li a.active {
    border: 1px solid #53a318
}

.selectship-part { 
    margin-bottom: 15px;
}
.selectship-part h6 {
    font-size: 16px;
}

</style>
<?php
echo load_lib_css(array('malihu-custom-scrollbar-plugin-master/jquery.mCustomScrollbar.min.css'));
?>

<section>
   <div class="inner_content">
        <div class="container">
            <div class="shopping_cart">
                <h2><?php echo $records[0]['product_name']; ?></h2>
                <p>
                    <span class="small_desc"><a href="<?php echo base_url().'myprofile/'.encode_value($records[0]['customer_id']); ?>"><?php echo $records[0]['customer_username']; ?></a></span>
                </p>

    <div class="shopping_cart_left fl">
        <div class="slider-part">
            <div class="zoom-slider">
                <?php if($records[0]['product_thumbnail'] !='') {
                    $img_thumb = media_url(). $this->lang->line('product_main_image_folder_name')."/".$records[0]['product_thumbnail'];
                } else { $img_thumb = "" ; } 
                ?>
                <img class="" id="zoom_image" src="<?php echo $img_thumb; ?>">
                <?php 
                if(!empty($gallery_images)) { ?>
                    <div id="gal1">
                    <?php
                        foreach($gallery_images as $gallery) {
                    ?>       
                            <a href="#" data-image="<?php echo media_url()."/". $this->lang->line('product_gallery_image_folder_name')."/".$gallery['pro_gallery_image'];?>" data-zoom-image="<?php echo media_url()."/". $this->lang->line('product_gallery_image_folder_name')."/".$gallery['pro_gallery_image'];?>">
                                <img src="<?php echo media_url()."/". $this->lang->line('product_gallery_image_folder_name')."/".$gallery['pro_gallery_image'];?>" />
                            </a>
                        <?php } ?>
                    </div>    
                <?php } ?>
            </div>
            <div class="slider-desc">
                <?php echo $records[0]['product_short_description']; ?>
            </div>
            <div class="desc-part">
                <?php echo $records[0]['product_long_description']; ?>
            </div>
        </div>

    </div>

    <div class="shopping_cart_right fr">
        <div class="option-part subproduct_section">
            <a class="prdtitle subproduct_title_display"><?php echo $records[0]['product_name']; ?></a>
            
            <?php 
            $discount = find_discount($records[0]['product_price'],$records[0]['product_special_price'],$records[0]['product_special_price_from_date'],$records[0]['product_special_price_to_date']);
			if($records[0]['product_special_price'] !='' && $discount > 0) {?>
				<div class="price-part">
					<p class="old-price"><?php echo get_currency_symbol(); ?><span class="priceval"><?php echo ($records[0]['product_price']);?></span></p>
					<p class="new-price"><?php echo get_currency_symbol(); ?><span class="priceval"><?php echo ($records[0]['product_special_price']);?></span></p>
				</div>
			<?php } else { ?>
				<div class="price-part">
					<p class="new-price"><?php echo get_currency_symbol(); ?><span class="priceval"><?php echo ($records[0]['product_price']);?></span></p>
				</div>
			<?php } ?>
        </div>

        <div class="option-part subproduct_section_duplicate" style="display:none">
            <a class="prdtitle subproduct_title_display"><?php echo $records[0]['product_name']; ?></a>
            <?php if($records[0]['product_special_price'] !='' && $discount > 0) {?>
				<div class="price-part">
					<p class="old-price"><?php echo get_currency_symbol(); ?><span class="priceval"><?php echo $records[0]['product_price'];?></span></p>
					<p class="new-price"><?php echo get_currency_symbol(); ?><span class="priceval"><?php echo $records[0]['product_special_price'];?></span></p>
				</div>
			<?php } else { ?>
				<div class="price-part">
					<p class="new-price"><?php echo get_currency_symbol(); ?><span class="priceval"><?php echo ($records[0]['product_price']);?></span></p>
				</div>
			<?php } ?>
            
        </div>
        <?php if($records[0]['product_type'] == 'attribute') { ?>
            <div class="color-size-ship attributes_sections">
            <?php $attribu = 1; foreach($assigned_associate_attributes as $attribute) {  
                if(!empty($attribute['value_id'])) {
                    $class="size-part";
                    if($attribute['pro_modifier_display'] == 'image')
                    {
                        $class="color-part";
                    }
                ?>
                     <div class="value_section_selection <?php echo $class; ?>">
						<h6>SELECT <?php echo $attribute['pro_modifier_name']; ?></h6>
						<ul data-section_selection="sku-<?php echo $attribute['pro_modifier_id']; ?>" >
                            <?php 
                                if($attribute['value_name'] !='') {
                                    $attribute_values_names_array = explode(',',$attribute['value_name'] );
                                    $attribute_values_ids_array = explode(',',$attribute['value_id'] );
                                    $attribute_values_primary_ids_array = explode(',',$attribute['value_primary_id'] );
                                    $attribute_values_images_array = explode(',',$attribute['value_images']);
                                    

                                foreach($attribute_values_ids_array as $key=>$attribute_values) {
								$related_values = '';
							?>
                            <li class="">
                                <?php $mod_id = $attribute['pro_modifier_id']; 
                                    $mod_val_id = $attribute_values_ids_array[$key];
                                    $dataimage= '';
                                ?>
                                <a id="sku-<?php echo $mod_id."~".$mod_val_id; ?>" data-sku-id="<?php echo $mod_val_id; ?>" class="attribute_values" title="<?php echo $attribute_values_names_array[$key]; ?>" data-image="<?php echo $dataimage; ?>" data-sku-related="">
                                    <?php if(!empty($attribute_values_images_array[$key]) && $attribute['pro_modifier_display'] == 'image') { ?><img src="<?php echo $attribute_values_images_array[$key]; ?>"> <?php } else { ?><?php echo $attribute_values_names_array[$key]; ?><?php } ?>
                                </a>
                            </li>
							
							<?php } } ?>
						</ul>
					</div>
				<?php } $attribu++; } ?>
            </div>
        <?php } ?>
    
        <?php if(!empty($assigned_shipping)) { ?>
            <div class="selectship-part">
                <h6>SELECT SHIPPING <span class="estimate"></span></h6>
                <select name="shpping_method" id="shipping_method">
                    <option value="">Select Shipping Method</option>
                    <?php 
                    $enable=0;
                    foreach($assigned_shipping as $product_shipping) { 
                        if($product_shipping['prod_ass_ship_method_is_combined'] == 'Yes') { 
                            $enable = 1; 
                        }
                    ?>
                            <option value="<?php echo encode_value($product_shipping['prod_ass_ship_method_shipid'])."--".$product_shipping['ship_method_name']; ?>"><?php echo $product_shipping['ship_method_name'].' - '.show_price($product_shipping['prod_ass_ship_method_price']); ?></option>
                    <?php } ?>
                </select>
                <?php /* if($enable == 1) { 
                    echo "<p class='shipping_combine_enable'>".($merchant['count_products']>0)?"Available for combine shipping (<a href='".Url::toRoute('merchants/detail/'.$merchant['slug'])."#shopping' target='_self'>".$merchant['count_products']."</a>)":'Available for combine shipping '."</p>";
                } */ ?>
            </div>
        <?php } ?>
            
        <div class="qty-box-full-outer">
            <p class="error qty_exceed_error" style="display:none;"></p>
            <div class="qty-box-full">
                <div class="qty-box">
                    <span class="title">QTY:</span>
                    <span class="qty-full">
								<i class="p-quantity-decrease fa fa-minus page_lefter lefter_cart" data-role="decrease"></i>
								<input readonly="readonly" id="quantity-input" data-maxquantity="<?php echo $records[0]['product_quantity']; ?>" data-role="quantity-input" class="p-quantity-input" name="quantity" type="text" value="1" maxlength="5" autocomplete="off">
								<i data-role="increase" class="p-quantity-increase fa fa-plus page_righter righter_cart"></i>
							</span>
                    <input type="hidden" name="product_id" id="product_id" value="<?php echo encode_value($records[0]['product_primary_id']); ?>">
                    <input type="hidden" name="product_qty" id="product_qty" value="<?php echo $records[0]['product_quantity']; ?>">
                    <input type="hidden" name="product_name" id="product_name" value="<?php echo urlencode($records[0]['product_name']); ?>">
                    <input type="hidden" name="product_sku" id="product_sku" value="<?php echo $records[0]['product_sku']; ?>">
                    <input type="hidden" name="product_slug" id="product_slug" value="<?php echo $records[0]['product_slug']; ?>">
                    <input type="hidden" name="subproduct" id="subproduct" value="">
                </div>
                <?php if(get_user_id() !='') {
                    $buy_url = base_url()."products/add_to_cart";
                    $class="buy_now add_cart";
                } else { 
                    $buy_url = base_url();
                    $class="buy_now";
                } ?>
                <a href="<?php echo $buy_url;?>" title="Buy Now" class="common_but buy_now_btn <?php echo $class; ?>">Buy Now</a>
            </div>
        </div>
        
        <div class="share_icon">
            <span>SHARE THIS DEAL:</span>
            <ul>
                <?php $page_url = base_url()."products/view/".$records[0]['product_slug']; ?>
                <li class="face"><a target="_blank" href="https://www.facebook.com/sharer.php?u=<?php echo $page_url; ?>"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                <li class="goog"><a target="_blank" href="https://plus.google.com/share?url=<?php echo $page_url; ?>"><i class="fa fa-google" aria-hidden="true"></i></a></li>
                <li class="whatsapp"><a target="_blank" href="https://web.whatsapp.com/send?text=<?php echo $page_url; ?>"><i class="fa fa-whatsapp" aria-hidden="true"></i></a></li>
                <li class="twitter"><a target="_blank" href="https://twitter.com/share?text=<?php echo $page_url; ?>"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                <li class="email"><a target="_blank" href="mailto:?subject=Referal&amp;body=<?php echo $page_url; ?>"><i class="fa fa-envelope" aria-hidden="true"></i></a></li>

            </ul>
        </div>
        

        <div class="cancel-policy">
            <h6>Cancellation Policy</h6>
            <p>We accept a 7 days cancellation policy on your purchase with refunds to your E-Wallet. Not valid for in-store cashback purchase. Contact us at <a href="mailto:#">#</a> if you have any enquiries </p>

        </div>

    </div>

    <div class="clear"></div>
</div>
   </div>
</section>

<?php
	echo load_lib_js(array('malihu-custom-scrollbar-plugin-master/jquery.mCustomScrollbar.concat.min.js'));
?>
<script type="text/javascript" src="<?php echo skin_url().'js/jquery.elevatezoom.js' ?>"></script>
<script type="text/javascript" src="<?php echo skin_url(); ?>js/products.js"></script>
<script>
		$("#zoom_image").elevateZoom({gallery:'gal1', cursor: 'pointer', galleryActiveClass: 'active', imageCrossfade: true,"zoomType":"lens","containLensZoom":true,"borderSize":0,"scrollZoom":false, loadingIcon: 'http://www.elevateweb.co.uk/spinner.gif'}); 

//pass the images to Fancybox
$("#zoom_image").bind("click", function(e) {  
  var ez =   $('#zoom_image').data('elevateZoom');	
	$.fancybox(ez.getGalleryList());
  return false;
});

		function trigger_zoom()
		{
			if(jQuery(window).width() <= 640)
			{
				var imageElement = jQuery("#elevatezoom-0");
				jQuery(".zoomContainer").remove();
				jQuery("#elevatezoom-0").removeAttr("data-zoom-image");
				jQuery("#elevatezoom-0").removeData("elevateZoom");
				jQuery("#elevatezoom-0").removeData("zoomImage");
				jQuery.removeData(imageElement, "elevateZoom");
			}
			else
			{
				jQuery("#elevatezoom-0").elevateZoom({"zoomType":"lens","containLensZoom":true,"borderSize":0,"scrollZoom":false,"gallery":"galez"});
			}
		}
		jQuery(window).resize(function() {
			setTimeout(trigger_zoom, 100);
		});
		setTimeout(trigger_zoom, 300);
			
</script>
	<script> 
		$(window).on("load",function(){
			$(".mCustomScrollbar").mCustomScrollbar({
				autoHideScrollbar:true,
			});
        });	
	</script>
<!-- <script>
/*  load initial content.. */
$(window).load(function(){
	$(".mCustomScrollbar").mCustomScrollbar({
		autoHideScrollbar:true,
		   axis:"x", // horizontal scrollbar
		theme:"rounded"
	});	
});
</script> -->