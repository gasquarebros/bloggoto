        <div class="main_shopping_cart" id="main_shopping_cart">
<?php
        if(!empty($cart_details))
        {
?>      
        <h4>Your Shopping Cart (<span class="cart-number"><?php echo $cart_details['cart_total_items']; ?> Items</span>)</h4>
        <a class="continue_link" href="<?php echo base_url().'products'; ?>"><i class="fa fa-angle-left" aria-hidden="true"></i> Continue Shopping</a>

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
                <?php
                
                    $proId="";
                    $cart_ship_price=0;
                    $cart_sub_total=0;
                    $cart_ship_price=($cart_details['cart_delivery_charge'] >0)?$cart_details['cart_delivery_charge'] :0;
                    $cart_sub_total=($cart_details['cart_sub_total'])?$cart_details['cart_sub_total']:0;
                    $cart_total=($cart_details['cart_grand_total'])?$cart_details['cart_grand_total']:0;
                    foreach($cart_items as $cart_item)
                    {
                        $item_total_price=$item_ship_price=$item_price=0;
                        $item_ship_price=$cart_item['cart_item_shipping_product_price'];
                        $item_price=($cart_item['cart_item_total_price']);
                        $item_total_price=($item_price+$item_ship_price);

                        $proId=encode_value($cart_item['cart_item_id']);
?>    
                    <tr>
                        <td class="mer_name" colspan="4">Merchant: <span><?php echo output_value($cart_item['cart_item_merchant_name']); ?></span> </td>
                    </tr>
                    <tr>
                        <td class="pro_name">
                            <span class="pro_pic">
                                                <img src="<?php echo media_url().'products/main-image/'.$cart_item['cart_item_product_image']; ?>" alt="">
                                            </span>
                            <p class="desc"><?php echo output_value($cart_item['cart_item_product_name']); ?></p>
                            <p>
                                <?php if($cart_item['attributename'] !='') { 
                                    $item_modifiers = explode(',',$cart_item['attributename']);
                                    $item_modifiers_values = explode(',',$cart_item['attributevaluename']);
								if(!empty($item_modifiers)) { foreach($item_modifiers as $key=>$modifiers) { ?>
                                <span class="color"><?php echo $modifiers; ?> <strong><?php echo $item_modifiers_values[$key]; ?></strong></span>
                                <?php } } } ?>
                            </p>
                        </td>
                        <td class="qty">
                            <span class="qty-full">
                                <i class="p-quantity-decrease fa fa-minus page_lefter" data-role="decrease"></i>
                                <input data-role="quantity-input" class="p-quantity-input" id="j-p-quantity-input" name="quantity" type="text" value="<?php echo output_value($cart_item['cart_item_qty']); ?>" maxlength="5" data-maxquantity="996" autocomplete="off">
                                <i data-role="increase" class="p-quantity-increase fa fa-plus page_righter"></i>
                            </span>
                            <span class="qty-txt">
                                <a title="Update Quantity" class="update_cart_qty" href="<?php echo base_url().'products/updatecartitem/'.encode_value($cart_item['cart_item_id']); ?>" >Update Qty</a>
                            </span>
                        </td>
                        <td class="price"><?php echo show_price($item_price); ?></td>
                        <td class="delete">
                            <a title="Delete Item" class="remove_cart_item" href="<?php echo base_url().'products/removecartitem/'.encode_value($cart_item['cart_item_id']); ?>" class="delete-icon"><i class="fa fa-trash-o" style="font-size:24px;color:red"></i></a>
                        </td>
                    </tr>
                    <?php if($cart_item['cart_item_shiiping_id'] != '' )
                    {
                    ?>
                        <tr>
                            <td colspan="4" class="inner_table">
                                <table>
                                    <tbody><tr>
                                        <td class="ship_method">
                                            <p>Delivery Type: <strong><?php echo $cart_item['shipping_name']; ?></strong></p>
                                        </td>
                                        <td class="ship_charge">
                                            <p>Delivery Fees: <strong><?php echo show_price($cart_item['shipping_method_price']); ?></strong></p>
                                        </td>
                                        <td class="ship_price">
                                            <p>Total Price: <strong><?php echo show_price($item_total_price); ?></strong></p>
                                        </td>
                                    </tr>
                                </tbody></table>
                            </td>
                        </tr>                    
                    <?php } 
                }  ?>
                </tbody>
            </table>
        </div>

        <div class="buyer_production">
            <a class="remove_cart removeall_link" href="<?php echo base_url().'products/removecart/'.encode_value($cart_details['cart_id']); ?>" title="Remove All Item">Remove All</a>
            <a class="continue_link" href="<?php echo base_url().'products'; ?>"><i class="fa fa-angle-left" aria-hidden="true"></i> Continue Shopping</a>
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
                            <td><?php echo show_price($cart_sub_total); ?></td>
                        </tr>
                    <?php if($cart_ship_price>0)
                          {
                    ?>                        
                        <tr>
                            <th>Shipping Fees:</th>
                            <td><?php echo show_price($cart_ship_price); ?></td>
                        </tr>                        
                    <?php } ?>                        
                        <tr>
                            <th>Total:</th>
                            <td class="total"><?php echo show_price($cart_total); ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="clear"></div>
        </div>
        <div class="button-part">
            <a class="button" title="Proceed to Checkout" href="<?php echo base_url().'checkout/shipping'; ?>">Proceed to Checkout</a>
        </div>
<?php
        }
        else
        {
?>           
            <div class="cart-empty txtc">
                <img src="<?php echo media_url().'cart.png'; ?>" alt="cart-empty" style="display:none">
                <h4>Your cart is empty</h4>
                <p>You have to add something first</p>
                <a href="<?php echo base_url().'products'; ?>" title="Order Now" class="button common_but">Order Now</a>
            </div>
<?php } ?>            
    </div>
