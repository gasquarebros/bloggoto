    <!-- CSS Libs -->
  
<div class="mfp_header">
        Product Information
</div>
<div class="mfp_body">
    <table class="table "  sytle="margin-bottom:0;">
      
      <tr>
			<td><?php echo get_label('product_name');?></td>
            <td> <?php echo ((isset($records['product_name']) && ( !empty($records['product_name']) ) ) ? ucwords( strtolower( stripslashes( $records['product_name'] ) ) ):"N/A"); ?></td>
	  </tr>
	  
	  <tr>
			<td><?php echo get_label('product_short_description');?></td>
            <td> <?php echo ( isset($records['product_short_description']) && !empty($records['product_short_description']) )?stripslashes($records['product_short_description']):"N/A"; ?></td>
	  </tr>
	  
	   <tr>
			<td><?php echo get_label('product_long_description');?></td>
            <td> <?php echo ( isset($records['product_long_description']) && !empty($records['product_long_description']) )?stripslashes($records['product_long_description']):"N/A";  ?></td>
	  </tr>
	  
	   <tr>
			<td><?php echo get_label('product_sku');?></td>
            <td> <?php echo ( isset($records['product_sku']) && !empty($records['product_sku']) )?stripslashes($records['product_sku']):"N/A";  ?></td>
	  </tr>
	  
	   <tr>
			<td><?php echo get_label('product_barcode');?></td>
            <td> <?php echo ( isset($records['product_barcode']) && !empty($records['product_barcode']) )?stripslashes($records['product_barcode']):"N/A"; ?></td>
	  </tr>
	  
	   <tr>
			<td><?php echo get_label('product_sequence');?></td>
            <td> <?php echo ( isset($records['product_sequence']) && !empty($records['product_sequence']) )? output_integer($records['product_sequence']):"N/A"; ?></td>
	  </tr>
	  <?php if($client_ninja_pro_enable == 1) { ?>
	   <tr>
			<td><?php echo "Product Lead Time";?></td>
            <td> <?php echo ( isset($records['product_lead_time']) && !empty($records['product_lead_time']) )? output_integer($records['product_lead_time']):"N/A"; ?></td>
	  </tr>
	  <?php } ?>
	  <tr>
			<td><?php echo get_label('status');?></td>
            <td> <?php echo ( isset($records['product_status']) && !empty($records['product_status']) )?($records['product_status']=='A'?"Active":"Inactive"):"N/A" ?></td>
	  </tr>
	  
	  <tr>
			<td><?php echo get_label('product_class');?></td>
            <td> <?php echo ( isset($records['pro_class_name']) && !empty($records['pro_class_name']) )?ucwords(strtolower(stripslashes($records['pro_class_name']))):"N/A"; ?></td>
	  </tr>
	  
	  <tr>
			<td><?php echo get_label('product_categorie');?></td>
            <td> <?php echo ( isset($records['pro_subcate_name']) && !empty($records['pro_subcate_name']) )?ucwords(strtolower( stripslashes($records['pro_subcate_name']) )):"N/A"; ?></td>
	  </tr>
	  
	  <tr>
			<td><?php echo get_label('product_modifier');?></td>
            <td> <?php echo ( isset($records['pro_modifier_name']) && !empty($records['pro_modifier_name'] ))? ucwords( strtolower( rtrim( stripslashes($records['pro_modifier_name']), "," ) ) ):"N/A"; ?></td>
	  </tr>
	  
	  <tr>
			<td><?php echo get_label('product_availability');?></td>
            <td> <?php echo ( isset($records['av_name']) && !empty($records['av_name']) )? ucwords(strtolower(rtrim( stripslashes($records['av_name']), "," ))):"N/A"; ?></td>
	  </tr>
	  
	  <tr>
			<td><?php echo get_label('product_cost');?></td>
            <td> <?php echo ( isset($records['product_cost']) && !empty($records['product_cost']) )?output_integer($records['product_cost']):"N/A"; ?></td>
	  </tr>
	  
	  <tr>
			<td><?php echo get_label('product_price');?></td>
            <td> <?php echo ( isset($records['product_price']) && !empty($records['product_price']) )?show_price($records['product_price']):"N/A"; ?></td>
	  </tr>
	  
	  <tr>
			<td><?php echo get_label('product_alt_price');?></td>
            <td> <?php echo ( isset($records['product_alt_price']) && !empty($records['product_alt_price']) )?show_price($records['product_alt_price']):"N/A"; ?></td>
	  </tr>
	  
	  <tr>
			<td><?php echo get_label('product_spl_price');?></td>
            <td> <?php echo ( isset($records['product_special_price']) && !empty($records['product_special_price']) )?show_price($records['product_special_price']):"N/A"; ?></td>
	  </tr>
	  
	  <tr>
			<td><?php echo get_label('product_spl_price_from');?></td>
            <td> <?php echo ( isset($records['product_special_price_from_date']) && !empty($records['product_special_price_from_date']) )?output_date( $records['product_special_price_from_date']):"N/A"; ?></td>
	  </tr>
	  
	  <tr>
			<td><?php echo get_label('product_spl_price_to');?></td>
            <td> <?php echo ( isset($records['product_special_price_to_date']) && !empty($records['product_special_price_to_date']) )?output_date( $records['product_special_price_to_date'] ):"N/A"; ?></td>
	  </tr>
	  
	  <tr>
			<td><?php echo get_label('discount_applicable');?></td>
            <td> <?php echo ( isset($records['product_discount_allowed']) && !empty($records['product_discount_allowed']) )?$records['product_discount_allowed']:"N/A"; ?></td>
	  </tr>
	  
	  <tr>
			<td><?php echo get_label('product_reward_point');?></td>
            <td> <?php echo ( isset($records['product_reward_point']) && !empty($records['product_reward_point']) )?$records['product_reward_point']:"N/A"; ?></td>
	  </tr>
	  
	  <tr>
			<td><?php echo get_label('product_reward_point_eligible');?></td>
            <td> <?php echo ( isset($records['product_reward_allowed_purchase']) && !empty($records['product_reward_allowed_purchase']) )?$records['product_reward_allowed_purchase']:"N/A"; ?></td>
	  </tr>
	  
	 
       
    </table> 	
</div>
