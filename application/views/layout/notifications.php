
<?php  /* if($this->session->flashdata('admin_error'))
{  */ ?>

		
	<div class="alert alert-danger fade in alert-dismissible" style="display: <?php echo  ($this->session->flashdata('admin_error') !="")? 'block' : 'none'; ?>;">
		<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
		<strong>Danger!</strong> <?php echo $this->session->flashdata('admin_error');?>
	</div>

       
<?php   /* 
}
elseif($this->session->flashdata('admin_warning')) {  */?>       

		
	<div class="alert alert-warning fade in alert-dismissible" style="display: <?php echo  ($this->session->flashdata('admin_warning') !="")? 'block' : 'none'; ?>;">
		<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
		<strong>Warning!</strong> <?php echo $this->session->flashdata('admin_warning');?>
	</div>	

 

<?php   /* 
}
elseif($this->session->flashdata('admin_success')) { */ ?>
	
	<div class="alert alert-success fade in alert-dismissible" style="display: <?php echo  ($this->session->flashdata('admin_success') !="")? 'block' : 'none'; ?>;">
		<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
		<strong>Success!</strong> <?php echo $this->session->flashdata('admin_success');?>
	</div>



<?php  /* } */ ?>



   <div role="alert" class="alert alert-action-success alert-dismissible cmmn_error"  style="display: <?php echo  ($this->session->flashdata('success') !="")? 'block' : 'none'; ?>;">
        <i class="fa fa-check-circle alert_li"></i>
        <label class="msg"> <?php echo $this->session->flashdata('success');?></label>
            <button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">X</span></button>
         
        </div>


    
<script>
	$(document).ready(function() {
		$(document).on('click','.close',function () {
			$(this).parent('div').remove();
		});
	});
</script>
