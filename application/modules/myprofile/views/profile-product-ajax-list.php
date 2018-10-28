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




.list_prod_section {
    list-style: none;
    float: left;
    background: #fff;
    width: 32%;
    margin-right: 1%;
    margin-bottom: 1.568627450980392%;
    position: relative;
    padding: 15px 15px 15px 15px
}

.list_prod_section:hover {
    box-shadow: 0 0 10px rgb(204, 204, 204);
    -webkit-box-shadow: 0 0 10px rgb(204, 204, 204)
}


.list_prod_section .img_part {
    position: relative;
    overflow: hidden;
    text-align: center;
    width: 100%;
    margin-bottom: 17px
}

.list_prod_section .img_part .deal_icon {
    position: absolute;
    z-index: 1;
    max-width: 60px;
    right: 5px;
    bottom: 5px
}

.list_prod_section .cont_part {
    padding: 10px 10px 15px 10px
}

.list_prod_section .cont_part .freedeals_list_bottom {
    min-height: 35px
}

.list_prod_section .cont_part .freedeals_list_bottom:after {
    clear: both;
    display: block;
    content: ''
}

.list_prod_section .cont_part .freedeals_list_bottom .quiz_merchant_sec,
.list_prod_section .cont_part .freedeals_list_bottom .endby {
    float: left;
    width: 48.5%
}

.list_prod_section .cont_part .freedeals_list_bottom .endby {
    float: right;
    text-align: right
}

.list_prod_section .cont_part .sub_offer {
    color: #d92b2e;
    font: 16px 'proxima_nova_rgbold';
    margin: 0 0 10px
}

.list_prod_section .cont_part a {
    color: #2a2a2a;
    transition: all 0.3s ease;
    -webkit-transition: all 0.3s ease
}

.list_prod_section .cont_part a.quiz_merchant_sec {
    font: 14px 'proxima_nova_rgbold'
}

.list_prod_section .cont_part .quiz_merchant_title {
    font-size: 13px;
    text-transform: none;
    margin-bottom: 10px
}

.list_prod_section .cont_part a:hover {
    color: #25c0d5
}

.list_prod_section .cont_part .endby {
    margin: 0px;
    color: #2a2a2a;
    font: 14px 'proxima_nova_rgbold';
    min-height: 35px
}

.list_prod_section .cont_part .endby span {
    font-family: 'proxima_nova_rgbold'
}

.list_prod_section .cont_part .endby span:nth-child(2) {
    color: #25C6E1
}

.list_prod_section .cont_part p {
    margin-bottom: 12px;
    line-height: normal;
    font-size: 14px;
    max-height: 38px;
    overflow: hidden
}

.list_prod_section .cont_part .quiz_list_title {
    font-family: "proxima_nova_rgbold";
    text-transform: none;
    font-size: 15px;
    line-height: normal
}

.list_prod_section .cont_part .quiz_list_title a,
.list_prod_section .cont_part .quiz_list_title span {
    display: block
}

.list_prod_section .cont_part .quiz_description {
    font: 14px 'proxima_nova_rgregular';
    max-height: 32px
}

.list_prod_section .cont_part .startby {
    margin: 0px;
    color: #2a2a2a;
    font: 14px 'proxima_nova_rgbold';
    min-height: 35px
}

.list_prod_section .cont_part .startby span {
    font-family: 'proxima_nova_rgbold'
}

.list_prod_section .cont_part .startby span:nth-child(2) {
    color: #25C6E1
}

.list_prod_section .button_bar {
    text-align: center;
    background: #fff;
    position: absolute;
    left: 0;
    right: 0;
    bottom: -49px;
    padding: 0 10px 10px 10px;
    z-index: 10;
    filter: alpha(opacity=0);
    -moz-opacity: 0;
    -khtml-opacity: 0;
    opacity: 0;
    box-shadow: 0 0 10px rgb(204, 204, 204);
    -webkit-box-shadow: 0 0 10px rgb(204, 204, 204);
    transition: all 0.2s ease;
    -webkit-transition: all 0.2s ease
}

.list_prod_section:hover .button_bar {
    filter: alpha(opacity=100);
    -moz-opacity: 1;
    -khtml-opacity: 1;
    opacity: 1
}

.list_prod_section .button_bar .common_but {
    font-size: 16px;
    width: 100%;
    padding: 11px 10px 9px 10px;
    line-height: normal;
    background-color: #25c0d5;
    border: 1px solid transparent;
    color: #fff;
    display: block;
    border-radius: 4px;
    -webkit-border-radius: 4px
}

.list_prod_section .button_bar .common_but:hover {
    border: 1px solid #25c0d5;
    color: #25c0d5;
    background-color: #fff
}

.list_prod_section .button_bar .common_but:hover span {
    color: #25c0d5
}

.list_prod_section .button_bar:before {
    width: 100%;
    height: 10px;
    background: #fff;
    content: '';
    position: absolute;
    left: 0;
    right: 0;
    top: -10px
}

.more_details_par {
    margin-top: 30px
}
.txtc {
    text-align: center;
}

.more_details_par h5 {
    font-family: 'proxima_nova_rgregular';
    color: #787878;
    text-align: center;
    margin: 0 0 10px;
    font-size: 16px
}

.more_details_par h5 span {
    position: relative
}

.more_details_par h5 > span:before,
.more_details_par h5>span:after {
    width: 26px;
    height: 1px;
    background: #787878;
    position: absolute;
    left: -40px;
    top: 0;
    bottom: 0;
    margin: auto;
    content: '';
    transition: all 0.4s ease;
    -webkit-transition: all 0.4s ease
}

.more_details_par h5>span:after {
    right: -40px;
    left: inherit
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
    color: #787878;
    cursor: pointer;
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
    text-align: center;
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

.flashsale-main .cate_main .cate_list .cat_side_menu {
    width: 320px;
    max-width: 320px
}

.flashsale-main .cate_main .cate_list .cat_side_menu>li {
    float: none;
    width: 100%
}

.flashsale-main .cate_main .cate_list .cat_side_menu .merchant_submenu_inner li {
    float: none
}

.flashsale-main .cate_main .cate_list .cat_side_menu .merchant_submenu_inner li:before {
    display: none
}

.flashsale-main .category_part .cate_right {
    padding-bottom: 20px
}

.flashsale-main .list_prod_section .img_part {
    position: relative
}

.flashsale-main .list_prod_section .img_part img {
    max-height: 195px
}

.flash_sale_deals ul li .img_part .feature-tag,
.flashsale-main .redemption_list .img_part .feature-tag {
    position: absolute;
    left: 0;
    top: 0
}

.flash_sale_deals ul li .cont_part a:hover {
    color: #53a318
}

.flash_sale_deals ul li .cont_part a.main-title {
    font-family: "proxima_nova_rgbold";
    text-transform: none;
    font-size: 15px;
    line-height: normal;
    display: block;
    margin-bottom: 10px;
    max-height: 38px;
    overflow: hidden
}

.flash_sale_deals ul li .cont_part a.main-title:hover {
    color: #53a318
}

.flash_sale_deals ul li .cont_part p {
    font: 14px 'proxima_nova_rgregular';
    max-height: 32px
}

.flash_sale_deals .more_details_par .common_but:hover {
    background: #53a318;
    border: 2px solid #53a318
}

.flash_sale_deals .discount-part .discount {
    color: #67a136;
    font-size: 13px;
    margin-bottom: 7px;
    border: 1px solid #67a136;
    border-radius: 3px;
    -webkit-border-radius: 3px;
    text-align: center;
    padding: 2px 5px
}

.flash_sale_deals .discount-part .sold {
    font-size: 14px;
    font-family: 'proxima_nova_rgregular';
    background: url(/images/tag_big.png) no-repeat scroll left -2px transparent;
    padding: 0 0 0 25px;
    margin: 0;
    background-size: contain
}

.flash_sale_deals .price-part .old-price {
    color: #787878;
    font-size: 14px;
    text-decoration: line-through;
    margin-bottom: 7px
}

.flash_sale_deals .price-part .new-price {
    color: #53a318;
    font-size: 15px;
    font-family: 'proxima_nova_rgbold';
    margin: 0px
}

.flash_sale_deals .price-part .old-price,
.flash_sale_deals .price-part .new-price {
    text-transform: uppercase
}

.flash_sale_deals ul li .button_bar {
    clear: both
}

.flash_sale_deals ul li .button_bar .common_but {
    background-color: #53a318
}

.flash_sale_deals ul li .button_bar .common_but:hover {
    border: 1px solid #53a318;
    color: #53a318;
    background-color: #fff
}

.flash_sale_deals ul li .button_bar .common_but:hover span {
    color: #53a318
}


</style>
<?php if(!empty($records)) { ?>
<ul>
<?php $i=0; foreach($records as $record) {  ?>
	<li class="list_prod_section">
		<?php $discount = find_discount($record['product_price'],$record['product_special_price'],$record['product_special_price_from_date'],$record['product_special_price_to_date']); ?>
		<div class="img_part">
			<?php if($record['product_thumbnail'] !=''){ $photo=media_url().$this->lang->line ( 'product_main_image_folder_name' )."/".$record['product_thumbnail']; } else { $photo=media_url().$this->lang->line('post_photo_folder_name')."default.png"; } ?>
			
			<a class="main-title" title="<?php echo $record['product_name']; ?>" href="<?php echo base_url().'products/view/'.$record['product_slug']; ?>"> 
				<img src="<?php echo $photo; ?>" alt="<?php echo $record['product_name']; ?>" />
			</a>
			<?php if($discount > 0 ) {?>
				<span class="discount-tag">
					<?php echo $discount; ?>% Off 
				</span>
			<?php } ?>
		</div>
		<div class="cont_part">
			<a class="main-title " title="<?php echo $record['product_name']; ?>" href="<?php echo base_url().'products/view/'.$record['product_slug']; ?>"><?php echo $record['product_name']; ?></a> 
			<p><?php echo substr_close_tags($record['product_short_description']); ?></p>

			<a href="<?php echo base_url().urlencode($record['customer_username'])."#products"; ?>" class="product_merchant"><?php echo $record['customer_username']; ?></a> 

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
			<a href="<?php echo base_url().'products/view/'.$record['product_slug']; ?>" class=" common_but"> <span>Buy Now</span> </a> 
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