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
				modal: true,
				callbacks: {
					open: function() {
						CKEDITOR.replace( 'post_description',{
							uiColor: '#DAF2FE',
							forcePasteAsPlainText:	true,
							toolbar :
							[
								['PasteFromWord','-', 'SpellChecker'],
								['SelectAll','RemoveFormat'],
								['Bold','Italic','Underline','-','Subscript','Superscript'],
								['NumberedList','BulletedList','-','Blockquote'],
								['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
								['Link','Unlink','Anchor'],
								['Image','Table','HorizontalRule','SpecialChar','PageBreak','Format','Font','FontSize','TextColor','BGColor']
							],
							filebrowserBrowseUrl: '<?php echo load_lib();?>ckeditor/ckfinder/ckfinder.html',
							filebrowserUploadUrl: '<?php echo load_lib();?>ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
							filebrowserWindowWidth: '1000',
							filebrowserWindowHeight: '700'
							
						});
					}
				}
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
			modal: true,
			callbacks: {
				open: function() {
					CKEDITOR.replace( 'post_description',{
						uiColor: '#DAF2FE',
						forcePasteAsPlainText:	true,
						toolbar :
						[
							['PasteFromWord','-', 'SpellChecker'],
							['SelectAll','RemoveFormat'],
							['Bold','Italic','Underline','-','Subscript','Superscript'],
							['NumberedList','BulletedList','-','Blockquote'],
							['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
							['Link','Unlink','Anchor'],
							['Image','Table','HorizontalRule','SpecialChar','PageBreak','Format','Font','FontSize','TextColor','BGColor']
						],
						filebrowserBrowseUrl: '<?php echo load_lib();?>ckeditor/ckfinder/ckfinder.html',
						filebrowserUploadUrl: '<?php echo load_lib();?>ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
						filebrowserWindowWidth: '1000',
						filebrowserWindowHeight: '700'

						
					});
				}
			}
		});
	}
</script>