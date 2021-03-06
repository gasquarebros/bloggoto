<script>
var module_action = '<?php echo 'view/'.encode_value($records[0]['order_primary_id']); ?>';
</script>
<style>
table {
    width: 100%;
}
.page-header {
	margin: 0 auto;
	text-align: center;
	padding: 10px;
}
.card-body {
	width:100%;
}
.mrgtop {
	margin: 10px;
	float: right;
	padding: 5px !important;
}
.pull-right{
	width: 32% !important;
}
</style>
<script>
function printDiv() 
{

  var divToPrint=document.getElementById('DivIdToPrint');

  var newWin=window.open('','Print-Window');

  newWin.document.open();

  newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');

  newWin.document.close();

  setTimeout(function(){newWin.close();},100);

}
</script>
<div class="container-fluid">
	<div class="side-body">
		<div class="row">
			<div class="col-xs-12">
				<div class="card">
					<div class="card-header">
						<div class="page-title">
							<div class="tt_left">
								<h1 class="title page-header text-overflow"><?php echo 'View Order'; ?> </h1>
							</div>
							<div class="pull-right">
								<a class="btn btn-primary mrgtop" onclick="printDiv();">Print PDF</a>
								<a class="btn btn-primary mrgtop" href="<?php echo base_url().'orders/generate_pdf?local_order='.$records[0]['order_local_no']; ?>" target="_blank">Invoice PDF</a>
							</div>
						</div>
					</div>                    
					<div class="card-body" style="overflow-x: auto;">
					<ul class=" alert_msg  alert-danger  alert container_alert" style="display: none;">
					
					</ul>				
						<table id="DivIdToPrint" style="background-color: #ffffff; border-collapse: collapse; margin:0 auto;color: #565656;font-family: Arial, sans-serif;font-size: 14px;line-height: 20px;border:0px;" width="100%" cellspacing="0" cellpadding="0">
							<tbody>
								<tr>
									<td style="padding:12px 20px;background-color: #f7f4f8; color: #3b3b3b; font-family: Arial, sans-serif; font-size: 17px; line-height: 16px;border-bottom: 1px dashed #d0d0d0;border-top: 1px dashed #d0d0d0;"><span style="font-weight: bold; font-size: 16px; ">Order Details</span>
									</td>
								</tr>
								<tr>
									<td style="padding:20px;">
										<table style="width:100%;border-spacing:0;">
											<tbody>
												<tr>
													<td style="font-size: 14px;color: #565656;    padding: 5px 10px;    line-height: normal;    text-align: left; width:50%;">Order Number</td>
													<td style="font-size: 14px;color: #565656;    padding: 5px 10px;    line-height: normal;    text-align: left;width:50%;"><?php echo $records[0]['order_local_no']; ?></td>
												</tr>
												<tr>
													<td style="font-size: 14px;color: #565656;    padding: 5px 10px;    line-height: normal;    text-align: left;width:50%;">Created by</td>
													<td style="font-size: 14px;color: #565656;    padding: 5px 10px;    line-height: normal;    text-align: left;width:50%;"> <?php echo $records[0]['customer_first_name']." ".$records[0]['customer_last_name']; ?>  </td>
												</tr>
												<tr>
													<td style="font-size: 14px;color: #565656;    padding: 5px 10px;    line-height: normal;    text-align: left;width:50%;">Order Date</td>
													<td style="font-size: 14px;color: #565656;    padding: 5px 10px;    line-height: normal;    text-align: left;width:50%;"> <?php echo date('Y-m-d H:i:s',strtotime($records[0]['order_date'])); ?> </td>
												</tr>
												<tr>
													<td style="font-size: 14px;color: #565656;    padding: 5px 10px;    line-height: normal;    text-align: left;width:50%;">Order Status</td>
													<td style="font-size: 14px;color: #565656;    padding: 5px 10px;    line-height: normal;    text-align: left;width:50%;"> <?php echo $records[0]['status_name']; ?> </td>
												</tr>
											</tbody>
										</table>
									</td>
								</tr>
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
									<td style="padding:12px 20px;background-color: #f7f4f8; color: #3b3b3b; font-family: Arial, sans-serif; font-size: 17px; line-height: 16px;border-bottom: 1px dashed #d0d0d0;border-top: 1px dashed #d0d0d0;"><span style="font-weight: bold; font-size: 16px; ">Shipping Address</span>
									</td>
								</tr>
								<tr>
									<td style="padding:20px;">
										<table style="width:100%;border-spacing:0;">
											<tbody>
												<tr>
													<td style="font-size: 14px;color: #565656;    padding: 5px 10px;    line-height: normal;    text-align: left;width:50%;">Name</td>
													<td style="font-size: 14px;color: #565656;    padding: 5px 10px;    line-height: normal;    text-align: left;width:50%;"> <?php echo $records[0]['order_shipping_first_name']." ".$records[0]['order_shipping_last_name'] ?> </td>
												</tr>
												<tr>
													<td style="font-size: 14px;color: #565656;    padding: 5px 10px;    line-height: normal;    text-align: left;width:50%;">Building Name</td>
													<td style="font-size: 14px;color: #565656;    padding: 5px 10px;    line-height: normal;    text-align: left;width:50%;">  <?php echo $records[0]['order_shipping_building_name']; ?></td>
												</tr>
												<tr>
													<td style="font-size: 14px;color: #565656;    padding: 5px 10px;    line-height: normal;    text-align: left;width:50%;">Postal Code</td>
													<td style="font-size: 14px;color: #565656;    padding: 5px 10px;    line-height: normal;    text-align: left;width:50%;"> <?php echo $records[0]['order_shipping_postal_code']; ?></td>
												</tr>
												<tr>
													<td style="font-size: 14px;color: #565656;    padding: 5px 10px;    line-height: normal;    text-align: left;width:50%;">Floor</td>
													<td style="font-size: 14px;color: #565656;    padding: 5px 10px;    line-height: normal;    text-align: left;width:50%;"> <?php echo output_value($records[0]['order_shipping_floor']); ?></td>
												</tr>
												<tr>
													<td style="font-size: 14px;color: #565656;    padding: 5px 10px;    line-height: normal;    text-align: left;width:50%;">Unit No.</td>
													<td style="font-size: 14px;color: #565656;    padding: 5px 10px;    line-height: normal;    text-align: left;width:50%;"> <?php echo output_value($records[0]['order_shipping_unit']); ?></td>
												</tr>
												<tr>
													<td style="font-size: 14px;color: #565656;    padding: 5px 10px;    line-height: normal;    text-align: left;">Company Name</td>
													<td style="font-size: 14px;color: #565656;    padding: 5px 10px;    line-height: normal;    text-align: left;width:50%;"> <?php echo output_value($records[0]['order_shipping_company_name']); ?></td>
												</tr>
												<tr>
													<td style="font-size: 14px;color: #565656;    padding: 5px 10px;    line-height: normal;    text-align: left;width:50%;">Special Info</td>
													<td style="font-size: 14px;color: #565656;    padding: 5px 10px;    line-height: normal;    text-align: left;width:50%;"> <?php echo output_value($records[0]['order_shipping_special_info']); ?></td>
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
																				<tr><td>Merchant Name: <a href="<?php echo base_url().get_tag_username($record['item_merchant_id']); ?>"><?php echo $record['item_merchant_name']; ?></a></td></tr>
																				
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
															<td style="padding:10px; font-size:15px; text-align: center; width:20%;"><?php echo show_price($record['item_total_amount']); ?></td>
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
																				<p>DELIVERY FEES: <strong><?php echo show_price($record['shipping_method_price']); ?></strong></p>
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
																								<p <?php if($record['item_order_status'] == 2 || $record['item_order_status'] == 5 || $record['item_order_status'] == 6) { ?>style="display:block;"  <?php } else { ?>style="display:none;" <?php } ?>><span class="label">Tracking URl: </span><a target="_blank" href="<?php echo addhttp($record['shipping_track_code']); ?>"><?php echo addhttp($record['shipping_track_code']); ?></a></p>
																								<p <?php if($record['item_order_status'] == 2 || $record['item_order_status'] == 5 || $record['item_order_status'] == 6) { ?>style="display:block;" <?php } else { ?>style="display:none;" <?php } ?> ><span class="label">Airway bill No. </span> <?php echo $record['shipping_track_airway_bill']; ?></p>
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
																	<td style="font-size:14px;width:20%; color:#565656;padding:5px 10px; line-height: normal;text-align: right;" class="price"><?php echo show_price($records[0]['order_sub_total']); ?></td>
																</tr>

																<?php if($records[0]['order_delivery_charge'] > 0) { ?>
																	<tr>
																		<td style="width:60%"></td>
																		<td style="font-size:14px;width:20%; color:#565656;padding:5px 10px; line-height: normal;text-align: left;">Delivery Charge</td>
																		<td style="font-size:14px;width:20%; color:#565656;padding:5px 10px; line-height: normal;text-align: right;" class="price"><?php echo show_price($records[0]['order_delivery_charge']); ?></td>
																	</tr>
																<?php }	?>													
																<tr>
																	<td style="width:60%"></td>
																	<td style="width:20%; font-size:14px; color:#565656;padding:5px 10px; line-height: normal;text-align: left;">Grand Total</td>
																	<td style="width:20%; font-size: 14px; color:#565656;padding:5px 10px; line-height: normal;text-align: right;" class="price"><?php echo show_price($records[0]['order_total_amount']); ?></td>
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
						<p style="color:red;">Bloggoto is just an platform provider to Merchant and Customers, <br> we are not responsible for any shopping or booking conflicts and hence if at all arises has to be resolved by them self with the help of contact details provided. <br> Hence we warn you from fraudulent activities and mischief behaviour which may lead to legal and severe action and cancellation of profile</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<script>
jQuery('.order_status').on('change',function() {
	if(jQuery(this).val() == 2 || jQuery(this).val() == 5)
	{
		jQuery(this).parent().parent().find('.tracking_code_info').show();
	} else {
		jQuery(this).parent().parent().find('.tracking_code_info').hide();
	}
});
</script>