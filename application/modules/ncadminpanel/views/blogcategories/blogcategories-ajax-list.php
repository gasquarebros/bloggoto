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
<div class="table_overflow">
<table class="table " style="text-align: left;">
	<thead class="first">
		<tr>
			<th width="10px"><div
					class="checkbox3 checkbox-inline checkbox-check checkbox-light">
                    <?= form_checkbox('multicheck','Y',FALSE,' class="multicheck_top"  type="checkbox" id="mul_check_top" ');?>
                    <label for="mul_check_top" class="chk_box_label"></label>
				</div></th>
			<th><?=get_label('blog_cat_name').add_sort_by('blog_cat_name',$module);?></th>
		 
			<th><?=get_label('blog_cat_sequence').add_sort_by('blog_cat_sequence',$module);?></th>
			<th><?= get_label('status');?></th>
			<th width="150px"><?=get_label('actions');?></th>


		</tr>
	</thead>


	<tbody class="append_html">
 <?php
	if (! empty ( $records )) {
		foreach ( $records as $val ) { ?>
			<tr class="<?php echo $val['blog_cat_id']."_maintr" ?>" >
				<td>
					<div class="checkbox3 checkbox-inline checkbox-check checkbox-light"><?php echo form_checkbox('id[]',$val['blog_cat_id'],'',' class="multi_check" type="checkbox" id="'.$val['blog_cat_id'].'"   ');?>
						<label for="<?php echo $val['blog_cat_id'];?>" class="chk_box_label"></label>
					</div>
				</td>
				<td class="top_input"> <span class="spn"><?php echo output_value($val['blog_cat_name']);?></span></td>
	
				<td class="top_input"> <span class="spn"><?php echo output_value($val['blog_cat_sequence']);?></span> </td>
	
	
				<td class="top_input" ><a href="javascript:;"><?php echo show_status($val['blog_cat_status'],$val['blog_cat_id']);?></a></td>
				<td>
					<a href="<?php echo admin_url().$module.'/edit/'.encode_value($val['blog_cat_id']);?>"><i class="fa fa-edit" title="<?php echo get_label('edit')?>"></i></a>&nbsp;
					
					<a href="javascript:;" class="delete_record" id="<?php echo encode_value($val['blog_cat_id']);?>" data="Delete"><i class="fa fa-trash" title="<?php echo get_label('delete')?>"></i></a>
				</td>
			</tr>
<?php  } } else { ?>
<tr class="no_records">

			<td colspan="4" class=""><?php echo sprintf(get_label('admin_no_records_found'),$module_labels); ?></td>
		</tr>

<?php } ?>
	
	</tbody>
	<thead class="last">
		<tr>
			<th><div
					class="checkbox3 checkbox-inline checkbox-check checkbox-light"> <?= form_checkbox('multicheck','Y',FALSE,' class="multicheck_bottom"  type="checkbox"  id="mul_check_bottom"');?>  <label
						for="mul_check_bottom" class="chk_box_label"></label>
				</div>
			</th>
			<th><?=get_label('blog_cat_name').add_sort_by('blog_cat_name',$module);?></th>
			<th><?=get_label('blog_cat_sequence').add_sort_by('blog_cat_sequence',$module);?></th>
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