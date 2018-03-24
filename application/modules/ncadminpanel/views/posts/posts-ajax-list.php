<div class="pagination_bar">
	<div class="btn-toolbar pull-left">
		<div class="btn-group">
			<button class="btn btn-default multi_action" data="Activate" type="button"><?php echo get_label('activate');?></button>
            <button class="btn btn-default multi_action" data="Deactivate" type="button"><?php echo get_label('deactivate');?></button>
            <button class="btn btn-default multi_action" data="Draft" type="button"><?php echo get_label('draft');?></button>
			<button class="btn btn-default multi_action" data="Delete"
				type="button"><?php echo get_label('delete');?></button>
		</div>
	</div>
	<div class="pagination_custom pull-right">
		<div class="pagination_txt">
            <?php echo show_record_info($total_rows,$start,$limit);?>
        </div>
        <?php echo $paging;?>
    </div>
	<div class="clear"></div>
</div><div class="table_overflow">
<table class="table ">
	<thead class="first">
		<tr>
			<th width="10px"><div class="checkbox3 checkbox-inline checkbox-check checkbox-light">
            <?= form_checkbox('multicheck','Y',FALSE,' class="multicheck_top"  type="checkbox" id="mul_check_top" ');?>
            <label for="mul_check_top" class="chk_box_label"></label></div></th>
            <th><?=get_label('post_title');?><?php echo add_sort_by('post_title',$module); ?></th>
            <th><?=get_label('post_category');?><?php echo add_sort_by('post_category',$module); ?></th>
            <th><?=get_label('post_type');?><?php echo add_sort_by('post_type',$module); ?></th>
            <th><?=get_label('post_likes');?></th>
            <th><?=get_label('post_comments');?></th>
			<th width="150px"><?= get_label('created_on');?></th>
			<th width="150px"><?=get_label('actions');?></th>
		</tr>
	</thead>


	<tbody class="append_html">
 <?php
	if (! empty ( $records )) {
		foreach ( $records as $val ) {
			?>
          <tr>
			<td><div class="checkbox3 checkbox-inline checkbox-check checkbox-light"><?php echo form_checkbox('id[]',$val['post_id'],'',' class="multi_check" type="checkbox" id="'.$val['post_id'].'"   ');?>
            <label for="<?php echo $val['post_id'];?>" class="chk_box_label"></label>
			</div></td>
            <td><?php echo output_value($val['post_title']);?> </td>
            <td><?php echo output_value($val['blog_cat_name']);?> </td>
            <td><?php echo output_value($val['post_type']);?> </td>
            <td><?php echo output_value($val['post_likes']);?> </td>
            <td><?php echo output_value($val['post_comments']);?> </td>
			<td><?php echo get_date_formart(($val['post_created_on']));?></td>
			<td>
		    <?php /* ?><a href="<?php echo admin_url().$module.'/view/'.encode_value($val['post_id']);?>" class="ajax-popup"><i class="fa fa-eye" title="<?php echo get_label('view')?>"></i></a>&nbsp; <?php  */ ?>
			<a href="<?php echo admin_url().$module.'/edit/'.encode_value($val['post_id']);?>"><i class="fa fa-edit" title="<?php echo get_label('edit')?>"></i></a>&nbsp;
			<a href="javascript:;" class="delete_record" id="<?php echo encode_value($val['post_id']);?>" data="Delete"><i class="fa fa-trash" title="<?php echo get_label('delete')?>"></i></a>
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
			<th width="10px"><div class="checkbox3 checkbox-inline checkbox-check checkbox-light">
            <?= form_checkbox('multicheck','Y',FALSE,' class="multicheck_top"  type="checkbox" id="mul_check_top" ');?>
            <label for="mul_check_top" class="chk_box_label"></label></div></th>
            <th><?=get_label('post_title');?><?php echo add_sort_by('post_title',$module); ?></th>
            <th><?=get_label('post_category');?><?php echo add_sort_by('post_category',$module); ?></th>
            <th><?=get_label('post_type');?><?php echo add_sort_by('post_type',$module); ?></th>
            <th><?=get_label('post_likes');?></th>
            <th><?=get_label('post_comments');?></th>
			<th width="150px"><?= get_label('created_on');?></th>
			<th width="150px"><?=get_label('actions');?></th>
		</tr>
	</thead>

</table></div>

<div class="pagination_bar">
	<div class="btn-toolbar pull-left">
		<div class="btn-group">
		<button class="btn btn-default multi_action" data="Delete"
				type="button"> <?php echo get_label('delete');?></button>
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
