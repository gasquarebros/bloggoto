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
			<th><?=get_label('order_created_on').add_sort_by('order_created_on',$module);?></th>
			<th><?=get_label('order_local_no').add_sort_by('order_local_no',$module);?></th>
			<th><?=get_label('customer_name').add_sort_by('customer_first_name',$module);?></th>
			<th><?=get_label('order_sub_total').add_sort_by('order_sub_total',$module);?></th>
			<th><?=get_label('order_total_amount').add_sort_by('order_total_amount',$module);?></th>
			<th><?=get_label('order_status').add_sort_by('order_status',$module);;?></th>
			<th width=""><?=get_label('actions');?></th>
		</tr>
	</thead>


	<tbody class="append_html">
 <?php
	if (! empty ( $records )) {
		foreach ( $records as $val ) {
			?>
			<tr>
						
				<td><?php echo get_date_formart($val['order_created_on']);?></td>
				<td><?php echo output_value($val['order_local_no']);?></td>
				<td><?php echo stripslashes($val['customer_first_name']);?></td>
				<td><?php echo show_price($val['order_sub_total']);?></td>	 
				<td><?php echo show_price($val['order_total_amount']); ?></td>
				<td><?php echo output_value($val['status_name']); ?></td>
				<td> 
					<a href="<?php echo base_url().$module.'/view/'.encode_value($val['order_primary_id']);?>"><i class="fa fa-eye" title="<?php echo get_label('view')?>"></i></a>&nbsp;
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
			<th><?=get_label('order_created_on').add_sort_by('order_created_on',$module);?></th>
			<th><?=get_label('order_local_no').add_sort_by('order_local_no',$module);?></th>
			<th><?=get_label('customer_name').add_sort_by('customer_first_name',$module);?></th>
			<th><?=get_label('order_sub_total').add_sort_by('order_sub_total',$module);?></th>
			<th><?=get_label('order_total_amount').add_sort_by('order_total_amount',$module);?></th>
			<th><?=get_label('order_status').add_sort_by('order_status',$module);;?></th>
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
