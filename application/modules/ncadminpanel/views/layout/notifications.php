
<?php  /* if($this->session->flashdata('admin_error'))
{  */ ?>

<div role="alert" class="alert alert-danger alert-dismissible cmmn_error" style="display: <?php echo  ($this->session->flashdata('admin_error') !="")? 'block' : 'none'; ?>;">
    <i class="fa fa-exclamation-circle alert_li"></i>
  <label class="msg">  <?php echo $this->session->flashdata('admin_error');?></label>
            <button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">X</span></button>         
        </div>


       
<?php   /* 
}
elseif($this->session->flashdata('admin_warning')) {  */?>       

 <div role="alert" class=" alert alert-warning alert-dismissible cmmn_error" style="display: <?php echo  ($this->session->flashdata('admin_warning') !="")? 'block' : 'none'; ?>;">
        <i class="fa fa-info-circle alert_li"></i>
         <label class="msg"> <?php echo $this->session->flashdata('admin_warning');?></label>
            <button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">X</span></button>
         
        </div> 

 

<?php   /* 
}
elseif($this->session->flashdata('admin_success')) { */ ?>

   <div role="alert" class="alert alert-success alert-dismissible cmmn_error"  style="display: <?php echo  ($this->session->flashdata('admin_success') !="")? 'block' : 'none'; ?>;">
        <i class="fa fa-check-circle alert_li"></i>
        <label class="msg"> <?php echo $this->session->flashdata('admin_success');?></label>
            <button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">X</span></button>
         
        </div>



<?php  /* } */ ?>


    
