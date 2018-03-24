/* browse file type*/

$(document).ready(function() {
    var fileinput=$('input[type=file]');
        fileinput.change(function() {
        $(this).next('.result_browsefile').html('<span class="brows">Browse: </span>'+$(this).val());
     });
        
 $("body").on("change", "input:file", function() {       	
     $(this).next('.result_browsefile').html('<span class="brows">Browse: </span>'+$(this).val());
   });
});
  /* browse file type end*/

/* Tooltip */
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
});
/* Tooltip end */

/*print view function on the popup*/
 function myFunction(elem)
    {
        Popup($(elem).html());
    }

    function Popup(data)
    {
        var mywindow = window.open('', 'new div', 'height=400,width=600');
        mywindow.document.write('<html><head><title>Table Information</title>');
        mywindow.document.write('</head><body >');
        mywindow.document.write(data);
        mywindow.document.write('</body></html>');
        mywindow.print();
        mywindow.close();
        return true;
    }
	
/*orders send to customer on business panel*/
$('body').on('click','.send_email',function(){
    var id = this.id;
    var message = "Are you sure want to send order details to customer?";
    customAlertmsg(message);  
    $('#alt1').click(function(){
            //ajax request
            $.ajax({
                url: admin_url + module + "/order_email",
                data: {'secure_key': secure_key,'id':id},
                type:'POST',
                dataType:"json",
                success:function(data){
                    if(data.status == "ok")
                    {  
                        showerror('alert-success',data.msg);
                    }
                }
            });
        });
});
function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}
