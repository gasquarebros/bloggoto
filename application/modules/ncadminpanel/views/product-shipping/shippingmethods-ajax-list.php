<div class="pagination_bar">
 <div class="btn-toolbar pull-left">
		<div class="btn-group">
            <button class="btn btn-default multi_action" data="Activate" type="button"><?php echo get_label('activate');?></button>
            <button class="btn btn-default multi_action" data="Deactivate"  type="button"><?php echo get_label('deactivate');?></button>
            <button class="btn btn-default multi_action" data="Delete" type="button"><?php echo get_label('delete');?></button>
            <!--<input type="submit" name="save" value="save" id="save">-->
             <button class="btn btn-default" id="save" type="submit">Save</button>
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
			<th><?=get_label('ship_method_name').add_sort_by('ship_method_name',$module); ?></th>
			<th><?= get_label('status');?></th>
			<th width="20px"><?=get_label('actions');?></th>


		</tr>
	</thead> 
       <tbody class="append_html">
 <?php
	if (! empty ( $records )) {
		foreach ( $records as $val ) { ?>
         <tr class="<?php echo $val['ship_method_id']."_maintr" ?>" >
     
			<td ><div
					class="checkbox3 checkbox-inline checkbox-check checkbox-light"><?php echo form_checkbox('id[]',$val['ship_method_id'],'',' class="multi_check" type="checkbox" id="'.$val['ship_method_id'].'"   ');?>
                    <label for="<?php echo $val['ship_method_id'];?>" class="chk_box_label"></label>
				</div> 
			</td>
			
			<td class="top_input"><?php echo trim(stripcslashes($val['ship_method_name']));?></td>

	        <td class="top_input"><a href="javascript:;"><?php echo show_status($val['ship_method_status'],$val['ship_method_id']);?></a></td>

			 <td width="100px"> 
			 <a href="<?php echo admin_url().$module.'/edit/'.encode_value($val['ship_method_id']);?>"><i class="fa fa-edit" title="<?php echo get_label('edit')?>"></i></a>&nbsp;
			 <a href="javascript:;" class="delete_record" id="<?php echo encode_value($val['ship_method_id']);?>" data="Delete"><i class="fa fa-trash" title="<?php echo get_label('delete')?>"></i></a> </td>
		</tr>
<?php  } }  else { ?>
<tr class="no_records">

			<td colspan="15" class=""><?php echo sprintf(get_label('admin_no_records_found'),$module_labels); ?></td>
		</tr>

<?php } ?>
</tbody>
 <thead class="last">
		<tr>
			<th>
				<div
					class="checkbox3 checkbox-inline checkbox-check checkbox-light"> <?= form_checkbox('multicheck','Y',FALSE,' class="multicheck_bottom"  type="checkbox"  id="mul_check_bottom"');?>  <label
						for="mul_check_bottom" class="chk_box_label"></label>
				</div>
			</th>
			<th><?=get_label('ship_method_name').add_sort_by('ship_method_name',$module); ?></th>
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
                        <button class="btn btn-default" id="save" type="submit">Save</button>
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