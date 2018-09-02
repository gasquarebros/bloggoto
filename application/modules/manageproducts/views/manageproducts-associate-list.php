<tr class="associates-item">
	<td>
		<div class="form-group field-productassociates-0-product_name">
			<input name="ProductAssociates[0][product_name][]" class="form-control" id="productassociates-0-product_name" value="" type="text">
			<input name="ProductAssociates[0][product_ids][]" class="form-control" id="productassociates-0-product_ids" value="" type="hidden">
		</div>									
	</td>
	<td>
		<div class="form-group field-productassociates-0-product_sku">
			<input name="ProductAssociates[0][product_sku][]" class="form-control" id="productassociates-0-product_sku" value="" type="text">
		</div>									
	</td>
	<td class="associates_dropdown">
		<?php if(!empty($selected_modifiers)) { 
			foreach($selected_modifiers as $sel_modifier) { 
				$assigned_modifier_values = get_modifier_list(array('pro_modifier_value_modifier_id'=>$sel_modifier));

				if(!empty($assigned_modifier_values)) { 
		?>
					<select name="ProductAssociates[<?php echo $sel_modifier; ?>][]">
						<?php 
						foreach($assigned_modifier_values as $modifiervalue) { ?>
							<option value="<?php echo $modifiervalue['pro_modifier_value_id']; ?>"><?php echo $modifiervalue['pro_modifier_value_name']; ?></option>
						<?php 
						}
						?>
					</select>	
		<?php	}
		?>
				
		<?php }
		} ?>
	</td>
	<td>
		<div class="form-group field-productassociates-0-product_price">
			<input name="ProductAssociates[0][product_price][]" class="form-control" id="productassociates-0-product_price" value="" type="text">
		</div>									
	</td>
	<td>
		<div class="form-group field-productassociates-0-product_special_price">
			<input name="ProductAssociates[0][product_special_price][]" class="form-control" id="productassociates-0-product_special_price" value="" type="text">
		</div>									
	</td>
	<td>
		<div class="form-group field-productassociates-0-product_qty">
			<input name="ProductAssociates[0][product_qty][]" class="form-control" id="productassociates-0-product_qty" value="" type="text">
		</div>									
	</td>
	<td style="width: 90px; verti" class="text-center vcenter">
		<button class="remove-associates btn btn-danger btn-xs" type="button"><span class="fa fa-minus"></span></button>
	</td>
</tr>
	