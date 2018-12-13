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
			<th><?=get_label('order_service_title').add_sort_by('order_service_title',$module);?></th>
			<th><?=get_label('order_service_category_id');?></th>
			<th><?=get_label('order_service_subcategory_id');?></th>
			<th><?=get_label('order_service_date').add_sort_by('order_service_start_date',$module);?></th>
			<th><?=get_label('order_service_amount');?></th>
			<th><?=get_label('city');?></th>
			<th><?=get_label('order_service_status').add_sort_by('order_service_status',$module);?></th>
			<th width=""><?=get_label('actions');?></th>
		</tr>
	</thead>


	<tbody class="append_html">
 <?php
	if (! empty ( $records )) {
		foreach ( $records as $val ) {
			?>
			<tr>
						
				<td><?php echo get_date_formart($val['order_service_created_on']);?></td>
				<td><?php echo output_value($val['order_service_local_no']);?></td>
				<td><?php echo stripslashes($val['order_service_title']);?></td>
				<td><?php echo stripslashes($val['ser_cate_name']);?></td>	 
				<td><?php echo stripslashes($val['pro_subcate_name']); ?></td>
				<td><?php echo get_date_formart($val['order_service_start_date'])." - ".get_date_formart($val['order_service_end_date']); ?><br><?php echo ($val['order_service_start_time'] !='' && $val['order_service_end_time'] !='') ?  date( 'h.i A', $val['order_service_start_time'])." - ". date( 'h.i A', $val['order_service_end_time']):''; ?></td>
				<td><?php echo show_price($val['order_service_price'])."/".$val['order_service_price_type']; ?></td>
				<td><?php echo stripslashes($val['city_name']);?></td>
				<td><?php echo ucfirst($val['order_service_status']);?></td>
				<td> 
					<?php if($val['order_service_is_paid'] == 1) { ?>	
						<a href="<?php echo base_url().$module.'/view/'.encode_value($val['order_service_id']);?>"><i class="fa fa-eye" title="<?php echo get_label('view')?>"></i></a>&nbsp;
					<?php } else { ?>
						<a href="<?php echo base_url().$module.'/pay/'.encode_value($val['order_service_id']);?>"><i class="fa fa-money" title="<?php echo get_label('pay')?>"></i></a>&nbsp;
					<?php } ?>
				</td>
			</tr>
<?php  	} 
	} 
	else { ?>
		<tr class="no_records">
			<td colspan="15" class=""><?php echo sprintf(get_label('admin_no_records_found'),$module_labels); ?></td>
		</tr>
<?php } ?>



	</tbody>
	<thead class="last">
		<tr>
			<th><?=get_label('order_service_created_on').add_sort_by('order_service_created_on',$module);?></th>
			<th><?=get_label('order_service_local_no').add_sort_by('order_service_local_no',$module);?></th>
			<th><?=get_label('order_service_title').add_sort_by('order_service_title',$module);?></th>
			<th><?=get_label('order_service_category_id');?></th>
			<th><?=get_label('order_service_subcategory_id');?></th>
			<th><?=get_label('order_service_date').add_sort_by('order_service_start_date',$module);?></th>
			<th><?=get_label('order_service_amount');?></th>
			<th><?=get_label('city');?></th>
			<th><?=get_label('order_service_status').add_sort_by('order_service_status',$module);?></th>
			<th width=""><?=get_label('actions');?></th>
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
