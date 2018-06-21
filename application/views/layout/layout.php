<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->
<head>
   <?php echo $this->load->view('layout/header');?>
</head>
<body <?php if($this->session->userdata ( "bg_user_id" )) { echo "loggedin = '".encode_value($this->session->userdata ( "bg_user_id" ))."'"; } else { echo "loggedin = ''"; } ?>>
	<?php echo get_template('layout/top-menu','')?>
	<?php echo get_template('layout/notifications','')?>
	<?php  echo $admin_body; ?>
	<?php echo $this->load->view('layout/footer');?>
    <?php echo $this->load->view('layout/footer-includes');?>
</body>
</html>
