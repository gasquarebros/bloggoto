<script>
var module_action="addpost";
</script>
<style type="text/css">
.inner_content {
    padding: 50px 0;
}
table {
    width: 100%;
    margin: 15px 0;
    border-bottom: 0;
    border: 1px solid #ddd;
    border-spacing: 0;
    border-bottom: 0
}

table th {
    text-transform: uppercase;
    font-family: 'proxima_nova_rgbold';
    color: #3a3a3a
}

table td,
table th {
    border-bottom: 1px solid #ddd;
    text-align: left;
    padding: 9px 10px;
    border-right: 1px solid #ddd
}

.overlay-scale {
    display: none
}

ins {
    background: #fff9c0
}

.inner-main {
    background: #eee;
    padding: 20px 0
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


.main_shopping_cart {
    position: relative
}

.main_shopping_cart h4 {
    font: 21px 'proxima_nova_rgbold';
    color: #06678e;
    text-transform: none;
    padding-right: 170px
}

.main_shopping_cart h4 span {
    font: 15px 'proxima_nova_rgregular';
    color: #787878
}

.main_shopping_cart .continue_link {
    font: 17px 'proxima_nova_rgregular';
    color: #787878;
    position: absolute;
    right: 0;
    top: 0;
    transition: all 0.2s ease;
    -webkit-transition: all 0.2s ease;
    cursor: pointer
}

.main_shopping_cart .continue_link:hover {
    color: #fe9b1a
}

.main_shopping_cart a.delete-icon {
    display: inline-block;
    transition: all 0.2s ease;
    -webkit-transition: all 0.2s ease
}

.main_shopping_cart a.delete-icon:hover {
    opacity: 0.5
}

.main_shopping_cart .button-part {
    clear: both;
    margin-top: 15px
}

.main_shopping_cart .button-part .button {
    font: 19px 'proxima_novaextrabold';
    background: #2596b1;
    color: #fff;
    text-transform: uppercase;
    padding: 11px 35px;
    border-radius: 5px;
    -webkit-border-radius: 5px;
    transition: all 0.3s ease;
    -webkit-transition: all 0.3s ease;
    float: right
}

.main_shopping_cart .button-part .button:hover {
    background: #004282
}

.main_shopping_cart table {
    font-size: 17px;
    border: 1px solid #bbb;
    border-bottom: 0
}

.main_shopping_cart table th {
    font: 16px 'proxima_novasemibold';
    color: #787878;
    text-transform: none;
    border-right: 0;
    padding: 15px 15px 14px 15px;
    border-bottom: 1px solid #bbb
}

.main_shopping_cart table td.mer_name {
    background: #e3e3e3;
    padding: 10px 15px
}

.main_shopping_cart table td.mer_name span {
    color: #3a3a3a;
    font-family: 'proxima_nova_rgbold'
}

.main_shopping_cart table td.pro_name {
    padding-left: 105px;
    width: 52%
}

.main_shopping_cart table td {
    border-right: 0;
    padding: 25px 15px;
    position: relative;
    border-bottom: 1px solid #bbb
}

.main_shopping_cart table td.pro_name .pro_pic {
    display: inline-block;
    width: 65px;
    height: 65px;
    overflow: hidden;
    position: absolute;
    left: 15px
}

.main_shopping_cart table td.pro_name .desc {
    color: #3b3b3b;
    line-height: 27px;
    margin-bottom: 15px;
    height: 54px
}

.main_shopping_cart table td.pro_name p {
    margin-bottom: 0px
}

.main_shopping_cart table td.pro_name .color img {
    max-width: 25px;
    vertical-align: top
}

.main_shopping_cart table td.pro_name .color,
.main_shopping_cart table td.pro_name .size,
.main_shopping_cart table td.pro_name .qty {
    display: block;
    color: #3a3a3a;
    position: relative;
    line-height: normal;
    margin-bottom: 10px
}

.main_shopping_cart table td.pro_name strong {}

.main_shopping_cart table .inner_table {
    background: #f5f5f5
}

.main_shopping_cart table .inner_table table {
    margin: 0;
    border: none;
    font-size: 16px
}

.main_shopping_cart table .inner_table td {
    padding: 0;
    border: none
}

.main_shopping_cart table td.qty {
    width: 22%
}

.main_shopping_cart table td.qty .qty-txt {
    display: inline-block;
    vertical-align: middle;
    font-size: 15px;
    color: #000;
    padding: 0 5px
}

.main_shopping_cart table td.price {
    width: 12%;
    color: #3a3a3a;
    font: 17px 'proxima_nova_rgbold';
    text-transform: uppercase
}

.main_shopping_cart table td.delete {
    width: 9%;
    text-align: center
}

.main_shopping_cart table td.ship_method {
    width: 40%
}

.main_shopping_cart table td.ship_charge,
.main_shopping_cart table td.ship_price {
    width: 30%
}

.main_shopping_cart table td.ship_method p {
    margin-bottom: 8px;
    line-height: normal
}

.main_shopping_cart table td.ship_method p:last-of-type {
    margin-bottom: 0px
}

.main_shopping_cart table td.ship_method strong {
    font: 16px 'proxima_nova_rgbold';
    color: #3a3a3a
}

.main_shopping_cart table td.ship_charge p {
    margin-bottom: 5px;
    line-height: normal
}

.main_shopping_cart table td.ship_charge p:last-of-type {
    margin-bottom: 0px
}

.main_shopping_cart table td.ship_charge strong,
.main_shopping_cart table td.ship_charge p:last-of-type {
    font: 16px 'proxima_nova_rgbold';
    color: #3a3a3a
}

.main_shopping_cart table td.ship_price {
    text-align: right
}

.main_shopping_cart table td.ship_price p {
    margin-bottom: 0px;
    line-height: normal
}

.main_shopping_cart table td.ship_price strong {
    font: 18px 'proxima_nova_rgbold';
    color: #FE9B1A;
    text-transform: uppercase
}

.buyer_production {
    position: relative;
    margin-top: 20px;
    padding-left: 250px;
    min-height: 50px
}

.buyer_production .continue_link {
    right: inherit;
    left: 0;
    top: 25px
}

.buyer_production .removeall_link {
    left: 0;
    top: 0;
    position: absolute;
    margin-bottom: 0;
    color: #414397;
    transition: all 0.3s ease;
    -webkit-transition: all 0.3s ease;
    text-decoration: underline
}

.buyer_production .removeall_link:hover {
    color: #3a3a3a
}

.buyer_pro_left {
    position: relative;
    padding-left: 43px;
    width: 68.79432624113475%;
    padding-right: 10px;
    display: none
}

.buyer_pro_left h6 {
    font: 17px 'proxima_nova_rgbold';
    color: #3a3a3a;
    text-transform: none;
    padding-top: 6px;
    margin-bottom: 16px
}

.buyer_pro_left h6:before {
    position: absolute;
    left: 0;
    top: 0;
    width: 31px;
    height: 36px;
    content: '';
    background: url(/images/full_sprite.png) no-repeat scroll -261px -49px transparent
}

.buyer_pro_left ul {
    padding: 0px;
    font-size: 15px
}

.buyer_pro_left ul li {
    list-style: none;
    position: relative;
    line-height: normal;
    margin-bottom: 12px;
    padding-left: 17px
}

.buyer_pro_left ul li:before {
    position: absolute;
    left: 0;
    content: "\f0da";
    font-family: 'FontAwesome'
}

.buyer_pro_left .learn_link {
    color: #ec1c49;
    text-decoration: underline;
    transition: all 0.2s ease;
    -webkit-transition: all 0.2s ease
}

.buyer_pro_left .learn_link:hover {
    color: #3a3a3a
}

.buyer_pro_right {
    width: 31.20567375886525%;
    max-width: 240px;
    padding-right: 15px
}

.buyer_pro_right table {
    border: none;
    margin: 0px;
    font-size: 17px
}

.buyer_pro_right table th,
.buyer_pro_right table td {
    border: none;
    padding: 7px 0;
    text-transform: none;
    color: #787878;
    font-family: 'proxima_nova_rgregular'
}

.buyer_pro_right table td {
    text-align: right;
    font-family: 'proxima_novaextrabold';
    color: #3a3a3a;
    text-transform: uppercase
}
.main_shopping_cart table .inner_table {
    background: #f5f5f5;
}
.main_shopping_cart table td {
    border-right: 0;
    padding: 25px 15px;
    position: relative;
    border-bottom: 1px solid #bbb;
}
</style>
<?php
echo load_lib_css(array('malihu-custom-scrollbar-plugin-master/jquery.mCustomScrollbar.min.css'));
?>

<section>
   <div class="inner_content">
   <div class="container">
<div class="main_shopping_cart">
    <h4>Your Shopping Cart <span>(1 Items)</span></h4>
    <a class="continue_link" href="/flash-sale"><i class="fa fa-angle-left" aria-hidden="true"></i> Continue Shopping</a>

    <p class="tablscroll-view" style="display:none;">Scroll to view more <i class="fa fa-long-arrow-right" aria-hidden="true"></i></p>
    <div class="res-table">
        <table>
            <thead>
                <tr>
                    <th>Product Name &amp; Details</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="mer_name" colspan="4">Merchant: <span>Le Castella Singapore</span> </td>
                </tr>
                <tr>
                    <td class="pro_name">
                        <span class="pro_pic">
                                            <img src="https://freelor.com/frontend/web/images/products/lecastellahYLvAyIXAVfMC-m7uOVJZr7DHW-VP8BE.jpg" alt="">
                                        </span>
                        <p class="desc">Any 2 choices of Castella Spongecakes for $2 off</p>
                        <p>

                            <span class="color">First Flavor Choice: <strong>Original</strong></span>

                            <span class="color">Second Flavor Choice: <strong>Cheese</strong></span>

                        </p>
                    </td>
                    <td class="qty">
                        <span class="qty-full">
                                        <i class="p-quantity-decrease fa fa-minus page_lefter" data-role="decrease"></i>
                                        <input data-role="quantity-input" class="p-quantity-input" id="j-p-quantity-input" name="quantity" type="text" value="1" maxlength="5" data-maxquantity="996" autocomplete="off">
                                        <i data-role="increase" class="p-quantity-increase fa fa-plus page_righter"></i>
                                        </span>
                        <span class="qty-txt"><a title="Update Quantity" href="javascript:;" onclick="update_product('MTA2Mw',this);">Update Qty</a></span>
                    </td>
                    <td class="price">S$19.80</td>
                    <td class="delete">
                        <a title="Delete Item" href="javascript:;" onclick="remove_cart_val_product('MTA2Mw',this);" class="delete-icon"><img src="/images/delete-icon.png" alt=""></a>
                    </td>
                </tr>

            </tbody>
        </table>
    </div>
    <p class="tablscroll-view bottom" style="display:none;">Scroll to view more <i class="fa fa-long-arrow-right" aria-hidden="true"></i></p>

    <div class="buyer_production">
        <a href="javascript:;" title="Remove All Item" onclick="deletecart(this);" class="removeall_link">Remove All</a>
        <a class="continue_link" href="/flash-sale"><i class="fa fa-angle-left" aria-hidden="true"></i> Continue Shopping</a>
        <div class="buyer_pro_left fl">
            <h6>Buyer Protection</h6>
            <ul>
                <li><strong>Full Refund</strong> if you don't receive your order</li>
                <li><strong>Full or Partial Refund,</strong> if the item is not as described</li>
            </ul>
            <a href="" class="learn_link">Learn More</a>
        </div>
        <div class="buyer_pro_right fr">
            <table>
                <tbody>
                    <tr>
                        <th>Subtotal:</th>
                        <td>S$19.80</td>
                    </tr>
                    <tr>
                        <th>Total:</th>
                        <td class="total">S$19.80</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="clear"></div>
    </div>
    <div class="button-part">
        <a class="button" title="Proceed to Checkout" href="/checkout">Proceed to Checkout</a>
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