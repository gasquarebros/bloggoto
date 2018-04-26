$(function () {
      $('#datetimepicker6').datetimepicker({
			format: 'dd-mm-yyyy hh:ii',
			autoclose: true,
            todayBtn: true,
            startDate: new Date(),
            useCurrent: true
			}); 
        $('#datetimepicker7').datetimepicker({
			format: 'dd-mm-yyyy hh:ii',
			autoclose: true,
            todayBtn: true,
            startDate: new Date(),
            useCurrent: true
        });
        $('#datetimepicker8').datetimepicker({
			format: 'dd-mm-yyyy hh:ii',
			autoclose: true,
            todayBtn: true,
            startDate: new Date(),
           useCurrent: true 
			});  
        $('#datetimepicker9').datetimepicker({
			format: 'dd-mm-yyyy hh:ii',
			autoclose: true,
            todayBtn: true,
            startDate: new Date(),
            useCurrent: true 
        });
         $("#datetimepicker6").change(function(e) 
         {
			var value= $(this).val();
            $('#datetimepicker7').datetimepicker('setStartDate',value);
        });
        $("#datetimepicker8").change(function(e)  
        {
			var value1= $(this).val();
           $('#datetimepicker9').datetimepicker('setStartDate',value1);
        });
        
      
    });
