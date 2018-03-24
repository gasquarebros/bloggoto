<textarea  class="form-control required" id="email_template" name="email_template" rows="10" style="width:100px;"><?php echo $email_template;?></textarea>
<script type="text/javascript">
	
	CKEDITOR.replace( 'email_template',
	{
		
		uiColor: '#DAF2FE',
		forcePasteAsPlainText:	true,
		toolbar :
        [
            ['Source','-','-'],
			['PasteFromWord','-', 'SpellChecker'],
			['SelectAll','RemoveFormat'],
			['ImageButton'],
			['Bold','Italic','Underline','-','Subscript','Superscript'],
			['NumberedList','BulletedList','-','Blockquote'],
			['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
			['Link','Unlink','Anchor'],
			['Image','Flash','Table','HorizontalRule','SpecialChar','PageBreak','Format','Font','FontSize','TextColor','BGColor']
        ],
		
		filebrowserBrowseUrl : '<?php echo load_lib();?>ckfinder/ckfinder.html',
		filebrowserImageBrowseUrl : '<?php echo load_lib();?>ckfinder/ckfinder.html?Type=Images',
		filebrowserFlashBrowseUrl : '<?php echo load_lib();?>ckfinder/ckfinder.html?Type=Flash',
		filebrowserUploadUrl : '<?php echo load_lib();?>ckfinder/connector/php/connector.php?command=QuickUpload&type=Files',
		filebrowserImageUploadUrl : '<?php echo load_lib();?>ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
		filebrowserFlashUploadUrl : '<?php echo load_lib();?>ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
		skin : 'kama'
		
			
	});
	
	//]]>
</script>
