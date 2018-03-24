<div class="pagination_bar">
    <div class="btn-toolbar pull-left">
        <div class="btn-group">
           
        </div>   
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
<table class="table">
	<thead class="first">
		<tr>
			<th><?=get_label('login_update_ip');?></th>
			<th><?=get_label('login_user_name');?></th>				
			<th><?= get_label('created_on');?></th>

		</tr>
	</thead>


	<tbody class="append_html">
 <?php
	if (! empty ( $records )) {
		foreach ( $records as $val ) { ?>
<tr>
			<td><?php echo output_value($val['login_ip']);?></td>
			<td><?php echo output_value($val['admin_username']);?></td>
			<td><?php echo get_date_formart($val['login_time'],'d-m-Y h:i A');?></td>
		</tr>
<?php  } } else { ?>
<tr class="no_records" >

			<td colspan="15" class=""><?php echo sprintf(get_label('admin_no_records_found'),$module_labels); ?></td>
		</tr>

<?php } ?>



	</tbody>
		<thead class="last">
		<tr>
			<th><?=get_label('login_update_ip');?></th>
			<th><?=get_label('login_user_name');?></th>				
			<th><?= get_label('created_on');?></th>
		</tr>
	</thead>

</table>
</div>
<div class="pagination_bar">
	<div class="btn-toolbar pull-left">
		<div class="btn-group">
		
		</div>      
	</div>
	<div class="pagination_custom pull-right">
		<div class="pagination_txt">
			<?php echo show_record_info($total_rows,$start,$limit);?>
		</div>
		<?php echo $paging;?>
	</div>
	<div class="clear"></div>
</div>
		
