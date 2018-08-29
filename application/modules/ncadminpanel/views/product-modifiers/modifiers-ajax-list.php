<div class="pagination_bar">
 <div class="btn-toolbar pull-left">
		<div class="btn-group">
            <button class="btn btn-default multi_action" data="Activate" type="button"><?php echo get_label('activate');?></button>
            <button class="btn btn-default multi_action" data="Deactivate"  type="button"><?php echo get_label('deactivate');?></button>
               <button class="btn btn-default multi_action" data="Sequence"  type="button"><?php echo get_label('sequence');?></button>
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
			<th><?=get_label('pro_modifier_name').add_sort_by('pro_modifier_name',$module); ?></th>
			<th><?=get_label('pro_modifier_sequence').add_sort_by('pro_modifier_sequence',$module); ;?></th>
		   <th><?= get_label('status');?></th>
			<th width="20px"><?=get_label('actions');?></th>


		</tr>
	</thead> 
       <tbody class="append_html">
 <?php
	if (! empty ( $records )) {
		foreach ( $records as $val ) {

          $modifier_values = get_modifier_list(array('pro_modifier_value_modifier_primary_id'=>$val['pro_modifier_primary_id']));
     
			?>
         <tr class="<?php echo $val['pro_modifier_primary_id']."_maintr" ?>" >
     
			<td ><div
					class="checkbox3 checkbox-inline checkbox-check checkbox-light"><?php echo form_checkbox('id[]',$val['pro_modifier_primary_id'],'',' class="multi_check" type="checkbox" id="'.$val['pro_modifier_primary_id'].'"   ');?>
                    <label for="<?php echo $val['pro_modifier_primary_id'];?>" class="chk_box_label"></label>
				</div> </td>
			
			<?php /* ?><td class=""> <a data-toggle="collapse" href="#<?php echo $val['pro_modifier_primary_id']."modifier_id"; ?> " aria-expanded="false" class="expand"><i class="fa fa-plus"></i></a> <?php echo output_value($val['pro_modifier_name']);?></td><?php */ ?>
			
			<td class="top_input"><a data-toggle="collapse" href="#<?php echo $val['pro_modifier_primary_id']."modifier_id"; ?> " aria-expanded="false" class="expand"><i class="fa fa-plus"></i></a> <input type="hidden" value="<?php echo trim(stripcslashes($val['pro_modifier_name']));?>" class="org_txt"> <span class="spn"><?php echo trim(stripcslashes($val['pro_modifier_name']));?></span> <input type="text" name="pro_modifier_name[<?php echo $val['pro_modifier_primary_id'] ?>]" value="<?php echo trim(stripcslashes($val['pro_modifier_name']));?>" class="edit_txt edit_txt_hide inp_type form-control required" ></td>
			
			<td class="top_input"><input type="hidden" value="<?php echo $val['pro_modifier_sequence'];?>" class="org_txt"><input type="number" name="sequence[<?php echo $val['pro_modifier_primary_id']; ?>]" value="<?php echo $val['pro_modifier_sequence']; ?>" class="seq_form_control edit_numberbox inp_type" onkeypress="return isNumber(event)"></td>
			
	        <td class="top_input"><a href="javascript:;"><?php echo show_status($val['pro_modifier_status'],$val['pro_modifier_primary_id']);?></a></td>

			 <td width="100px"> 
			 <a href="javascript:void(0);" class="main_undo"><i class="fa fa-undo" aria-hidden="true"></i></a> 
			 <a href="<?php echo admin_url().'modifiervalues/add/'.encode_value($val['pro_modifier_primary_id']);?>"><i class ="fa fa-plus-square-o" title="<?php echo get_label('add_modifier_value')?>"> </i></a>&nbsp;
			 <a href="<?php echo admin_url().$module.'/edit/'.encode_value($val['pro_modifier_primary_id']);?>"><i class="fa fa-edit" title="<?php echo get_label('edit')?>"></i></a>&nbsp;
			 <a href="javascript:;" class="delete_record" id="<?php echo encode_value($val['pro_modifier_primary_id']);?>" data="Delete"><i class="fa fa-trash" title="<?php echo get_label('delete')?>"></i></a> </td>
		</tr>
		
		
		
           <tr id="<?php echo $val['pro_modifier_primary_id']."modifier_id"; ?>" class="collapse ltable_outer" aria-expanded="false"> 
           <td >&nbsp;</td>
               <td colspan="4">
                   <table class="table loop_table">
                       <thead class="first">
                        <tr>
            
                            <th><?=get_label('pro_modifier_value_name') ; ?></th>
                            <th><?=get_label('pro_modifier_value_price')  ;?></th>
                            <th><?=get_label('pro_modifier_value_sequence')  ;?></th>
                            <th><?= get_label('status');?></th>
                            <th width="20px"><?=get_label('actions');?></th>


                        </tr>
                    </thead> 
                    
                      <?php 
                         if(!empty($modifier_values)){
                      	 foreach($modifier_values as $modval) {  ?>
                        <tr class="<?php echo $modval['pro_modifier_value_primary_id']."_subtr" ?>">
						<td class="sh_input"><input type="hidden" value="<?php echo trim(stripcslashes($modval['pro_modifier_value_name']));?>" class="org_txt"> <span class="spn"><?php echo trim(stripcslashes($modval['pro_modifier_value_name']));?></span> <input type="text" name="pro_modifier_value_name[<?php echo $val['pro_modifier_primary_id'] ?>][<?php echo $modval['pro_modifier_value_primary_id'] ?>]" value="<?php echo trim(stripcslashes($modval['pro_modifier_value_name']));?>" class="edit_txt edit_txt_hide inp_type form-control required"></td>
                        
                        <td class="sh_input"><input type="hidden" value="<?php echo output_value($modval['pro_modifier_value_price']);?>" class="org_txt"><span class="spn"><?php echo get_currency_symbol($modval['pro_modifier_value_price']);?></span><input type="text" name="pro_modifier_value_price[<?php echo $val['pro_modifier_primary_id'] ?>][<?php echo $modval['pro_modifier_value_primary_id'] ?>]" value="<?php echo output_value($modval['pro_modifier_value_price']);?>" class="edit_txt edit_txt_hide inp_type form-control"></td>
                        
                        <td class="sh_input"><input type="hidden" value="<?php echo output_value($modval['pro_modifier_value_sequence']);?>" class="org_txt"><span class="spn"><?php echo output_value($modval['pro_modifier_value_sequence']);?></span><input type="text" name="pro_modifier_value_sequence[<?php echo $val['pro_modifier_primary_id'] ?>][<?php echo $modval['pro_modifier_value_primary_id'] ?>]" value="<?php echo output_value($modval['pro_modifier_value_sequence']);?>" class="edit_txt edit_txt_hide inp_type form-control"></td>
                        
                        <td class="sh_input">
						<input type="hidden" value="<?php echo output_value($modval['pro_modifier_value_status']);?>" class="org_txt">
						<div class="checkbox3 checkbox-inline checkbox-check checkbox-light">
						<?php $iscehcked = ($modval['pro_modifier_value_status']=='A')?TRUE:FALSE  ?>
						<?php echo form_checkbox('pro_modifier_value_status['.$val["pro_modifier_primary_id"].']['.$modval["pro_modifier_value_primary_id"].']','A',$iscehcked,' class="edit_chkbox inp_type" id="'.$modval["pro_modifier_value_primary_id"].'_sub_inner_check" ');?>
						<label for="<?php echo $modval['pro_modifier_value_primary_id'].'_sub_inner_check' ?>" class="chk_box_label"></label>
						</div>
						</td>

                        
                        <td><a
				href="<?php echo camp_url().'modifiervalues/edit/'.encode_value($modval['pro_modifier_value_primary_id'])."/".encode_value($modval['pro_modifier_value_modifier_primary_id']);?>"><i
					class="fa fa-edit" title="<?php echo get_label('edit')?>"></i></a>
					<a href="javascript:void(0);" class="sub_undo"><i class="fa fa-undo" aria-hidden="true"></i></a>
		                    </td></tr>
                      <?php  } }?>
                      
                    <tr class="add_sub_tr <?php echo $val['pro_modifier_primary_id']; ?>_sub_tr"><td><a href="javascript:void(0);" class="add_sub_grup" rel="<?php echo $val['pro_modifier_primary_id']; ?>"><i class="fa fa-plus-square" aria-hidden="true"></i> &nbsp;Add Modifier Value</a></td> <td></td> <td></td> <td></td> <td></td> </tr>
                   </table>
               </td>
           </tr>
           
         
          
<?php  } }  else { ?>
<tr class="no_records">

			<td colspan="15" class=""><?php echo sprintf(get_label('admin_no_records_found'),$module_labels); ?></td>
		</tr>

<?php } ?>

 <tr class="add_main_tr"> <td></td> <td><a href="javascript:void(0);" class="add_main_grup" rel=""><i class="fa fa-plus-square" aria-hidden="true"></i> &nbsp;Add Modifier</a></td> <td></td> <td></td> <td></td> </tr>

</tbody>
 <thead class="last">
		<tr>
			<th><div
					class="checkbox3 checkbox-inline checkbox-check checkbox-light"> <?= form_checkbox('multicheck','Y',FALSE,' class="multicheck_bottom"  type="checkbox"  id="mul_check_bottom"');?>  <label
						for="mul_check_bottom" class="chk_box_label"></label>
				</div></th>
						<th><?=get_label('pro_modifier_name').add_sort_by('pro_modifier_name',$module); ?></th>
			<th><?=get_label('pro_modifier_sequence').add_sort_by('pro_modifier_sequence',$module); ;?></th>
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
                        <button class="btn btn-default multi_action" data="Sequence"  type="button"><?php echo get_label('sequence');?></button>
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
<script type="text/javascript" src="<?php echo admin_skin()?>js/onpage.js"></script>
<script type="text/javascript">
var sub_increment=1;
var main_increment=1;
$(document).ready(function(){

    $(document).on("click",".expand",function() {

         $(this).toggleClass('open_icon');
         return false;
         
       
	});
	
	$(document).on("click",".add_sub_grup",function() {
		  
		    var tr_rel =$(this).attr('rel');
		    var modifier_values_html='<tr class="new_sub_tr new_'+tr_rel+"_"+sub_increment+'">'+
			'<td class=""><input type="text" name="new_pro_modifier_value_name['+tr_rel+']['+sub_increment+']" value="" class="form-control required"></td>'+
			'<td class=""><input type="text" name="new_pro_modifier_value_price['+tr_rel+']['+sub_increment+']" value="" class="form-control"></td>'+
			'<td class=""><input type="text" name="new_pro_modifier_value_sequence['+tr_rel+']['+sub_increment+']" value="" class="form-control"></td>'+
			'<td class="">'+
			'<div class="checkbox3 checkbox-inline checkbox-check checkbox-light">'+
			'<input type="checkbox" id="'+sub_increment+'_check" class="" value="A" name="new_pro_modifier_value_status['+tr_rel+']['+sub_increment+']">'+
			'<label class="chk_box_label" for="'+sub_increment+'_check"></label>'+
			'</div>'+
			'</td>'+
			'<td><a href="javascript:void(0);" class="revert_undo"><i class="fa fa-undo"></i></a>'+
			'</td></tr>';
			$( modifier_values_html ).insertBefore( '.'+tr_rel+'_sub_tr.add_sub_tr');
			sub_increment++;
	 });
    
	 $(document).on("click",".add_main_grup",function() {
		  
		    
		    var modifier_html='<tr class="new_main_tr new_'+main_increment+'">'+
		    '<td></td>'+
			'<td class=""><input type="text" name="new_modifier_name['+main_increment+']" value="" class="form-control required new_place_error"></td>'+
			'<td class=""><input type="number" name="new_sequence['+main_increment+']" value="" class="seq_form_control"></td>'+
			'<td class="">'+
			'<div class="checkbox3 checkbox-inline checkbox-check checkbox-light">'+
			'<input type="checkbox" id="'+main_increment+'_main_check" class="" value="A" name="new_modifier_status['+main_increment+']">'+
			'<label class="chk_box_label" for="'+main_increment+'_main_check"></label>'+
			'</div>'+
			'</td>'+
			'<td><a href="javascript:void(0);" class="main_revert_undo"><i class="fa fa-undo"></i></a>'+
			'</td></tr>';
			$( modifier_html ).insertBefore( '.add_main_tr');
			main_increment++;
	  });
	  
});
			
</script>
