<?php if(count($orders) > 0){?> 
	
	
	<div class="item_bought_table_section  mCustomScrollbar scroll_bar">
	   <div class="item_bought_table_content" >
		  <table>
			 <tr>
				<th class="text-left">Itemname</th>
				<th >count</th>
				<th>price per unit</th>
				<th >total</th>
			 </tr>
			 <div class="order_details">
				 <?php foreach($orders as $order){ ?>
				 <tr>
					<td  class="text-left"><?php echo output_value($order['item_name']);?></td>
					<td> <?php echo $order['count'];?></td>
					<td><?php echo show_price($order['item_unit_price']);?></td>
					<td><?php echo show_price($order['item_total_amount']);?></td>
				 </tr>
				 <?php } ?>
			 </div>
		  </table>
	   </div>
	</div>
	
	 
<?php }
else
{
	?>
	<div class="item_bought_table_section  mCustomScrollbar scroll_bar">
	   <div class="item_bought_table_content" >
		  <table>
			 <tr>
				<th class="text-left">Itemname</th>
				<th >count</th>
				<th>price per unit</th>
				<th >total</th>
			 </tr>
			 <div class="order_details">			 
				 <tr>
					 <td></td>
					 <td>
					<b><strong><?php echo "No Items Found";?></strong></b>
					</td>
				 </tr>				
			 </div>
		  </table>
	   </div>
	</div>
	<?php
}
?>
