    <!-- CSS Libs -->
  
  <?php
  if( ! empty($download_path))
{
    $data = file_get_contents(load_lib() ."/file/".$download_path); // Read the file's contents
    $name = $download_path;
 
    force_download($name, $data);
 
}
  ?>
<div class="mfp_header">
       <?php echo get_label('import');?>
</div>
<div class="mfp_body" > 
	
	<ul class=" alert_msg  alert-danger  alert container_alert" style="display: none;" id="alerts">				
	</ul> 
 <?php echo form_open_multipart(camp_url().$module.'/import',' class="form-horizontal" id="common_form1"' );?>
    <table class="table "  sytle="margin-bottom:0;">
		                <div class="form-group">
							<label for="inputEmail3" class="col-sm-4 control-label"><?php echo get_label('simple_product_import_file');?></label>
							<div class="col-sm-4"> <div class="input_box"> <div class="custom_browsefile"> <?php echo form_upload('csc_file11');?> <span class="result_browsefile"><span class="brows"></span>+ <?php echo get_label('import_file');?></span> </div> </div> </div>
												
							<a class="btn export_btn" id="reset_search"  href="<?php echo camp_url().$module."/download/product-template.csv"?>"><i class="fa fa-download"></i>&nbsp; <?php echo "sample file";?></a>
						    <button type="submit" class="btn btn-primary " name="submit"
                                   onclick="return submits1('<?php echo camp_url().$module.'/import';?>');" value="Submit"><?php echo get_label('import');?></button>
						</div>
						 <div class="form-group">
							<label for="inputEmail3" class="col-sm-4 control-label"><?php echo get_label('combo_product_import_file');?></label>
							<div class="col-sm-4"> <div class="input_box"> <div class="custom_browsefile"> <?php echo form_upload('csc_file12');?> <span class="result_browsefile"><span class="brows"></span>+ <?php echo get_label('import_file');?></span> </div> </div> </div>
												
							<a class="btn export_btn" id="reset_search"  href="<?php echo camp_url().$module."/download/product-combo-template.csv"?>"><i class="fa fa-download"></i>&nbsp; <?php echo "sample file";?></a>
						    <button type="submit" class="btn btn-primary " name="submit"
                                   onclick="return submits1('<?php echo camp_url().$module.'/set_combo_product_import';?>');" value="Submit"><?php echo get_label('import');?></button>
						</div>
    
	              <?php /*  <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-<?php echo get_form_size();?>  btn_submit_div">

                                <button type="submit" class="btn btn-primary " name="submit"
                                   onclick="return submits1('<?php echo camp_url().$module.'/set_combo_product_import';?>');" value="Submit"><?php echo get_label('import');?></button>
                                   
							    <button type="submit" class="btn btn-primary clearbutton" name="clear"
								onclick="return submitclear('<?php echo camp_url().$module.'/clear_import';?>');" value="Clear"><?php echo get_label('clear_data');?></button>
								

                            </div>
                        </div> */?>
	 
   
    </table> 	
               <?php
					echo form_hidden ( 'action', 'Add' );
					echo form_close ();
					?>       
</div>


