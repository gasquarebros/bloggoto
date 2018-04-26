<div class="pagination_bar">
    <div class="btn-toolbar pull-left">
        <div class="btn-group">
           <button class="btn btn-default multi_action" data="Activate" type="button"><?php echo get_label('activate');?></button>
            <button class="btn btn-default multi_action" data="Deactivate"="Deactivate" type="button"><?php echo get_label('deactivate');?></button>
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
			<th><?php echo get_label('customer_first_name');?><?php echo add_sort_by('customer_first_name',$module); ?></th>
			<th><?php echo get_label('customer_last_name');?><?php echo add_sort_by('customer_last_name',$module); ?></th>
			<th><?php echo get_label('customer_email');?><?php echo add_sort_by('customer_email',$module); ?></th>
			<th><?php echo get_label('customer_phone');?><?php echo add_sort_by('customer_phone',$module); ?></th>
			<th><?php echo get_label('customer_created_on');?><?php echo add_sort_by('customer_created_on',$module); ?></th>
			<th><?php echo get_label('last_visit_on');?></th>
			<th><?php echo get_label('status');?></th>
			<th><?php echo get_label('actions');?></th>

		</tr>
	</thead>


	<tbody class="append_html">
 <?php
	if (! empty ( $records )) {
		foreach ( $records as $val ) {						
			?>
		<tr>
			<td scope="row"><div class="checkbox3 checkbox-inline checkbox-check checkbox-light"><?php echo form_checkbox('id[]',$val['customer_id'],'',' class="multi_check" type="checkbox" id="'.$val['customer_id'].'"   ');?>
				<label for="<?php echo $val['customer_id'];?>" class="chk_box_label"></label>
				</div>
			</td>	
			<td><?php echo output_value($val['customer_first_name']);?></td>
			<td><?php echo output_value($val['customer_last_name']);?></td>
			<td><?php echo output_value($val['customer_email']);?></td>
			<td><?php echo output_value($val['customer_phone']);?></td>
			<td><?php echo ($val['customer_created_on'] !='' && $val['customer_created_on'] !="NULL" && $val['customer_created_on'] != '0000-00-00 00:00:00' )?get_date_formart($val['customer_created_on']):"N/A";?></td>
			<td><?php echo ($val['login_time'] !='' && $val['login_time'] !="NULL" && $val['customer_created_on'] != '0000-00-00 00:00:00' )?get_date_formart($val['login_time']):"N/A";?></td>			
			<td><a href="javascript:;"><?php echo show_status($val['customer_status'],$val['customer_id']);?></a>
			<td>
				<a href="<?php echo camp_url().$module.'/view/'.encode_value($val['customer_id']);?>" class="ajax-popup"><i class="fa fa-eye" title="<?php echo get_label('view')?>"></i></a>&nbsp;
				<a href="<?php echo camp_url().$module.'/edit';?>"><iclass ="fa
						fa-eye" title="<?php echo get_label('view')?>">
					</i></a>&nbsp; <a href="<?php echo camp_url().$module.'/edit/'.encode_value($val['customer_id']);?>"><i
					class="fa fa-edit" title="<?php echo get_label('edit')?>"></i></a>&nbsp;
				<a href="javascript:;" class="delete_record" id="<?php echo encode_value($val['customer_id']);?>"
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
			<th><?php echo get_label('customer_first_name');?><?php echo add_sort_by('customer_first_name',$module); ?></th>
			<th><?php echo get_label('customer_last_name');?><?php echo add_sort_by('customer_last_name',$module); ?></th>
			<th><?php echo get_label('customer_email');?><?php echo add_sort_by('customer_email',$module); ?></th>
			<th><?php echo get_label('customer_phone');?><?php echo add_sort_by('customer_phone',$module); ?></th>
			<th><?php echo get_label('customer_created_on');?><?php echo add_sort_by('customer_created_on',$module); ?></th>
			<th><?php echo get_label('last_visit_on');?></th>
			<th><?php echo get_label('status');?></th>
			<th><?php echo get_label('actions');?></th>

		</tr>
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
		
