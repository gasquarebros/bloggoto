<div class="container" style="margin-top:40px; margin-bottom:40px; text-align:center;">
<img class="loading-img" src="<?php echo load_lib("theme/images/loading_icon_default.gif"); ?>" alt="">
<h4>Do not refresh the page while your payment is being processed.</h4>
<p>Processing may take a few minutes if our system is very busy.</p>
<button id="rzp-button1">Pay with Razorpay</button>
</div>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<form name='razorpayform' action="<?php echo base_url(); ?>checkout/success" method="POST">
    <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id">
    <input type="hidden" name="razorpay_signature"  id="razorpay_signature" >
</form>
<script>

var options = <?php echo $json?>;

/**
 * The entire list of Checkout fields is available at
 * https://docs.razorpay.com/docs/checkout-form#checkout-fields
 */
options.handler = function (response){
    document.getElementById('razorpay_payment_id').value = response.razorpay_payment_id;
    document.getElementById('razorpay_signature').value = response.razorpay_signature;
    document.razorpayform.submit();
};

options.theme.image_padding = false;

options.modal = {
    ondismiss: function() {
        console.log("This code runs when the popup is closed");
    },
    escape: true,
    backdropclose: false
};

var rzp = new Razorpay(options);

document.getElementById('rzp-button1').onclick = function(e){
    rzp.open();
    e.preventDefault();
}
document.getElementById('rzp-button1').click();
</script>