<script>
var module_action="addpost";
</script>
<style type="text/css">
table{
    width:100%;
    margin:15px 0;
    border-bottom:0;
    border:1px solid #ddd;
    border-spacing:0;
    border-bottom:0
}
table th{
    text-transform:uppercase;
    font-family:'proxima_nova_rgbold';
    color:#3a3a3a
}
table td, table th{
    border-bottom:1px solid #ddd;
    text-align:left;
    padding:9px 10px;
    border-right:1px solid #ddd
}
.clearfix:after{
    visibility:hidden;
    display:block;
    font-size:0;
    content:" ";
    clear:both;
    height:0
}
.clearfix{
    display:inline-block
}
* html .clearfix{
    height:1%
}
.clearfix{
    display:block
}
.clearfix-third,.clear{
    clear:both
}
.fl{
    float:left
}
.fr{
    float:right
}
.rel{
    position:relative
}
.txtc{
    text-align:center
}
.progress_bar{
    margin-bottom:35px
}
.progress_bar ul{
    padding:0px;
    position:relative;
    font-size:0;
    text-align:center
}
.progress_bar ul:after{
    clear:both;
    display:block;
    content:''
}
.progress_bar ul li{
    list-style:none;
    display:inline-block;
    width:25%;
    text-align:center;
    position:relative
}
.progress_bar ul:before{
    width:100%;
    height:6px;
    background:#eee;
    position:absolute;
    left:0;
    right:0;
    bottom:30px;
    content:'';
    z-index:1
}
.progress_bar ul li a, .progress_bar ul li span{
    display:block
}
.progress_bar ul li span{
    width:70px;
    height:70px;
    margin:15px auto 0;
    line-height:70px;
    background:#eee;
    border-radius:3px;
    -webkit-border-radius:3px;
    position:relative;
    transition:all 0.6s ease;
    -webkit-transition:all 0.6s ease;
    border:1px solid transparent
}
.progress_bar ul li span .lazy{
    position:absolute;
    left:0;
    top:0;
    right:0;
    bottom:0;
    margin:auto
}
.progress_bar ul li span .alternate{
    top:0;
    bottom:0px
}
.progress_bar ul li a:hover span, .progress_bar ul li.active a span{
    border:1px solid #f39125
}
.progress_bar ul li a{
    color:#909090;
    font-family:'proxima_nova_rgbold';
    text-transform:uppercase;
    position:relative;
    z-index:2;
    font-size:16px
}
.progress_bar ul li a:hover, .progress_bar ul li.active a{
    color:#3b3b3b
}
.progress_bar ul li:hover .alternate, .progress_bar ul li.active .alternate, .progress_bar > li > a.active .alternate{
    opacity:1
}
.ship_add_full{
    padding:35px;
    background:#fff
}
.ship_add_full h3{
    color:#3b3b3b;
    text-transform:inherit;
    margin-bottom:30px
}
.ship_add{
    margin-bottom:30px
}
.payment_method_full .fa-info-circle{
    color:#999;
    bottom:2px;
    position:relative
}
.payment_method_full h4{
    font:20px 'proxima_nova_rgbold';
    text-transform:none;
    color:#3b3b3b;
    position:relative
}
.payment_method_outer{
    width:48.5%
}
.payment_method{
    background:#eee
}
.payment_method h4{
    border-bottom:1px solid #cdcdcd;
    margin-bottom:0;
    padding:20px 25px 20px 80px
}
.payment_method h4:before{
    position:absolute;
    left:20px;
    top:19px;
    width:46px;
    height:36px;
    content:'';
    background:url(/images/full_sprite.png) no-repeat scroll -253px 0px transparent
}
.payment_method_outer,.order_summary{
    border-radius:3px;
    -webkit-border-radius:3px
}
.payment_method_inner{
    padding:20px
}
.payment_method_inner ul li .payment_description{
    line-height:20px;
    margin:15px 0 0 0;
    font-size:15px
}
.payment_method_inner ul{
    padding:0px
}
.payment_method_inner ul li{
    list-style:none;
    margin:0 0 15px
}
.payment_method_inner ul li input[type="radio"]{
    margin:5px 8px 5px 5px
}
.payment_method_inner ul li img{
    vertical-align:top
}
.payment_method_inner .field input[type=radio].css-radio:checked+label.css-label{
    background-image:url(/images/two-green.png);
    background-position:0 4px
}
.payment_method_inner ul>li>ul.evalet-inside{
    padding:0 0 0 40px;
    margin:10px 0 0 0
}
.payment_method_inner ul>li>ul.price-range{
    padding:0 0 0 40px;
    margin:5px 0 0 0
}
.payment_method_inner ul li .slider_partial p{
    line-height:normal;
    margin:5px 0 0 0
}
.payment_method_inner ul li .slider_partial p:after{
    clear:both;
    display:block;
    content:''
}
.payment_method_inner ul li .slider_partial p .avail_credit{
    float:left
}
.payment_method_inner ul li .slider_partial p .max_credit{
    float:right
}
.payment_method_inner ul li .slider_partial p .price, .payment_method_inner ul li .slider_partial p .display_amount{
    text-transform:uppercase;
    color:#fe9b1a
}
.payment_method_inner ul li .slider_partial #slider-range-max{
    margin:10px 0 0 8px
}
.ui-state-default, .ui-widget-content .ui-state-default, .ui-widget-header .ui-state-default, .ui-button, html .ui-button.ui-state-disabled:hover, html .ui-button.ui-state-disabled:active{
    border:1px solid #d7d7d7 !important;
    background:#f6f6f6 !important
}
.ui-widget.ui-widget-content{
    border:1px solid #d7d7d7 !important
}
.order_summary{
    width:48.5%;
    border:1px solid #eee
}
.order_summary h4{
    border-bottom:1px solid #cdcdcd;
    margin-bottom:0;
    padding:20px 25px
}
.order_sum_inner .order_item, .order_sum_inner .order_coupon{
    padding:20px
}
.order_sum_inner .order_item table{
    border:none;
    margin:0px
}
.order_sum_inner .order_item .order-total{
    padding:12px 0 0 0;
    border-top:1px solid #e3e3e3
}
.order_sum_inner .order_item .amount-to-pay{
    color:#3b3b3b;
    border-top:1px solid #e3e3e3;
    padding:17px 0 0 0
}
.order_sum_inner .order_item .amount-to-pay th, .order_sum_inner .order_item .amount-to-pay td{
    font-family:'proxima_nova_rgbold';
    font-size:16px;
    color:#3b3b3b;
    padding-bottom:0px
}
.order_sum_inner .order_item .amount-to-pay td{
    font-size:20px
}
.order_sum_inner .order_item table .yellow{
    color:#f39125
}
.order_sum_inner .order_item table th, .order_sum_inner .order_item table td{
    border:none;
    padding:0px 5px 10px 5px;
    text-transform:none;
    color:#787878;
    font-family:'proxima_nova_rgregular'
}
.order_sum_inner .order_item table td{
    text-align:right
}
.order_sum_inner .order_item table td.credits{
    color:#3b3b3b;
    font-family:'proxima_nova_rgbold'
}
.order_summary .order_sum_inner td.credit-part{
    border-top:1px solid #d9d9d9;
    padding-top:15px
}
.order_summary .order_sum_inner td.credit-part td, .order_summary .order_sum_inner td.credit-part th{
    padding:0px
}
.my_order_right .my_order_num{
    color:#FE9B1A
}
.my_order_list .my_order_right .my_ordnum td{
    color:#FE9B1A
}
.order_sum_inner .order_item .total_items{
    color:#3b3b3b;
    font-family:'proxima_nova_rgbold';
    line-height:normal;
    padding-left:5px
}
body.checkout .ui-widget.ui-widget-content{
    border:1px solid #d7d7d7 !important;
    font-size:14px;
    color:#777
}
.order_sum_inner .order_coupen{
    border-top:1px solid #d9d9d9;
    padding:23px
}
.order_sum_inner .order_coupen h6{
    font-family:'proxima_nova_rgbold';
    font-size:16px;
    color:#3b3b3b;
    text-transform:none;
    margin:0 0 15px
}
.order_sum_inner .order_coupen p{
    font-size:15px;
    margin-bottom:0px;
    line-height:normal
}
.order_sum_inner .order_coupen form{
    margin-bottom:25px;
    position:relative;
    padding-right:150px
}
.order_sum_inner .order_coupen .submit_section .clear{
    font-family:'proxima_novasemibold';
    font-size:13px;
    text-transform:uppercase;
    display:inline-block;
    margin-top:5px
}
.order_sum_inner .order_coupen input[type="text"]{
    margin-bottom:0;
    font-size:15px;
    border:2px solid #ccc
}
.order_sum_inner .order_coupen .submit_section{
    position:absolute;
    right:0;
    top:0;
    width:140px;
    min-height:40px;
    text-align:center
}
.order_sum_inner .order_coupen input[type="submit"]{
    border-radius:3px;
    -webkit-border-radius:3px;
    min-width:140px
}
.order_sum_inner .order_coupen form .coupon_error{
    position:absolute;
    color:#f00;
    left:0;
    top:-17px;
    font-size:14px
}
.order_sum_inner .order_total table{
    border:none;
    margin:0px
}
.order_sum_inner .order_total table th, .order_sum_inner .order_total table td{
    border:none;
    padding:5px 0;
    text-transform:none;
    font-family:'proxima_nova_rgbold'
}
.order_sum_inner .order_total table th{
    color:#3b3b3b
}
.order_sum_inner .order_total table td{
    color:#FE9B1A
}
.order_sum_inner .order_total table td{
    text-align:right;
    text-transform:uppercase
}

</style>
<section>
<div class="inner-main">
        <div class="container">
                <!-- Select your Shipping Address -->
<?php             if(!empty($cart_details))
                    {
?>
                <div class="ship_add_full">

                    <div class="progress_bar">
                    <ul>
                        <li>
                            <a href="javascript:void(0);">
                                Profile
                                <span>
                                    <img class="lazy" src="<?php echo media_url().'profile-icon.png';?>" alt="">
                                    <img class="alternate" src="<?php  media_url().'profile-icon-hover.png';?>" alt="">
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="/checkout/shipping">
                                Shipping address
                                <span>
                                    <img class="lazy" src="<?php echo media_url().'ship-icon.png';?>" alt="">
                                    <img class="alternate" src="<?php  media_url().'ship-icon-hover.png';?>" alt="">
                                </span>
                            </a>
                        </li>
                        <li class="active">
                            <a href="javascript:void(0);">
                                Payment
                                <span>
                                    <img class="lazy" src="<?php echo media_url().'payment-icon.png';?>" alt="">
                                    <img class="alternate" src="<?php  media_url().'payment-icon-hover.png';?>" alt="">
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0);">
                                completed
                                <span>
                                    <img class="lazy" src="<?php echo media_url().'complete-icon.png';?>" alt="">
                                    <img class="alternate" src="<?php  media_url().'complete-icon-hover.png';?>" alt="">
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="ship_add payment_method_full">
                    <h3 class="txtc">Select your Payment Method</h3>
                    <div class="order_summary fl">
                        <h4>Order Summary</h4>
                        <div class="order_sum_inner">
                            <div class="order_item">
                                <p class="total_items">(<?php echo $cart_details['cart_total_items'];?>) items</p>
                                <div class="responsive-table">
                                    <table>
                                        <tbody><tr>
                                            <td style="padding:0px;">
                                                <table class="order-subtotal">
                                                    <tbody>
                                                        <tr>
                                                        <th class="yellow">Subtotal:</th>
                                                        <td class="price"><?php echo $cart_details['cart_sub_total'];?></td>
                                                    </tr>
                                                    
                                                    <tr class="coupon_charge_display" style="display:none;">
                                                        <th>Less: Coupon Code Discount</th>
                                                        <td class="price">- S$<span class="coupon_amount_used"></span></td>
                                                    </tr>
                                                     <?php if($cart_details['cart_delivery_charge'] >0)
                                                    {
                                                    ?>
                                                    <tr class="delivery_charge_display">
                                                        <th class="yellow">Delivery Charges</th>
                                                        <td class="price"><?php echo $cart_details['cart_delivery_charge'];?><span class="delivery_amount_used"></span></td>
                                                    </tr>
                                                <?php } ?>
                                                        </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="padding:0px;">
                                                <table class="order-total">
                                                    <tbody><tr>
                                                        <th class="yellow">Total Amount</th>
                                                        <td class="price"><span class="total_amount_to_pay"><?php echo $cart_details['cart_grand_total'];?></span></td>
                                                    </tr>
                                                    <tr class="ewallet_credits_display" style="display:none;">
                                                        <th>Less: E-Wallet Credit</th>
                                                        <td class="price">- S$<span class="ewallet_amount_used"></span></td>
                                                    </tr>
                                                </tbody></table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="padding:0px;">
                                                <table class="amount-to-pay">
                                                    <tbody><tr>
                                                        <th class="subtotal">Amount To Pay</th>
                                                        <td class="price yellow"><span class="amount_payment_made"><?php echo $cart_details['cart_grand_total'];?></span></td>
                                                    </tr>
                                                </tbody></table>
                                            </td>
                                        </tr>
                                    </tbody></table>
                                </div>
                            </div>
                            <div class="order_coupen">
                                <?php /*<h6>Use Coupon Code <span><i class="fa fa-info-circle" data-toggle="tooltip" title="Cashback will not be awarded when use with a coupon discount code." aria-hidden="true"></i></span></h6>
                                <form id="coupon-form" action="/checkout/payment" method="post" enctype="multipart/form-data">                                  <p class="error coupon_error"></p>  
                                    <input type="text" name="coupon_code" id="coupon_code" value="" placeholder="Enter coupon code">
                                    <div class="submit_section"><input type="submit" name="submit_coupon" id="submit_coupon" value="Apply"><a class="clear" href="/checkout/payment">Clear</a></div>
                                    
                                </form> 
                                <p>*Coupon code amount will get discounted from total amount</p>*/ ?>
                            </div>
                        </div>
                    </div>
                    <div class="payment_method_outer fr">
                                                

                                                <div class="payment_method">
                        <h4>Payment Method</h4>
                        <div class="payment_method_inner">
                            <ul>
                                <li class="payment_method_gateway">
                                    <div class="field">
                                        <input type="hidden" name="coupon_code_applied" id="coupon_code_applied" value="">
                                        <input type="hidden" name="coupon_amount_applied" id="coupon_amount_applied" value="">
                                        <input type="hidden" name="order_subtotal" id="order_subtotal" value="<?php echo $cart_details['cart_sub_total'];?>">
                                        <input type="hidden" name="order_total" id="order_total" value="<?php echo $cart_details['cart_grand_total'];?>">
                                        <input type="hidden" name="order_shipping_price" id="order_shipping_price" value="<?php echo $cart_details['cart_delivery_charge'];?>">
                                        <input type="hidden" name="applied_method" id="applied_method" value="">
                                        <input type="radio" name="payment_method" id="payment_method" checked="checked" class="css-radio redirection" value="smoovpay">
                                        <label for="payment_method" class="css-label "><img src="<?php echo media_url().'payment_method.png';?>" alt=""></label>
                                        <p class="payment_description">You will be directed to a 3D Secure™ payment to key in your One-Time Password (OTP) for verification.</p>
                                    </div>
                                </li>
                                <li class="payment_method_ewallet" style="display:none;">
                                    <div class="field">
                                        <input type="radio" name="payment_method_ewallet" id="payment_method_ewallet" checked="checked" class="css-radio redirection" value="smoovpay">
                                        <label for="payment_method_ewallet" class="css-label ">Pay with E-Wallet</label>
                                    </div>
                                </li>

                            </ul>
                        </div>

                    </div>
                    </div>
                    <div class="clear"></div>
                </div>  
                <p class="error_order_summary error"></p>
                <p class="txtc next_but" style="margin-bottom:0px;"><input type="submit" id="proceed_payment" value="Proceed to Payment"></p>
            </div>
            <div class="clear"></div>
            <?php   }
             ?>            
        </div>
    </div>
</section>
<link rel="stylesheet" type="text/css" href="<?php echo skin_url(); ?>css/responsive-style.css">
<script>
function loading()
{
    return  '<img src="'+SITE_URL+'lib/theme/images/loading_icon_default.gif" alt="loading.."  class="loading" />';
}
jQuery("#proceed_payment").click(function (){
	jQuery(this).hide();
	jQuery(this).parent("p").append(loading);
	var current = this;
	jQuery('.error_order_summary').html('');
	var url = SITE_URL;
	var subval = '';
	var usage = '';
	var error =0;

	
    val ="online";

		
		//current.parent('p').append(loading);
		jQuery.ajax({
			url    : url+'checkout/ordervalidate',
			type   : "post",
			dataType:'json',
			data: {'value':val,'secure_key': secure_key},
			success: function (response) 
			{
				jQuery('.loading').remove();
				jQuery(current).show();
				if(response.status == 'success')
				{
					window.location.href=SITE_URL+response.data;
				}
				else{
					if(response.data != "undefined")
					{
						var data = response.data;
					}
					else{
						data = '';
					}
					
					if(response.form_error != "undefined" && response.form_error.length > 0)
					{
						jQuery(".error_order_summary").html(response.form_error);
					}
					else if(data.message != "undefined")
					{
						jQuery(".error_order_summary").html(data.message);
					}
					else
					{
						jQuery(".error_order_summary").html("Something went wrong!!!");
					}
				}

			},
			error : function () 
			{
				console.log("internal server error");
			}
		});
	
});
</script>