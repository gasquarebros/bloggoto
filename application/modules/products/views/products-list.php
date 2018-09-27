<script>
var module_action="addpost";
</script>
<style type="text/css">
ul {
    /*margin: 0px !important;*/
}
.inner-main {padding: 20px;}
.mCustomScrollbar{height: 150px;}
.search-key-box {
    width: 100%;
}
.search-key-box input[type="text"] {
    border: none;
    font-family: 'proxima_novasemibold';
    font-size: 17px;
    color: #ffffff;
    height: 55px;
    margin-bottom: 0px;
    padding: 10px 25px;
    border-right: 1px solid #e7e7e7;
    border-radius: 5px 0 0 5px;
}
.cate_left {
    width: 19.0625%
}

.cate_main {
    background: #fff;
    border: 1px solid #ececec;
    box-shadow: 1px 1px 8px #e3e3e3;
    -webkit-box-shadow: 1px 1px 8px #e3e3e3
}

.cate_main .cate_title {
    background: #f5f5f5;
    border-bottom: 1px solid #e9e9e9;
    transition: all 0.3s ease
}

.cate_main .cate_title h6 {
    font: 13px 'proxima_nova_rgbold';
    color: #3a3a3a;
    margin: 0;
    padding: 20px 25px 20px 30px;
    position: relative
}

.cate_main .cate_title h6 .fa {
    position: absolute;
    left: 12px
}

.cate_main .cate_title h6:after {
    content: "\f107";
    position: absolute;
    right: 10px;
    top: 17px;
    font-family: 'FontAwesome';
    font-size: 20px
}

.cate_main .cate_title h6 a {
    color: #FE9B1A
}

.cate_main .cate_title h6 .mer_cat_section {
    color: #4e4e4e
}

.cate_main .cate_list {
    position: relative
}

.cate_main .cate_list ul {
    padding: 0px
}

.cate_main .cate_list ul:hover {
    opacity: 1
}

.cate_main .cate_list ul li {
    list-style: none;
    position: relative
}

.cate_main .cate_list>ul>li {
    border-bottom: 1px solid #e9e9e9
}

.cate_main .cate_list>ul>li>a {
    display: inline-block;
    padding: 10px 19px 11px 45px
}

.cate_main .cate_list ul li a {
    font-size: 15px;
    color: #4e4e4e;
    position: relative;
    transition: all 0.3s ease;
    -webkit-transition: all 0.3s ease
}

.cate_main .cate_list ul li a:hover {
    color: #FE9C1E
}

.cate_main .cate_list ul li a:before {
    background: url(/images/full_sprite.png) no-repeat scroll 0 0 transparent;
    width: 35px;
    height: 35px;
    position: absolute;
    left: 10px;
    top: -7px;
    content: '';
    bottom: 0;
    margin: auto;
    background-position: -3px -1585px
}

.cate_main .cate_list ul li a:after {
    width: 1px;
    height: 39px;
    position: absolute;
    right: -1px;
    top: 0;
    content: '';
    background: #fff;
    z-index: 51;
    display: none
}

.cate_main .cate_list ul li.cat_side_menu_active:hover a:after {
    display: block
}

.cate_main .cate_list ul li span {
    display: none
}

.cate_main .cate_list ul li.allcategories a:before {
    background-position: -183px -887px
}

.cate_main .cate_list ul li.allcategories a:hover:before {
    background-position: -303px -887px
}

.cate_main .cate_list ul li.allcategory a:before {
    background-position: -183px -887px
}

.cate_main .cate_list ul li.allcategory a:hover:before {
    background-position: -303px -887px
}


.category_part .searchbar-form {
    max-width: inherit
}

.category_part .cate_right {
    width: 79.6875%
}

.cate_right #form-freedeal-searchbar,
.cate_right #form-flashsale-searchbar,
.cate_right #form-merchant-searchbar,
.cate_right #form-merchantdetail-searchbar {
    box-shadow: 0 0 20px #c1c1c1;
    -webkit-box-shadow: none;
    max-width: 1275px;
    margin: 0 0 20px;
    border-bottom: 3px solid #2596b1;
    -webkit-border-radius: 0 0 7px 7px;
    border-radius: 0 0 7px 7px
}

.cate_right #form-freedeal-searchbar .search-key-box input[type="text"],
.cate_right #form-flashsale-searchbar .search-key-box input[type="text"],
.cate_right #form-merchant-searchbar .search-key-box input[type="text"],
.cate_right #form-merchantdetail-searchbar .search-key-box input[type="text"] {
    border-radius: 5px 0 0 5px;
    -webkit-border-radius: 5px 0 0 5px
}

.cate_right .searchbar-form .search-key-box input[type="text"] {
    border-radius: 0px;
    -webkit-border-radius: 0px
}

.cate_right .search-operate-box button[type="submit"] {
    border-radius: 0 5px 5px 0;
    -webkit-border-radius: 0 5px 5px 0;
    right: -1px;
    position: absolute;
    top: 0;
    background: url(media/common/search-icon.png) no-repeat scroll center center #00c853;
    height: 55px;
    width: 70px;
    transition: all 0.3s ease;
    -webkit-transition: all 0.3s ease;
    padding: 5px;
    border: none;
    cursor: pointer
}
.cate_right .search-operate-box button[type="submit"]:hover {
    background: url(media/common/search-icon.png) no-repeat scroll center center #2596b1;
}

.cate_banner {
    margin-bottom: 40px;
}

.cate_banner_left,
.cate_banner_right {
    width: 49.254901960784314%;
}


.category_with_search {
    margin-bottom: 20px;
    position: relative;
    z-index: 52
}
.deals_part h3 {
    font-family: 'proxima_nova_rgregular';
    letter-spacing: 1px;
    color: #3a3a3a;
    text-align: center;
    margin: 0 0 40px
}

.deals_part h3 span {
    position: relative
}

.deals_part h3 span:before,
.deals_part h3 span:after {
    width: 40px;
    height: 2px;
    background: #3a3a3a;
    position: absolute;
    left: -90px;
    top: 0;
    bottom: 0;
    margin: auto;
    content: '';
    transition: all 0.4s ease;
    -webkit-transition: all 0.4s ease
}

.deals_part h3 span:after {
    right: -90px;
    left: inherit
}

.deals_part:hover h3 span:before {
    left: -50px
}

.deals_part:hover h3 span:after {
    right: -50px
}

.deals_part ul {
    padding: 0px
}

.deals_part ul:after {
    clear: both;
    display: block;
    content: ''
}

.deals_part ul li {
    list-style: none;
    float: left;
    background: #fff;
    width: 32.282352941176473%;
    margin-right: 1.568627450980392%;
    margin-bottom: 1.568627450980392%;
    position: relative;
    padding: 15px 15px 15px 15px
}

.deals_part ul li:hover {
    box-shadow: 0 0 10px rgb(204, 204, 204);
    -webkit-box-shadow: 0 0 10px rgb(204, 204, 204)
}

.deals_part ul li:nth-child(3n+3) {
    margin-right: 0px
}

.deals_part ul li .img_part {
    position: relative;
    overflow: hidden;
    text-align: center;
    width: 100%;
    margin-bottom: 17px
}

.deals_part ul li .img_part .deal_icon {
    position: absolute;
    z-index: 1;
    max-width: 60px;
    right: 5px;
    bottom: 5px
}

.deals_part ul li .cont_part {
    padding: 10px 10px 15px 10px
}

.deals_part ul li .cont_part .freedeals_list_bottom {
    min-height: 35px
}

.deals_part ul li .cont_part .freedeals_list_bottom:after {
    clear: both;
    display: block;
    content: ''
}

.deals_part ul li .cont_part .freedeals_list_bottom .quiz_merchant_sec,
.deals_part ul li .cont_part .freedeals_list_bottom .endby {
    float: left;
    width: 48.5%
}

.deals_part ul li .cont_part .freedeals_list_bottom .endby {
    float: right;
    text-align: right
}

.deals_part ul li .cont_part .sub_offer {
    color: #d92b2e;
    font: 16px 'proxima_nova_rgbold';
    margin: 0 0 10px
}

.deals_part ul li .cont_part a {
    color: #2a2a2a;
    transition: all 0.3s ease;
    -webkit-transition: all 0.3s ease
}

.deals_part ul li .cont_part a.quiz_merchant_sec {
    font: 14px 'proxima_nova_rgbold'
}

.deals_part ul li .cont_part .quiz_merchant_title {
    font-size: 13px;
    text-transform: none;
    margin-bottom: 10px
}

.deals_part ul li .cont_part a:hover {
    color: #25c0d5
}

.deals_part ul li .cont_part .endby {
    margin: 0px;
    color: #2a2a2a;
    font: 14px 'proxima_nova_rgbold';
    min-height: 35px
}

.deals_part ul li .cont_part .endby span {
    font-family: 'proxima_nova_rgbold'
}

.deals_part ul li .cont_part .endby span:nth-child(2) {
    color: #25C6E1
}

.deals_part ul li .cont_part p {
    margin-bottom: 12px;
    line-height: normal;
    font-size: 14px;
    max-height: 38px;
    overflow: hidden
}

.deals_part ul li .cont_part .quiz_list_title {
    font-family: "proxima_nova_rgbold";
    text-transform: none;
    font-size: 15px;
    line-height: normal
}

.deals_part ul li .cont_part .quiz_list_title a,
.deals_part ul li .cont_part .quiz_list_title span {
    display: block
}

.deals_part ul li .cont_part .quiz_description {
    font: 14px 'proxima_nova_rgregular';
    max-height: 32px
}

.deals_part ul li .cont_part .startby {
    margin: 0px;
    color: #2a2a2a;
    font: 14px 'proxima_nova_rgbold';
    min-height: 35px
}

.deals_part ul li .cont_part .startby span {
    font-family: 'proxima_nova_rgbold'
}

.deals_part ul li .cont_part .startby span:nth-child(2) {
    color: #25C6E1
}

.deals_part ul li .button_bar {
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

.deals_part ul li:hover .button_bar {
    filter: alpha(opacity=100);
    -moz-opacity: 1;
    -khtml-opacity: 1;
    opacity: 1
}

.deals_part ul li .button_bar .common_but {
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

.deals_part ul li .button_bar .common_but:hover {
    border: 1px solid #25c0d5;
    color: #25c0d5;
    background-color: #fff
}

.deals_part ul li .button_bar .common_but:hover span {
    color: #25c0d5
}

.deals_part ul li .button_bar:before {
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

.flashsale-main .deals_part ul li .img_part {
    position: relative
}

.flashsale-main .deals_part ul li .img_part img {
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


input[type="text"],
input[type="email"],
input[type="password"],
textarea,
select {
    padding: 5px 10px;
    border: 1px solid #ccc;
    line-height: 20px;
    width: 100%;
    margin: 0 0 10px;
    background-color: #fff;
    -webkit-border-radius: 0px;
    -moz-border-radius: 0px;
    border-radius: 0px;
    height: 40px;
    font-family: 'proxima_nova_rgregular';
    font-size: 16px;
    color: #787878;
    transition: all 0.3s ease;
    -webkit-transition: all 0.3s ease;
}
</style>
<?php
echo load_lib_css(array('malihu-custom-scrollbar-plugin-master/jquery.mCustomScrollbar.min.css'));
?>

<section>
   <div class="container">
      <h2 class="main_heading">Magazines</h2>
<!--       <div class="section_menu">
			<?php if(!empty($product_category)) { ?>
         <ul class="category_menu blog_category">
				<?php $active = "active";
				foreach($product_category as $prokey=>$productcategory) { ?>         	
            <li> <a data-type="" href="javascript:void(0)" class="	active"><?php echo $productcategory; ?></a> </li>
				<?php $active=''; } ?>
         </ul>
			<?php } ?>         
         <a href="javascript:void(0)" class="more_items"> <i class="fa fa-angle-double-down" aria-hidden="true"></i> </a> 
      </div> -->
      <div class="inner-main flashsale-main leftcatdisplay">
         <div class="category_part">
            <div class="container">
               <div class="cate_left fl">
                  <div class="cate_main">
                     <div class="cate_title">
                        <h6> <i class="fa fa-bars" aria-hidden="true"></i> View By CATEGORIES </h6>
                     </div>
                     <div class="cate_list">
			<?php if(!empty($product_category)) { ?>
                        <ul class="mCustomScrollbar">
				<?php $active = "active";
				foreach($product_category as $prokey=>$productcategory) { ?>         	
            <li> <a data-type="" href="javascript:void(0)" class="	active"><?php echo $productcategory; ?></a> </li>
				<?php $active=''; } ?>                        	
                           <li class="allcategories"> <a class="freedeal_filters" data-slug="" href="/flash-sale">View All Categories</a> </li>
                        </ul>
			<?php } ?>         
                     </div>
                  </div>
                  <div class="cate_main">
                     <div class="cate_title">
                        <h6> <i class="fa fa-bars" aria-hidden="true"></i> View By SUB-CATEGORIES </h6>
                     </div>
                     <div class="cate_list mCustomScrollbar" >
                        <ul>
                           <li class="food">
                              <a class="freedeal_filters" data-slug="food-dining" href="/flash-sale/index/food-dining">Food &amp; Dining</a> 
                            </li>
                           <li class="women">
                              <a class="freedeal_filters" data-slug="fashion-accessories" href="/flash-sale/index/fashion-accessories">Fashion &amp; Accessories</a> 
                           </li>
                           <li class="beauty">
                              <a class="freedeal_filters" data-slug="beauty-spas" href="/flash-sale/index/beauty-spas">Beauty &amp; Spas</a> 
                           </li>
                           <li class="toys">
                              <a class="freedeal_filters" data-slug="lifestyle-gifts" href="/flash-sale/index/lifestyle-gifts">Lifestyle &amp; Gifts</a> 
                           </li>
                           <li class="automobile">
                              <a class="freedeal_filters" data-slug="transport-automotive" href="/flash-sale/index/transport-automotive">Transport &amp; Automotive</a> 
                           </li>
                           <li class="digital">
                              <a class="freedeal_filters" data-slug="digital-electronics" href="/flash-sale/index/digital-electronics">Digital &amp; Electronics</a> 
                           </li>
                           <li class="allcategories"> <a class="freedeal_filters" data-slug="" href="/flash-sale">View All Categories</a> </li>                        </ul>
                     </div>
                  </div>                  
               </div>
               <div class="cate_right fr">
                  <div class="category_with_search">
                     <form id="form-flashsale-searchbar" action="/flash-sale" method="post" role="form">
                        <div class="search-key-box fl">
                           <div class="form-group field-products-product_name required"> <input type="text" id="products-product_name" class="search-key" name="Products[product_name]" placeholder="I'm shopping for..." autocomplete="off"> </div>
                        </div>
                        <div class="search-operate-box fl">
                           <button type="submit" class="search-button"></button> 
                        </div>
                        <div class="clear"></div>
                     </form>
                     <div class="clear"></div>
                  </div>
                  <div class="filter_part">
                     <div class="filter_heading"> <span>All Sales</span> </div>
                     <div class="filter_section">

                        <div class="filter_sortby">
                           <select id="flashsale-sort" name="sort_by">
                              <option value="" selected="">Select Sort By</option>
                              <option value="featured">Featured FlashSale</option>
                              <option value="toprated">Top Rated FlashSale</option>
                              <option value="bestselling">Best Selling </option>
                           </select>
                        </div>
                     </div>
                  </div>
                     	<br>      

                  <div class="deals_part flash_sale_deals">
                     <ul>
                        <li style="height: 433px;">
                           <div class="img_part">
                              <a class="main-title  flash_section-any-2-choices-of-castella-spongecakes-for-2-off" title="Any 2 choices of Castella Spongecakes for $2 off" href="<?php echo base_url().'products/view';?>"> <img src="https://freelor.com/frontend/web/images/products/lecastellahYLvAyIXAVfMC-m7uOVJZr7DHW-VP8BE.jpg" alt="Any 2 choices of Castella Spongecakes for $2 off"> </a> <span class="feature-tag"> <img src="/images/featured.png" alt="featured Flash Sale"> </span> 
                              <span class="discount-tag">
                                 11% Off 
                                 <p></p>
                              </span>
                           </div>
                           <div class="cont_part">
                              <a class="main-title  flash_section-any-2-choices-of-castella-spongecakes-for-2-off" title="Any 2 choices of Castella Spongecakes for $2 off" href="/flash-sale/detail/any-2-choices-of-castella-spongecakes-for-2-off">Any 2 choices of Castella Spongecakes for $2 off</a> 
                              <p>Taiwan's famous Le Castella Fluffy Sponge Cakes</p>
                              <a href="<?php echo base_url().'products/view';?>" class="product_merchant">Le Castella Singapore</a> 
                              <div class="discount-part fl txtl">
                                 <p class="discount">5% Cashback</p>
                                 <p class="sold">14 Sold</p>
                              </div>
                              <div class="price-part fr txtr">
                                 <p class="old-price">S$19.80</p>
                                 <p class="new-price">S$17.80</p>
                              </div>
                              <div class="clear"></div>
                           </div>
                           <div class="button_bar"> <a href="<?php echo base_url().'products/view';?>" class=" common_but flash_section-any-2-choices-of-castella-spongecakes-for-2-off"> <span>Buy Now</span> </a> </div>
                        </li>
                        <li style="height: 433px;">
                           <div class="img_part">
                              <a class="main-title  flash_section-hard-shell-aluminum-alloy-abs-polycarbonate-travel-luggage" title="Hard Shell Aluminum Alloy ABS Polycarbonate Travel Luggage" href="<?php echo base_url().'products/view';?>"> <img src="https://freelor.com/frontend/web/images/products/freelor-luggage6Mabld4d1WctuFaMrxqKTEBLfzDiUaB4.jpg" alt="Hard Shell Aluminum Alloy ABS Polycarbonate Travel Luggage"> </a> <span class="feature-tag"> <img src="/images/featured.png" alt="featured Flash Sale"> </span> 
                              <span class="discount-tag">
                                 48% Off 
                                 <p></p>
                              </span>
                           </div>
                           <div class="cont_part">
                              <a class="main-title  flash_section-hard-shell-aluminum-alloy-abs-polycarbonate-travel-luggage" title="Hard Shell Aluminum Alloy ABS Polycarbonate Travel Luggage" href="<?php echo base_url().'products/view';?>">Hard Shell Aluminum Alloy ABS Polycarbonate Travel Luggage</a> 
                              <p>Retro design luggage with multiple size and colors to choose from</p>
                              <a href="/merchants/detail/freelor" class="product_merchant">Freelor.com!</a> 
                              <div class="discount-part fl txtl">
                                 <p class="discount">5% Cashback</p>
                                 <p class="sold">12 Sold</p>
                              </div>
                              <div class="price-part fr txtr">
                                 <p class="old-price">S$150.00</p>
                                 <p class="new-price">S$79.00</p>
                              </div>
                              <div class="clear"></div>
                           </div>
                           <div class="button_bar"> <a href="<?php echo base_url().'products/view';?>" class=" common_but flash_section-hard-shell-aluminum-alloy-abs-polycarbonate-travel-luggage"> <span>Buy Now</span> </a> </div>
                        </li>
                        <li style="height: 433px;">
                           <div class="img_part">
                              <a class="main-title  flash_section-brightime-boxy-fancy-brick-single-watch-winder" title="Brightime Boxy Fancy Brick Single Watch Winder" href="<?php echo base_url().'products/view';?>"> <img src="https://freelor.com/frontend/web/images/products/brightime-boxytqKI0FHsupDFmosTpDe8wUFdPAiNVofv.jpg" alt="Brightime Boxy Fancy Brick Single Watch Winder"> </a> <span class="feature-tag"> <img src="/images/featured.png" alt="featured Flash Sale"> </span> 
                              <span class="discount-tag">
                                 20% Off 
                                 <p></p>
                              </span>
                           </div>
                           <div class="cont_part">
                              <a class="main-title  flash_section-brightime-boxy-fancy-brick-single-watch-winder" title="Brightime Boxy Fancy Brick Single Watch Winder" href="<?php echo base_url().'products/view';?>">Brightime Boxy Fancy Brick Single Watch Winder</a> 
                              <p>Superior Edition of Brick Winder System. Perfect gift for any occasion.</p>
                              <a href="/merchants/detail/brightime" class="product_merchant">Brightime By Championtime</a> 
                              <div class="discount-part fl txtl">
                                 <p class="discount">5% Cashback</p>
                                 <p class="sold">3 Sold</p>
                              </div>
                              <div class="price-part fr txtr">
                                 <p class="old-price">S$198.00</p>
                                 <p class="new-price">S$160.00</p>
                              </div>
                              <div class="clear"></div>
                           </div>
                           <div class="button_bar"> <a href="<?php echo base_url().'products/view';?>" class=" common_but flash_section-brightime-boxy-fancy-brick-single-watch-winder"> <span>Buy Now</span> </a> </div>
                        </li>
                     </ul>
                     <div class="more_details_par txtc">
                        <h5> <span> <span class="display_current_count">12</span> of <span class="total_current_count">136</span> </span> </h5>
                        <a data-search="yes" data-type="past" href="/flash-sale" data-nextpage="2" class="common_but lazy_load_flashsale"> <span>Show more</span> </a> 
                     </div>
                    
                  </div>
               </div>
               <div class="clear"></div>
            </div>
         </div>
      </div>
   </div>
</section>

<?php
	echo load_lib_js(array('malihu-custom-scrollbar-plugin-master/jquery.mCustomScrollbar.concat.min.js'));
?>
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