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
       Import Customers
</div>
<div class="mfp_body" align="center"> 
	
	<ul class=" alert_msg  alert-danger  alert container_alert" style="display: none;" id="alerts">				
	</ul> 
	<button title="Close (Esc)" type="button" class="mfp-close">×</button>
 <?php echo form_open_multipart(camp_url().$module.'/import',' class="form-horizontal" id="common_form1"' );?>
    <table class="table "  sytle="margin-bottom:0;">
		<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('import_file');?></label>
							<div class="col-sm-8"> <div class="input_box"> <div class="custom_browsefile"> <?php echo form_upload('csc_file11');?> <span class="result_browsefile"><span class="brows"></span>+ <?php echo get_label('import_file');?></span> </div> </div> </div>
												
						    <a class="btn export_btn customer_butt" id="reset_search"  href="<?php echo camp_url().$module."/download"?>"><i class="fa fa-download"></i>&nbsp; <?php echo get_label('sample_file');?></a>
						
						</div>    	  
	                    <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-8  btn_submit_div">
                                <button type="submit" class="btn btn-primary " name="submit"
                                   onclick="return submits1('<?php echo camp_url().$module.'/import';?>');" value="Submit"><?php echo get_label('import');?></button>
                        
                            </div>
                        </div>
	 
   
    </table> 	
               <?php
					echo form_hidden ( 'action', 'Add' );
					echo form_close ();
					?>       
</div>


