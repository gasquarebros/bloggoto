<div class="pagination_bar">
    <div class="btn-toolbar pull-left">
        <div class="btn-group">
            <button class="btn btn-default multi_action" data="Delete" type="button"><?php echo get_label('delete');?></button>
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
<table class="table ">
	<thead class="first">
		<tr>
			<th><div class="checkbox3 checkbox-inline checkbox-check checkbox-light">
                    <?= form_checkbox('multicheck','Y',FALSE,' class="multicheck_top"  type="checkbox" id="mul_check_top" ');?>
                    <label for="mul_check_top" class="chk_box_label"></label>
                    </div>
            </th>
			<th><?php echo get_label('post_title');?><?php echo add_sort_by('post_title',$module); ?></th>
			<th><?php echo get_label('report_customer_name');?><?php echo add_sort_by('report_customer_name',$module); ?></th>
			<th><?php echo get_label('post_customer_name');?><?php echo add_sort_by('post_customer_name',$module); ?></th>
			<th><?php echo get_label('report_created_on');?><?php echo add_sort_by('report_created_on',$module); ?></th>
			<th><?php echo get_label('actions');?></th>

		</tr>
	</thead>
	<tbody class="append_html">
 <?php
	if (! empty ( $records )) {
		foreach ( $records as $val ) {						
			?>
		<tr>
			<td scope="row"><div class="checkbox3 checkbox-inline checkbox-check checkbox-light"><?php echo form_checkbox('id[]',$val['report_id'],'',' class="multi_check" type="checkbox" id="'.$val['report_id'].'"   ');?>
				<label for="<?php echo $val['report_id'];?>" class="chk_box_label"></label>
				</div>
			</td>	
			<td><?php echo output_value($val['post_title']);?></td>
			<td><?php echo output_value($val['report_customer_name']);?></td>
			<td><?php echo output_value($val['post_customer_name']);?></td>
			<td><?php echo ($val['report_created_on'] !='' && $val['report_created_on'] !="NULL" && $val['report_created_on'] != '0000-00-00 00:00:00' )?get_date_formart($val['report_created_on']):"N/A";?></td>
			<td>
				<a href="javascript:;" class="delete_record" id="<?php echo encode_value($val['report_id']);?>"
				data="Delete"><i class="fa fa-trash"
					title="<?php echo get_label('delete')?>"></i></a></td>
		</tr>
<?php  } } else { ?>
		<tr class="no_records" >

			<td colspan="15" class=""><?php echo sprintf(get_label('admin_no_records_found'),$module_labels); ?></td>
		</tr>

<?php } ?>



	</tbody>
	<thead class="last">
		<tr>
			<th><div class="checkbox3 checkbox-inline checkbox-check checkbox-light"> <?= form_checkbox('multicheck','Y',FALSE,' class="multicheck_bottom"  type="checkbox"  id="mul_check_bottom"');?>  <label for="mul_check_bottom" class="chk_box_label"></label></div></th>
			<th><?php echo get_label('post_title');?><?php echo add_sort_by('post_title',$module); ?></th>
			<th><?php echo get_label('report_customer_name');?><?php echo add_sort_by('report_customer_name',$module); ?></th>
			<th><?php echo get_label('post_customer_name');?><?php echo add_sort_by('post_customer_name',$module); ?></th>
			<th><?php echo get_label('report_created_on');?><?php echo add_sort_by('report_created_on',$module); ?></th>
			<th><?php echo get_label('actions');?></th>		</tr>
	</thead>

</table>
</div>
    
				<div class="pagination_bar">
                    <div class="btn-toolbar pull-left">
                        <div class="btn-group">
                        <button class="btn btn-default multi_action" data="Activate" type="button"><?php echo get_label('activate');?></button>
						<button class="btn btn-default multi_action" data="Deactivate"="Deactivate" type="button"><?php echo get_label('deactivate');?></button>
                        <button class="btn btn-default multi_action" data="Delete" type="button"> <?php echo get_label('delete');?></button>
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
		
