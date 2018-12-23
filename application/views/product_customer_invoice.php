<table style="background-color: #ffffff; border-collapse: collapse; margin:0 auto;color: #565656;font-family: Arial, sans-serif;font-size: 14px;line-height: 20px;border:0px;" width="100%" cellspacing="0" cellpadding="0">
    <tbody>
        <tr>
            <td style="padding:12px 20px;background-color: #f7f4f8; color: #3b3b3b; font-family: Arial, sans-serif; font-size: 17px; line-height: 16px;border-bottom: 1px dashed #d0d0d0;border-top: 1px dashed #d0d0d0;"><span style="font-weight: bold; font-size: 16px; ">Customer Details</span>
            </td>
        </tr>
        <tr>
            <td style="padding:20px;">
                <table style="width:100%;border-spacing:0;">
                    <tbody>
                        <tr>
                            <td style="font-size: 14px;color: #565656;    padding: 5px 10px;    line-height: normal;    text-align: left; width:50%;">Order By</td>
                            <td style="font-size: 14px;color: #565656;    padding: 5px 10px;    line-height: normal;    text-align: left;width:50%;"> <?php echo $records[0]['customer_first_name']." ".$records[0]['customer_last_name']; ?> </td>
                        </tr>
                        <tr>
                            <td style="font-size: 14px;color: #565656;    padding: 5px 10px;    line-height: normal;    text-align: left;width:50%;">Customer Mobile No</td>
                            <td style="font-size: 14px;color: #565656;    padding: 5px 10px;    line-height: normal;    text-align: left;width:50%;"> <?php echo $records[0]['customer_phone']; ?> </td>
                        </tr>
                        <tr>
                            <td style="font-size: 14px;color: #565656;    padding: 5px 10px;    line-height: normal;    text-align: left;width:50%;">Customer Email</td>
                            <td style="font-size: 14px;color: #565656;    padding: 5px 10px;    line-height: normal;    text-align: left;width:50%;"> <?php echo $records[0]['customer_email']; ?></td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        <tr>
            <td style="padding:12px 20px;background-color: #f7f4f8; color: #3b3b3b; font-family: Arial, sans-serif; font-size: 17px; line-height: 16px;border-bottom: 1px dashed #d0d0d0;border-top: 1px dashed #d0d0d0;"><span style="font-weight: bold; font-size: 16px; ">Order Items</span>
            </td>
        </tr>
        <tr>
            <td style="padding:20px;">
                <table class="product-table" style="width: 100%; border: 1px solid #e4e4e4; border-spacing:0;">
                    <thead>
                        <tr>
                            <th style="background: #f7f4f8; padding:10px; font-size:15px; text-align: left; width:45%;text-transform:uppercase">Product Details</th>
                            <th style="background: #f7f4f8;  padding:10px; font-size:15px; text-align: center; width:20%;text-transform:uppercase">Quantity</th>
                            <th style="background: #f7f4f8;  padding:10px; font-size:15px; text-align: center; width:20%;text-transform:uppercase">Amount </th>
                        </tr>
                    </thead>
                    <tbody>	
                        <?php if(!empty($records)) { ?> 
                            <?php foreach($records as $record) { 
                                $item_id = $record["item_id"];	
                            ?> 
                                <tr>
                                    <td style="padding:10px; font-size:15px; text-align: left; width:45%;">
                                        <table>
                                            <tr>
                                                <td class="pro_pic" style="padding:5px;"><img src="<?php echo $record['item_image']; ?>" alt="" style="border:1px solid #eaeaea; width:60px;"></td>
                                                <td>
                                                    <table>
                                                        <tr><td>Item Name: <?php echo $record['item_name']; ?></td></tr>
                                                        <tr><td>Sub product Name: <?php echo output_value($record['item_subproduct_name']); ?></td></tr>
                                                        <tr><td>Merchant Name: <?php echo $record['item_merchant_name']; ?></td></tr>
                                                        
                                                        <?php if($record['item_subproductid'] !='') { $item_modifiers = get_order_item_modifier($record['item_id']); 
                                                            if(!empty($item_modifiers)) { ?>
                                                                <tr>
                                                                    <td>
                                                                        <table class="product-table" style="width: 100%; border: 1px solid #e4e4e4; border-spacing:0;">
                                                                            <thead>
                                                                            <tr>
                                                                                <th style="background: #f7f4f8; padding:10px; font-size:15px; text-align: left; width:45%;text-transform:uppercase">Modifier Name</th>
                                                                                <th style="background: #f7f4f8; padding:10px; font-size:15px; text-align: left; width:45%;text-transform:uppercase">Modifier Values</th>
                                                                            </tr>
                                                                            </thead>
                                                                            <?php foreach($item_modifiers as $item_modifier) { ?>
                                                                                <tr>
                                                                                    <td style="padding:10px; font-size:15px; text-align: left; width:45%;"><?php echo $item_modifier['order_modifier_name']; ?></td>
                                                                                    <td style="padding:10px; font-size:15px; text-align: left; width:45%;"><?php echo $item_modifier['order_modifier_value_name']; ?></td>
                                                                                </tr>
                                                                            <?php } ?>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                        <?php } } ?>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td style="padding:10px; font-size:15px; text-align: center; width:20%;text-transform:uppercase"><?php echo $record['item_qty']; ?></td>
                                    <td style="padding:10px; font-size:15px; text-align: center; width:20%;"><span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span><?php echo number_format($records[0]['item_total_amount'],2); ?></td>
                                </tr>
                                <tr>
                                    <td colspan="4" class="inner_table">
                                        <table style="width:100%;">
                                            <tbody>
                                                <tr>
                                                    <td class="ship_method" style="text-align: left; width:40%;">
                                                        <p>DELIVERY TYPE: <strong><?php echo $record['shipping_name']; ?></strong></p>
                                                    </td>
                                                    <td class="ship_charge" style="text-align: left; width:30%;">
                                                        <p>DELIVERY FEES: <strong><span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span><?php echo number_format($records[0]['shipping_method_price'],2); ?></strong></p>
                                                    </td>
                                                    <td class="select-box" style="text-align: center; width:30%;">
                                                        <table>
                                                            <tbody>
                                                                <tr>
                                                                    <td>
                                                                        <?php echo display_order_status_dropdown($record['item_order_status']); ?>		
                                                                        <input name="orderitems[item_shipping][<?php echo $item_id; ?>]" value="<?php echo $record['shiiping_id']; ?>" type="hidden">
                                                                        <input name="item_status_old[<?php echo $item_id; ?>]" value="<?php echo $record['item_order_status']; ?>" type="hidden">
                                                                    </td>
                                                                    <td>
                                                                        <p <?php if($record['item_order_status'] == 2 || $record['item_order_status'] == 5 ) { ?>style="display:block;" <?php } else { ?>style="display:none;" <?php } ?> class="tracking_code_info"><?php echo $record['shipping_track_code']; ?></p>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            <?php } ?>
                        <?php } ?>
                    </tbody>
                </table>


            </td>
        </tr>

        <tr>
            <td colspan="" style="padding:20px;">
                <table style="width: 100%; border: 1px solid #e4e4e4; border-spacing:0;">
                    <thead>
                        <tr>
                            <th style="background: #f7f4f8; padding:10px; font-size:15px;text-align: left;width:60%"></th>
                            <th style="background: #f7f4f8; padding:10px; font-size:15px;text-align: left;width:20%;">Surcharges</th>
                            <th style="background: #f7f4f8;  padding:10px; font-size:15px;text-align: right; width:20%">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="3">
                                <table style="width: 100%;border-spacing:0;">
                                    <tbody>
                                        <tr>
                                            <td style="width:60%"></td>
                                            <td style="font-size:14px;width:20%; color:#565656;padding:5px 10px; line-height: normal;text-align: left;">Subtotal</td>
                                            <td style="font-size:14px;width:20%; color:#565656;padding:5px 10px; line-height: normal;text-align: right;" class="price"><span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span><?php echo number_format($records[0]['order_sub_total'],2); ?></td>
                                        </tr>

                                        <?php if($records[0]['order_delivery_charge'] > 0) { ?>
                                            <tr>
                                                <td style="width:60%"></td>
                                                <td style="font-size:14px;width:20%; color:#565656;padding:5px 10px; line-height: normal;text-align: left;">Delivery Charge</td>
                                                <td style="font-size:14px;width:20%; color:#565656;padding:5px 10px; line-height: normal;text-align: right;" class="price"><span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span><?php echo number_format($records[0]['order_delivery_charge'],2); ?></td>
                                            </tr>
                                        <?php }	?>													
                                        <tr>
                                            <td style="width:60%"></td>
                                            <td style="width:20%; font-size:14px; color:#565656;padding:5px 10px; line-height: normal;text-align: left;">Grand Total</td>
                                            <td style="width:20%; font-size: 14px; color:#565656;padding:5px 10px; line-height: normal;text-align: right;" class="price"><span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span><?php echo number_format($records[0]['order_total_amount'],2); ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
</table>