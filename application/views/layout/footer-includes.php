<script type='text/javascript' src='<?php echo skin_url(); ?>js/jquery.accordion.source.js'></script>
<script type='text/javascript' src='<?php echo skin_url(); ?>js/jquery.magnific-popup.js'></script>
<script type='text/javascript' src='<?php echo skin_url(); ?>js/script.js'></script>
<script type="text/javascript" src="<?php echo load_lib()?>jquery/jquery.form.min.js"></script>
<script type="text/javascript" src="<?php echo load_lib()?>jquery/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?php echo load_lib()?>chosen/js/chosen.jquery.min.js"></script>
<script type="text/javascript" src="<?php echo load_lib()?>theme/js/app.js"></script>
<script src="<?php echo skin_url()?>js/additional-methods.min.js" type="text/javascript"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('ul.device_nav').accordion();
		$(function () {
			$('.popup-modal').magnificPopup({
				type: 'inline',
				preloader: false,
				focus: '#username',
				modal: true
			});
			$(document).on('click', '.popup-modal-dismiss', function (e) {
				e.preventDefault();
				$.magnificPopup.close();
			});
		});
	});
	function trigger_modal_popup()
	{
		$('.popup-modal').magnificPopup({
			type: 'inline',
			preloader: false,
			focus: '#username',
			modal: true
		});
	}
</script>