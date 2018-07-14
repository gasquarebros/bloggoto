var btn;
$(document).ready(function() {
	var base_url = admin_url;
     btn = $('.alt_btns .confirm');
    $('body').on('click', '#post_reply', function(){
        if ($("#frm-send_replay").valid()) {
        datas = new FormData();
        datas.append( 'secure_key', secure_key);
		var value = CKEDITOR.instances['message_body'].getData();
        datas.append( 'message_body', value);
        datas.append( 'notification_id', $('#notification_id').val());
        $.ajax({
            url         : base_url+"conversations/post_reply",
            data        : datas,
            cache       : false,
            contentType : false,
            processData : false,
            dataType    : "JSON",
            type        : 'POST',
            success     : function(result, textStatus, jqXHR){
                if(result.status=='success') {
                    //sqSnackBar(result.message,3000);
                    $('#load_reply').append(result.datas);
                    $('#message_body').val('');
                    $('.accordion-toggle').trigger('click');
                }
            }
        });
        }
		else { console.log('invalid'); }
    });

    $('body').on('click', '.trash', function() {
        confirm_msg = $(this).data('confirm');
        
       //roots1 = $(this).parents('tr').find('.total_register');
        curent_type = $(this).data('types');
        if(curent_type!=1) {
            roots = $(this).parents('li');
        }

        var id = $(this).data('ids');
        if ( (typeof (id) != 'undefined'))
        {
			var confirm_trash = confirm(confirm_msg);
        //customAlertmsg(confirm_msg); 
        //$( "#alt1" ).click(function() {
		if(confirm_trash ) {
           // btn.button('loading');
            datas = new FormData();
            datas.append( 'secure_key', secure_key);
            datas.append( 'notification_id', id);
            datas.append( 'curent_type', curent_type);
            $.ajax({
                url         : base_url+"conversations/trash",
                data        : datas,
                cache       : false,
                contentType : false,
                processData : false,
                dataType: "json",
                type        : 'POST',
                success: function(result){
                    if(result.status='success') {
                        //btn.button('reset');
                        $('.alrt_overlay, .custom_alert').remove();
                       // sqSnackBar(result.message,3000);
                        if(curent_type!=1) {                    
                            roots.remove(); 

                        }
                        if(curent_type==1) {
                            setTimeout(function(){                 
                                window.location.href =base_url+'conversations?filter=trash';                   
                                return false;                   
                            }, 3000);
                        }  
                        if(curent_type==2) {
                            setTimeout(function(){                 
                                window.location.href =base_url+'conversations?filter=trash';                   
                                return false;                   
                            }, 3000);
                        }
                        if(curent_type==3) {
                            setTimeout(function(){                 
                                window.location.href =base_url+'conversations';                   
                                return false;                   
                            }, 3000);
                        }
                               
                    }
                },
                failure: function(errMsg) {
                    alert(errMsg);
                }
            });
        }
        /*});*/
        return false
        }
    });

    var validator =$('#frm-conversations').validate();

    $('body').on('click', '#create_message', function(){
        if($('#user_id').val()==null) {
            $('#subject_error').html('Please select user');
        }
        else {
             $('#subject_error').html('');
        }
        if ($("#frm-conversations").valid()) {
            if($('#user_id').val()=='') {
                $('#subject_error').html('Please select user');
            }
            else {
                $('#subject_error').html('');
                btn = $(this);
                //btn.button('loading');
                var form = $('#frm-conversations');
				var value = CKEDITOR.instances['message'].getData();
				$('#message').val(value);
				$('#message').html(value);
                var formdata = false;
                if (window.FormData){
                    formdata = new FormData(form[0]);
					//var value = CKEDITOR.instances['message'].getData();
					formdata.append( 'message', value);
                }
				
                $.ajax({
                    url         : base_url+"conversations/create_message",
                    data        : formdata ? formdata : form.serialize(),
                    cache       : false,
                    contentType : false,
                    processData : false,
                    dataType    : 'JSON',
                    type        : 'POST',
                    success     : function(result, textStatus, jqXHR){
                        //sqSnackBar(result.message,3000);
                        //btn.button('reset');
                        setTimeout(function(){                 
                            window.location.href =base_url+result.redirect;                   
                            return false;                   
                        }, 3000);
                    }
                });
            }
        }

    });
	$('.accordion-toggle').click(function() {
		var section = $(this).attr('href');
		$(section).toggle();
		return false;
	});

});