<div class="pagination_bar">
	<div class="btn-toolbar pull-left">
		<div class="btn-group">
 <button class="btn btn-default multi_action" data="Activate" type="button"><?php echo get_label('activate');?></button>
            <button class="btn btn-default multi_action" data="Deactivate"  type="button"><?php echo get_label('deactivate');?></button>
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
<table class="table " style="text-align: left;">
	<thead class="first">
		<tr>
			<th width="10px">
                    <?= form_checkbox('multicheck','Y',FALSE,' class="multicheck_top"  type="checkbox" id="mul_check_top" ');?>
                    </th>
					
			<th><?=get_label('product_name').add_sort_by('product_name',$module);?></th>
			
			<th><?=get_label('product_alias');?></th>
			
			<th><?=get_label('product_price').add_sort_by('product_price',$module);?></th>
			<th><?=get_label('product_sku').add_sort_by('product_sku',$module);?></th>
			<th><?=get_label('product_type').add_sort_by('product_type',$module);?></th>
				
			<th><?=get_label('product_sequence').add_sort_by('product_sequence',$module);;?></th>
		   <th><?= get_label('status');?></th>
			<th width=""><?=get_label('actions');?></th>


		</tr>
	</thead>


	<tbody class="append_htmls">
 <?php
	if (! empty ( $records )) {
		foreach ( $records as $val ) {
			?>
<tr>
			<td scope="row"><?php echo form_checkbox('id[]',$val['product_primary_id'],'',' class="multi_check" type="checkbox" id="'.$val['product_primary_id'].'"   ');?>
			</td>
					
			<td><?php echo stripslashes($val['product_name']);?></td>
			<td><?php echo stripslashes($val['product_alias']);?></td>
			<td><?php echo show_price($val['product_price']);?></td>
			<td><?php echo output_value($val['product_sku']);?></td>	 
			<td><?php echo output_value($val['product_type']); ?></td>
			<td><?php echo $val['product_sequence']; ?></td>
			<td><a href="javascript:;"><?php echo show_status($val['product_status'],$val['product_primary_id']);?></a> </td>

			
	<td> 

		
       
	    <a href="<?php echo base_url().$module.'/edit/'.encode_value($val['product_primary_id']);?>"><i class="fa fa-edit" title="<?php echo get_label('edit')?>"></i></a>&nbsp;
		<a href="javascript:;" class="delete_record" id="<?php echo encode_value($val['product_primary_id']);?>" data="Delete" ><i class="fa fa-trash" title="<?php echo get_label('delete')?>"></i></a>
		</td>
		</tr>
<?php  } } else { ?>
<tr class="no_records">

			<td colspan="15" class=""><?php echo sprintf(get_label('admin_no_records_found'),$module_labels); ?></td>
		</tr>

<?php } ?>



	</tbody>
	<thead class="last">
		<tr>
			<th> <?= form_checkbox('multicheck','Y',FALSE,' class="multicheck_bottom"  type="checkbox"  id="mul_check_bottom"');?> </th>
			<th><?=get_label('product_name').add_sort_by('product_name',$module);?></th>
			<th><?=get_label('product_alias');?></th>
			<th><?=get_label('product_price').add_sort_by('product_price',$module);?></th>
			<th><?=get_label('product_sku').add_sort_by('product_sku',$module);?></th>
			<th><?=get_label('product_type').add_sort_by('product_type',$module);?></th>
			<th><?=get_label('product_sequence').add_sort_by('product_sequence',$module);;?></th>
			<th><?= get_label('status');?></th>
			<th><?=get_label('actions');?></th>
		</tr>
	</thead>

</table>
</div>

<div class="pagination_bar">
	<div class="btn-toolbar pull-left">
		<div class="btn-group">
			<button class="btn btn-default multi_action" data="Activate" type="button"><?php echo get_label('activate');?></button>
			<button class="btn btn-default multi_action" data="Deactivate"  type="button"><?php echo get_label('deactivate');?></button>
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
