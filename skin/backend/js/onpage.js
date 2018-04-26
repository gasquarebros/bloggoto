var sub_increment=1;
var main_increment=1;
$(document).ready(function(){

   
	
	/*Sub Modules Start*/
    $(document).on("click","tr .sh_input",function() {
		  
		    var tr_cls =$(this).parent('tr').attr('Class');
		    $('.'+tr_cls+" td .spn").hide();
            $('.'+tr_cls+" td .edit_txt").show();
            $('.'+tr_cls+" td a.sub_undo").show();
    });
    $(document).on("click",".sub_undo",function() {

		    var tr_cls =$(this).parent().parent('tr').attr('Class');
		    $('.'+tr_cls+" td .spn").show();
            $('.'+tr_cls+" td .edit_txt").hide();
            $('.'+tr_cls+" td a.sub_undo").hide();
            $('p.error').remove();
            $('.'+tr_cls+" td.sh_input").each(function(index) {
			var orginal_val=$(this).children('.org_txt').val();
			//var edit_val=$(this).children('.edit_txt').val();
			var text_type=$(this).children('.inp_type').attr('type');
			var checkbox_type=$(this).children().children('.inp_type').attr('type');
			
			if(checkbox_type=="checkbox")
			{
				
				if(orginal_val=="A")
				{
					if( ! ($(this).children().children('.edit_chkbox').is(":checked")) )
					{
						$(this).children().children('.edit_chkbox').prop( "checked", true );
					}
					
				}
				else if( orginal_val=="I" || orginal_val=="P")
				{
					if( $(this).children().children('.edit_chkbox').is(":checked") )
					{
						$(this).children().children('.edit_chkbox').prop( "checked", false );
					}
				}
			}
			
			if(text_type=="text")
			{
				$(this).children('.edit_txt').val(orginal_val)
			};
			
			
			});
            
	});
	
     $(document).on("click",".revert_undo",function() {
		$(this).parent().parent('tr').remove();
	 });
	 
	 /*Sub Moudules End*/
	 
	 /*Main Modules Start*/
	 
	 $(document).on("click","tr .top_input",function() {
	
		var tr_cls =$(this).parent('tr').attr('Class');
		$('.'+tr_cls+" td .spn").hide();
		$('.'+tr_cls+" td .edit_txt").show();
		$('.'+tr_cls+" td a.main_undo").show();
     });
     
     $(document).on("click",".main_undo",function() {
		 
		 
        
		var tr_cls =$(this).parent().parent('tr').attr('Class');
		$('.'+tr_cls+" td .spn").show();
		$('.'+tr_cls+" td .edit_txt").hide();
		$('.'+tr_cls+" td a.main_undo").hide();
		$('p.error').remove();
		$('.'+tr_cls+" td.top_input").each(function(index) {
		var orginal_val=$(this).children('.org_txt').val();
		
		var text_type=$(this).children('.inp_type').attr('type');
		
		if(text_type=="text")
		{
			$(this).children('.edit_txt').val(orginal_val)
		};
		if(text_type=="number")
		{
			$(this).children('.edit_numberbox').val(orginal_val)
		}
		
		
		});
            
	  });
	  
	 
	  
	  $(document).on("click",".main_revert_undo",function() {
		$(this).parent().parent('tr').remove();
	  });

	 /*Main Modules End*/
   
    $("#mainform").validate({ 
	ignore: "", 
	submitHandler: function() {
		var page_id = $("#page_id").val(); 
		$('p.error').remove();
                show_content_loading();
		$.ajax({
    	        url  : admin_url+module+"/"+onpage_save,
    	        data : $('#mainform').serialize(),
    	        type :'POST', 
    	        dataType:"json",
    	        success:function(data){
	           hide_content_loading();                                            
    	        if (data.status == "ok",data.exist==false) {
					
					sub_increment=1;
					main_increment=1;
					if(data.return_page=='current')
					{
						get_content({ page : page_id });
				    }
                                        else
                                        {
                                                    get_content({paging:"true"});	
                                        }
                                        showerror('alert-success',data.msg); 
				}
				
				if (data.status == "ok",data.exist==true) {
					
					
					$(data.sub_update_exist).each(function(index,value) {
						
						$( "<p class='error'>"+data.error_sub_lang+"</p>" ).insertAfter( '.'+value.update_sub_id+'_subtr .sh_input:first .edit_txt' );
					});
					
					$(data.sub_new_exist).each(function(index,value) {
						
						$( "<p class='error'>"+data.error_sub_lang+"</p>" ).insertAfter( '.new_'+value.new_main_id+'_'+value.new_sub_id+" td:first input" );
					});
					
					$(data.main_update_exist).each(function(index,value) {
						
						$( "<p class='error'>"+data.error_main_lang+"</p>" ).insertAfter('.'+value.update_main_id+'_maintr .top_input:first .edit_txt ');
					});
					
					$(data.main_new_exist).each(function(index,value) {
						
						$( "<p class='error'>"+data.error_main_lang+"</p>" ).insertAfter('.new_'+value.new_main_id+' td .new_place_error:first');
					});
				}
		}
    	 });
    }
    });
	


});
