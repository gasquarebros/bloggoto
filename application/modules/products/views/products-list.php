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
    width: 75%;
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
.search-key { 
    width: calc(100% - 90px) !important;
    float:left;
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

.cate_main .cate_list,.subcate_list {
    position: relative
}

.cate_main .cate_list ul, .subcate_list ul {
    padding: 0px
}

.cate_main .cate_list ul:hover, .subcate_list ul:hover {
    opacity: 1
}

.cate_main .cate_list ul li, .subcate_list ul li {
    list-style: none;
    position: relative;
    border-bottom: 1px solid #e9e9e9;
}

.cate_main .cate_list ul li.active a, .subcate_list ul li.active a {
    color: #FE9C1E
}

.cate_main .cate_list>ul>li, .subcate_list > ul > li {
    border-bottom: 1px solid #e9e9e9
}

.cate_main .cate_list>ul>li>a, .subcate_list>ul>li>a {
    display: inline-block;
    padding: 10px 19px 11px 45px
}

.cate_main .cate_list ul li a, .subcate_list ul li a {
    font-size: 15px;
    color: #4e4e4e;
    position: relative;
    transition: all 0.3s ease;
    -webkit-transition: all 0.3s ease;
    display: inline-block;
    padding: 10px 19px 11px 45px;
}

.cate_main .cate_list ul li a:hover, .subcate_list ul li a:hover {
    color: #FE9C1E
}

.cate_main .cate_list ul li a:before, .subcate_list ul li a:before {
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

.cate_main .cate_list ul li a:after, .subcate_list ul li a:before {
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
    -webkit-border-radius: 0px;
    width: calc(100% - 90px);
    float: left;
}

.cate_right .search-operate-box button[type="submit"] {
    border-radius: 0 5px 5px 0;
    -webkit-border-radius: 0 5px 5px 0;
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
.filter_part { 
    width: 20%;
    float: left;
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
.show_less_category, .show_less_subcategory { 
    display:none;
}

#slider-range {
    margin:0px 13px 13px 13px;
}

.ui-slider-range {
    background-color: #2874f0;
}
.ui-slider-handle {
    border-radius: 50%;
}

</style>
<?php
echo load_lib_css(array('malihu-custom-scrollbar-plugin-master/jquery.mCustomScrollbar.min.css'));
?>
<script type="text/javascript" src="<?php echo skin_url(); ?>js/products.js"></script>
<section>
    <div class="container">
        <div class="inner-main flashsale-main leftcatdisplay">
            <div class="category_part">
                <div class="container">
                <div class="cate_left fl">
                    <div class="cate_main">
                        <div class="cate_title">
                            <h6> <i class="fa fa-bars" aria-hidden="true"></i> CATEGORIES </h6>
                        </div>
                        <div class="cate_list">
                            <ul class="mCustomScrollbar">
                                <li class="categories active"><a data-type="">All Categories</a></li>
                            <?php if(!empty($product_category)) { ?>
                                <?php 
                                $active = "category_product";
                                $i=1;
                                foreach($product_category as $prokey=>$productcategory) { 
                                    if($i > 5) { $active="category_product show_less_category"; } ?> 
                                    <li class=" categories <?php echo $active; ?>"> <a data-type="<?php echo $prokey; ?>" href="javascript:void(0)" class=""><?php echo $productcategory; ?></a> </li>
                                <?php $i++; } ?>  
                                <?php if($i > 5) { ?>                      	
                                    <li class="allcategories"> <a class="freedeal_filters">View More</a> </li>
                                    <li class="show_less_category hide_category" style="display:none;"><a class="freedeal_filters">View Less</a></li>
                                <?php } ?>
                            <?php } ?>    
                                    
                            </ul>     
                        </div>
                    </div>
                    <div class="cate_main">
                        <div class="cate_title">
                            <h6> <i class="fa fa-bars" aria-hidden="true"></i> SUB-CATEGORIES </h6>
                        </div>
                        <div class="subcate_list " >
                            <ul class="mCustomScrollbar">
                                <li class="categories active"><a data-type="">All Sub Categories</a></li>
                                <?php 
                                $active = "subcategory_product";
                                $i=1;
                                foreach($product_subcategory as $prokey=>$productsubcategory) { 
                                    if($i > 5) { $active="subcategory_product show_less_subcategory"; } ?> 
                                    <li class="categories <?php echo $active; ?>"> <a data-type="<?php echo $prokey; ?>" href="javascript:void(0)" class=""><?php echo $productsubcategory; ?></a> </li>
                                <?php $i++; } ?>  
                                <?php if($i > 5) { ?>                      	
                                    <li class="allsubcategories"> <a class="freedeal_filters">View More</a> </li>
                                    <li class="show_less_subcategory hide_subcategory" style="display:none;"><a class="freedeal_filters">View Less</a></li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>  
                    <div class="cate_main">
                        <div class="cate_title">
                            <h6> <i class="fa fa-bars" aria-hidden="true"></i> PRICE </h6>
                        </div>            
                        <input type="text" id="amount" readonly style="border:0; color:#f6931f; font-weight:bold;">
                        <input type="text" id="price_from" readonly style="display:none">
                        <input type="text" id="price_end" readonly style="display:none">
                        
                        <div id="slider-range"></div>         
                    </div>                
                </div>
                <div class="cate_right fr">
                    <div class="category_with_search">
                         <?php echo form_open('',' id="common_search" class="form-inline"');?>
                            <div class="search-key-box fl">
                                <div class="form-group field-products-product_name required"> 
                                    <input type="text" id="products-product_name" class="search-key" name="Products[product_name]" placeholder="I'm shopping for..." autocomplete="off"> 
                                    <div class="search-operate-box fl">
                                    <button type="submit" class="search-button"></button> 
                                    </div>
                                </div>
                            </div>
                            <div class="filter_part">
                                <div class="filter_heading"> <span>Sort By</span> </div>
                                <div class="filter_section">
                                    <div class="filter_sortby">
                                        <select id="product-sort" name="sort_by">
                                            <option value="" selected="">Select Sort By</option>
                                            <option value="price-low">Price Low to High</option>
                                            <option value="price-high">Price High to Low</option>
                                            <option value="asc">A-Z </option>
                                            <option value="desc">Z-A </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="clear"></div>
                        <?php echo form_close(); ?>
                        <div class="clear"></div>
                    </div>
                    
                    <br>      

                    <div class="deals_part flash_sale_deals append_html">
                        <!--<div class="deals_part flash_sale_deals">
                            <ul class="append_html">
                            </ul>
                        </div>
                        <div class="more_details_par txtc">
                            <h5> <span> <span class="display_current_count">12</span> of <span class="total_current_count">136</span> </span> </h5>
                            <a data-search="yes" data-type="past" href="/flash-sale" data-nextpage="2" class="common_but lazy_load_flashsale"> <span>Show more</span> </a> 
                        </div>-->
                    </div>
                    <?php echo loading_image('cnt_loading');?>
                </div>
                <div class="clear"></div>
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
        get_content(); 
    });
    $( "#slider-range" ).slider({
        range: true,
        min: 1,
        max: 10000,
        values: [ 1, 10000 ],
        slide: function( event, ui ) {
            $( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
            $('#price_from').val(ui.values[0]);
            $('#price_end').val(ui.values[1]);
        },
        stop: function( event, ui ) {
            get_content();
        },
    });
    $( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) +" - $" + $( "#slider-range" ).slider( "values", 1 ) );
    $('#price_from').val($( "#slider-range" ).slider( "values", 0 ));
    $('#price_end').val($( "#slider-range" ).slider( "values", 1 ));
</script>