<script>
var module_action = '<?php echo 'view/'.encode_value($records[0]['order_service_id']); ?>';
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
								<!--<a onclick="printDiv();">Print PDF</a>-->
								<?php if($records[0]['order_service_status'] == 'processing') { ?>
								<button type="button" data-option="accepted" class="btn btn-primary action_btns">Accept</button>	
								<button type="button" data-option="rejected" class="btn btn_red action_btns">Reject</button>	
								<?php } ?>
							</div>
						</div>
					</div>                    
					<div  class="card-body" style="overflow-x: auto;">
					
					<?php echo form_open_multipart(admin_url().$module.'/'.encode_value($records[0]['order_service_id']),' class="form-horizontal" id="common_form" ' );?>
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
													<td style="font-size: 14px;color: #565656;    padding: 5px 10px;    line-height: normal;    text-align: left;width:50%;"><?php echo $records[0]['order_service_local_no']; ?></td>
												</tr>
												<tr>
													<td style="font-size: 14px;color: #565656;    padding: 5px 10px;    line-height: normal;    text-align: left;width:50%;">Created by</td>
													<td style="font-size: 14px;color: #565656;    padding: 5px 10px;    line-height: normal;    text-align: left;width:50%;"> <?php echo $records[0]['customer_first_name']." ".$records[0]['customer_last_name']; ?>  </td>
												</tr>
												<tr>
													<td style="font-size: 14px;color: #565656;    padding: 5px 10px;    line-height: normal;    text-align: left;width:50%;">Order Date</td>
													<td style="font-size: 14px;color: #565656;    padding: 5px 10px;    line-height: normal;    text-align: left;width:50%;"> <?php echo date('Y-m-d H:i:s',strtotime($records[0]['order_service_created_on'])); ?> </td>
												</tr>
												<tr>
													<td style="font-size: 14px;color: #565656;    padding: 5px 10px;    line-height: normal;    text-align: left;width:50%;">Order Status</td>
													<td style="font-size: 14px;color: #565656;    padding: 5px 10px;    line-height: normal;    text-align: left;width:50%;"> <?php echo ucfirst($records[0]['order_service_status']); ?> </td>
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
													<td style="font-size: 14px;color: #565656;    padding: 5px 10px;    line-height: normal;    text-align: left;width:50%;"> <a href="<?php echo base_url().$records[0]["customer_username"]; ?>"><?php echo $records[0]['customer_first_name']." ".$records[0]['customer_last_name']; ?></a></td>
												</tr>
												<tr>
													<td style="font-size: 14px;color: #565656;    padding: 5px 10px;    line-height: normal;    text-align: left;width:50%;">Customer Mobile No</td>
													<td style="font-size: 14px;color: #565656;    padding: 5px 10px;    line-height: normal;    text-align: left;width:50%;"> <a href="tel:<?php echo $records[0]["customer_phone"]; ?>"><?php echo $records[0]['customer_phone']; ?></a></td>
												</tr>
												<tr>
													<td style="font-size: 14px;color: #565656;    padding: 5px 10px;    line-height: normal;    text-align: left;width:50%;">Customer Email</td>
													<td style="font-size: 14px;color: #565656;    padding: 5px 10px;    line-height: normal;    text-align: left;width:50%;"> <a href="mailto:<?php echo $records[0]["customer_email"]; ?>"><?php echo $records[0]['customer_email']; ?></a></td>
												</tr>
											</tbody>
										</table>
									</td>
								</tr>
								<tr>
									<td style="padding:12px 20px;background-color: #f7f4f8; color: #3b3b3b; font-family: Arial, sans-serif; font-size: 17px; line-height: 16px;border-bottom: 1px dashed #d0d0d0;border-top: 1px dashed #d0d0d0;"><span style="font-weight: bold; font-size: 16px; ">Service Details</span>
									</td>
								</tr>
								<tr>
									<td style="padding:20px;">
										<table style="width:100%;border-spacing:0;">
											<tbody>
												<tr>
													<td style="font-size: 14px;color: #565656;    padding: 5px 10px;    line-height: normal;    text-align: left; width:50%;">Service Title</td>
													<td style="font-size: 14px;color: #565656;    padding: 5px 10px;    line-height: normal;    text-align: left;width:50%;"> <?php echo stripslashes($records[0]['order_service_title']); ?> </td>
												</tr>
												<tr>
													<td style="font-size: 14px;color: #565656;    padding: 5px 10px;    line-height: normal;    text-align: left;width:50%;">Category</td>
													<td style="font-size: 14px;color: #565656;    padding: 5px 10px;    line-height: normal;    text-align: left;width:50%;"> <?php echo stripslashes($records[0]['ser_cate_name']); ?> </td>
												</tr>
												<tr>
													<td style="font-size: 14px;color: #565656;    padding: 5px 10px;    line-height: normal;    text-align: left;width:50%;">Subcategory</td>
													<td style="font-size: 14px;color: #565656;    padding: 5px 10px;    line-height: normal;    text-align: left;width:50%;"> <?php echo stripslashes($records[0]['pro_subcate_name']); ?></td>
												</tr>
												<tr>
													<td style="font-size: 14px;color: #565656;    padding: 5px 10px;    line-height: normal;    text-align: left;width:50%;">Service Period</td>
													<td style="font-size: 14px;color: #565656;    padding: 5px 10px;    line-height: normal;    text-align: left;width:50%;"> <?php echo get_date_formart($records[0]['order_service_start_date'])." - ".get_date_formart($records[0]['order_service_end_date']); ?><br><?php echo ($records[0]['order_service_start_time'] !='' && $records[0]['order_service_end_time'] !='') ?  date( 'h.i A', strtotime($records[0]['order_service_start_time']))." - ". date( 'h.i A', strtotime($records[0]['order_service_end_time'])):''; ?></td>
												</tr>
												<tr>
													<td style="font-size: 14px;color: #565656;    padding: 5px 10px;    line-height: normal;    text-align: left;width:50%;">Location</td>
													<td style="font-size: 14px;color: #565656;    padding: 5px 10px;    line-height: normal;    text-align: left;width:50%;"> <?php $format_address = $records[0]['order_service_address_line1']." ".$records[0]['order_service_address_line2']." <br>".get_city_name($records[0]['order_service_city'])." ".get_state_name($records[0]['order_service_state'])."<br>".$records[0]['order_service_zipcode']."<br>".$records[0]['order_service_landmark']; 
													echo $format_address; ?></td>
												</tr>
												<tr>
													<td style="font-size: 14px;color: #565656;    padding: 5px 10px;    line-height: normal;    text-align: left;width:50%;">Amount</td>
													<td style="font-size: 14px;color: #565656;    padding: 5px 10px;    line-height: normal;    text-align: left;width:50%;"> <?php echo show_price($records[0]['order_service_price'])."/".$records[0]['order_service_price_type']; ?></td>
												</tr>
												<tr>
													<td style="font-size: 14px;color: #565656;    padding: 5px 10px;    line-height: normal;    text-align: left;width:50%;">Additional Message</td>
													<td style="font-size: 14px;color: #565656;    padding: 5px 10px;    line-height: normal;    text-align: left;width:50%;"> <?php echo output_value($records[0]['order_service_message']); ?></td>
												</tr>
											</tbody>
										</table>
									</td>
								</tr>
							</tbody>
						</table>
					
					<input type="hidden" name="order_service" id="order_service" value="<?php echo $records[0]['order_service_guid']; ?>" />
					<?php
					echo form_hidden ( 'action', 'Add' );
					echo form_close ();
					?>
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


function loading()
{
    return  '<img src="'+SITE_URL+'lib/theme/images/loading_icon_default.gif" alt="loading.."  class="loading" />';
}

jQuery(".action_btns").click(function (){
	jQuery(this).hide();
	jQuery(this).parent("div").append(loading);
	var current = this;
	var service_id = jQuery('#order_service').val();
	
	var url = SITE_URL;
	var error =0;
	var val = jQuery(this).attr('data-option');
		//current.parent('p').append(loading);
		jQuery.ajax({
			url    : url+'managebookings/updateorder',
			type   : "post",
			dataType:'json',
			data: {'value':val,'secure_key': secure_key,'service_id':service_id},
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
				}

			},
			error : function () 
			{
				console.log("internal server error");
			}
		});
	
});
</script>