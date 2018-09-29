<form id="w0" action="/backend/orders/1463" method="post">		
	<table style="background-color: #ffffff; border-collapse: collapse; margin:0 auto;color: #565656;font-family: Arial, sans-serif;font-size: 14px;line-height: 20px;border:0px;" width="100%" cellspacing="0" cellpadding="0">
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
								<?php foreach($records as $record) { ?> 
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
															
															<?php $item_modifiers = get_order_item_modifier($record['item_subproductid']); 
																if(!empty($item_modifiers)) { ?>
																	<tr>
																		<td>
																			<table>
																				<?php foreach($item_modifiers as $item_modifier) { ?>
																					<tr>
																						<td><?php echo $item_modifier['order_modifier_name']; ?></td>
																						<td><?php echo $item_modifier['order_modifier_value_name']; ?></td>
																					</tr>
																				<?php } ?>
																			</table>
																		</td>
																	</tr>
															<?php } ?>
														</table>
													</td>
												</tr>
											</table>
										</td>
										<td style="padding:10px; font-size:15px; text-align: center; width:20%;text-transform:uppercase"><?php echo $record['item_qty']; ?></td>
										<td style="padding:10px; font-size:15px; text-align: center; width:20%;"><?php echo $record['item_total_amount']; ?></td>
									</tr>
									<tr>
										<td colspan="4" class="inner_table">
											<table style="width:100%;">
												<tbody>
													<tr>
														<td class="ship_method" style="text-align: left; width:40%;">
															<p>DELIVERY TYPE: <strong>DHL</strong></p>
														</td>
														<td class="ship_charge" style="text-align: left; width:30%;">
															<p>DELIVERY FEES: <strong>S$11.00</strong></p>
														</td>
														<td class="select-box" style="text-align: center; width:30%;">
															<table>
																<tbody>
																	<tr>
																		<td>
																			<select class="order_item_status" id="orderitems-item_status" name="Orderitems[item_status][1569]">
																				<option value="">Select Item Status</option>
																				<option value="1">Processing</option>
																				<option value="2">Completed</option>
																				<option value="3">Cancelled</option>
																				<option value="4">Expired</option>
																				<option value="5" selected="selected">In delivery</option>
																			</select>
																			<input name="item_status_old[1569]" value="5" type="hidden">
																		</td>
																		<td>
																			<input style="display:none;" class="tracking_code_info" name="Orderitems[shiiping_id][144]" value="" type="text">
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

	<div class="form-group">
		<button type="submit" class="btn btn-primary">Update</button>		
	</div>
</form>