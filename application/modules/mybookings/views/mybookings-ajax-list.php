<div class="pagination_bar">
	<div class="btn-toolbar pull-left">
	</div>
	<div class="pagination_custom pull-right">
		<div class="pagination_txt">
            <?php echo show_record_info($total_rows,$start,$limit);?>
        </div>
        <?php echo $paging;?>
    </div>
	<div class="clear"></div>
</div>
<div class="table_overflow">
<table class="table " style="text-align: left;">
	<thead class="first">
		<tr>
			<th><?=get_label('order_service_created_on').add_sort_by('order_service_created_on',$module);?></th>
			<th><?=get_label('order_service_local_no').add_sort_by('order_service_local_no',$module);?></th>
			<th><?=get_label('provider_name').add_sort_by('provider_first_name',$module);?></th>
			<th><?=get_label('order_service_category_id');?></th>
			<th><?=get_label('order_service_subcategory_id');?></th>
			<th><?=get_label('order_service_date');?></th>
			<th><?=get_label('order_service_address');?></th>
			<th><?=get_label('order_service_price');?></th>
		</tr>
	</thead>


	<tbody class="append_html">
 <?php
	if (! empty ( $records )) {
		foreach ( $records as $val ) {
			//echo "<pre>"; print_r($val); exit;
			$format_address = $val['order_service_address_line1']." ".$val['order_service_address_line2']." <br>".get_city_name($val['order_service_city'])." ".get_state_name($val['order_service_state'])."<br>".$val['order_service_zipcode']."<br>".$val['order_service_landmark'];
			?>
			<tr>
						
				<td><?php echo get_date_formart($val['order_service_created_on']);?></td>
				<td><?php echo output_value($val['order_service_local_no']);?></td>
				<td><?php echo stripslashes($val['provider_first_name']." ".$val['provider_last_name']);?></td>
				<td><?php echo stripslashes($val['ser_cate_name']);?></td>	 
				<td><?php echo stripslashes($val['pro_subcate_name']); ?></td>
				<td><?php echo get_date_formart($val['order_service_start_date'])." - ".get_date_formart($val['order_service_end_date']); ?></td>
				<td><?php echo $format_address; ?></td>
				<td><?php echo show_price($val['order_service_price'])."/".$val['order_service_price_type']; ?></td>
			</tr>
<?php  	} 
	} 
	else { ?>
		<tr class="no_records">
			<td colspan="8" class=""><?php echo sprintf(get_label('admin_no_records_found'),$module_labels); ?></td>
		</tr>
<?php } ?>



	</tbody>
	<thead class="last">
		<tr>
			<th><?=get_label('order_service_created_on').add_sort_by('order_service_created_on',$module);?></th>
			<th><?=get_label('order_service_local_no').add_sort_by('order_service_local_no',$module);?></th>
			<th><?=get_label('provider_name').add_sort_by('provider_first_name',$module);?></th>
			<th><?=get_label('order_service_category_id');?></th>
			<th><?=get_label('order_service_subcategory_id');?></th>
			<th><?=get_label('order_service_date');?></th>
			<th><?=get_label('order_service_address');?></th>
			<th><?=get_label('order_service_price');?></th>
		</tr>
	</thead>

</table>
</div>

<div class="pagination_bar">
	<div class="btn-toolbar pull-left">
	</div>
	<div class="pagination_custom pull-right">
		<div class="pagination_txt">
			<?php echo show_record_info($total_rows,$start,$limit);?>
		</div>
		<?php echo $paging;?>
    </div>
	<div class="clear"></div>
</div>
