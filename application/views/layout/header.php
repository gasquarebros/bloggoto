<?php load_meta_tags(array('metatitle'=>(isset($meta_title))?$meta_title:get_label('site_title'),'metacontent'=>(isset($meta_description)? $meta_description : 'Now Read, Write, Comment, Review, Share, Sell, Buy, Advertise and Much More. Its all Yours!! Free Signup and always will be.'),'metakeyword'=>(isset($meta_keyword)? $meta_keyword : 'Social Media Made More Easy, Fast and Relevant')));?>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1" name="viewport" />
    
<link rel="shortcut icon" type="image/png" href="<?php echo skin_url().'images/favicon.png'; ?>"/>  


<link rel='stylesheet' href='<?php echo load_lib(); ?>jquery/css/jquery-ui.css' type='text/css' media='all' />
<link rel='stylesheet' href='<?php echo skin_url(); ?>css/font-awesome.css' type='text/css' media='all' />
<link rel='stylesheet' href='<?php echo skin_url(); ?>css/magnific-popup.css' type='text/css' media='all' />
<link rel='stylesheet' href='<?php echo skin_url(); ?>css/style.css' type='text/css' media='all' />
<link rel='stylesheet' href='<?php echo skin_url(); ?>css/responsive.css' type='text/css' media='all' />

<link rel='stylesheet' href='<?php echo load_lib(); ?>chosen/css/chosen.min.css' type='text/css' media='all' />

<script type="text/javascript" src="<?php echo load_lib()?>jquery/jquery-2.2.2.min.js"></script>
<script type="text/javascript" src="<?php echo load_lib()?>jquery/jquery-ui.js"></script>

<link rel="stylesheet" type="text/css" href="<?php echo load_lib(); ?>autocomplete/jquery.auto-complete.css">		
<script type="text/javascript" src="<?php echo load_lib(); ?>autocomplete/jquery.auto-complete.js"></script>		
<script type="text/javascript" src="<?php echo load_lib(); ?>autocomplete/jquery.ui.autocomplete.html.js"></script>		
<link rel="stylesheet" type="text/css" href="<?php echo skin_url(); ?>css/search.css">		
<script type="text/javascript" src="<?php echo skin_url(); ?>js/search.js"></script>

<?php /* common javascript varibles ...*/ ?>
<script>
 var admin_url ="<?php echo base_url(); ?>";
 var SITE_URL ="<?php echo base_url(); ?>";
 var LOGIN_URL =  "<?php echo base_url().'login';?>";
 var lod_lib = "<?php echo load_lib(); ?>";
 var module ="<?php echo $module; ?>";
 var module_label = "<?php echo $module_label; ?>";
 var module_labels = "<?php echo $module_labels; ?>";
 var module_action  = "<?php echo (isset($module_action)? $module_action : '' );?>"; 
 var custom_redirect_url  = "<?php echo (isset($custom_redirect_url)? $custom_redirect_url : '' );?>"; 
 var secure_key = "<?php echo $this->security->get_csrf_hash(); ?>";
 var onpage_save = "<?php echo ( isset( $module_save ) && ( $module_save !='') ) ?$module_save:""; ?>";
</script>
 

<script type="text/javascript">

 <?php /* Change  status */ ?>  
$(document).ready(function(){

$('body').on('click', '.status,.delete_record', function() { 
var id = this.id;
var action = $(this).attr('data');

  if ( (typeof (id) != 'undefined') && (typeof (action) != 'undefined') )
  {
	  customAlertmsg("Are you sure you want to " + action + " this "+ module_label + "?");	
	   $( "#alt1" ).click(function() { 
		   
		   $("#actionid").val(action);
		   $("#changeId").val(id);  
		   action_submit( {id:id, action: action });	
		   
	      });

	      return false
  }
 
});


<?php /* check and uncheck all rdio buttons  */ ?>
$('body').on('click', '.multicheck_top, .multicheck_bottom', function() {     
	if($(this).is(':checked')==true)
	{  
		$('.multi_check,.multicheck_top, .multicheck_bottom').attr("checked", "checked");
		$('.multi_check,.multicheck_top, .multicheck_bottom').prop('checked', true);
	}
	else
	{       
		$(".multi_check,.multicheck_top, .multicheck_bottom").removeAttr("checked");  
		$('.multi_check,.multicheck_top, .multicheck_bottom').prop('checked', false);
	}     
});

<?php /*  if check all checkbox selct parent check box */  ?>
	$('body').on('click', '.multi_check', function() { 
	var multichecklength = $('.multi_check').length;
	var multiunchecklength = $('.multi_check:checked').length; 
		if(multichecklength == multiunchecklength)
	{
		 $(".multicheck_top, .multicheck_bottom").attr('checked','checked');
		  $('.multicheck_top, .multicheck_bottom').prop('checked', true);
	}
	else
	{
		$(".multicheck_top, .multicheck_bottom").removeAttr('checked');
		  $('.multicheck_top, .multicheck_bottom').prop('checked', false);
	}
});

});

<?php /*  alert for conformation in multible actions  */ ?>
function confirm_alert(error)
{
	var x=window.confirm(error);
	if (x) { 
            return true;
	} else {
	        return false;
	}
}

<?php /* cancel form to redirect parent module  */ ?>
function cancelform(url)
{ 
    var url;
	window.location=url; 
}

</script>
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
