
/* used to show the time picker for outlet in add and edit section */

$(function () {

	
	$('#mon_start').timepicker({
	showMinutes: true,
	showPeriod: true,
	showLeadingZero: true,
	onSelect: function(hour) {
	
	var ttime=hour.split(':');
	var ampm=ttime[1].split(" ");
	if(ampm[1]=="AM")
	{
		if(ttime[0]=='12')
		{
			nt="00";
		}
		else
		{
			nt=ttime[0];
		}
	}
	else if(ampm[1]=="PM")
	{
		var nt=parseInt(ttime[0])+12;
	}
	$('#mon_end').timepicker('option', { minTime: { hour: nt,minute:ampm[0]} });
	
	var end_time=$('#mon_end').val();
	if(end_time == '')
	{
		$('#mon_end').val(hour);
	}
	else
	{
		var from_time=_24hourformat(hour);
		var to_time=_24hourformat(end_time);
		if(from_time > to_time)
		{
			$('#mon_end').val(hour);
		}
		
	}
	
        }
	});
	$('#mon_end').timepicker({
		showMinutes: true,
		showPeriod: true,
		showLeadingZero: true
	});
	
	$('#tue_start').timepicker({
	showMinutes: true,
	showPeriod: true,
	showLeadingZero: true,
	onSelect: function(hour) {
	
	var ttime=hour.split(':');
	var ampm=ttime[1].split(" ");
	if(ampm[1]=="AM")
	{
		if(ttime[0]=='12')
		{
			nt="00";
		}
		else
		{
			nt=ttime[0];
		}
	}
	else if(ampm[1]=="PM")
	{
		var nt=parseInt(ttime[0])+12;
	}
	$('#tue_end').timepicker('option', { minTime: { hour: nt,minute:ampm[0]} });
	
	var end_time=$('#tue_end').val();
	if(end_time == '')
	{
		$('#tue_end').val(hour);
	}
	else
	{
		var from_time=_24hourformat(hour);
		var to_time=_24hourformat(end_time);
		if(from_time > to_time)
		{
			$('#tue_end').val(hour);
		}
		
	}
	
        }
	});
	$('#tue_end').timepicker({
		showMinutes: true,
		showPeriod: true,
		showLeadingZero: true
	});
	
	$('#wed_start').timepicker({
	showMinutes: true,
	showPeriod: true,
	showLeadingZero: true,
	onSelect: function(hour) {
	
	var ttime=hour.split(':');
	var ampm=ttime[1].split(" ");
	if(ampm[1]=="AM")
	{
		if(ttime[0]=='12')
		{
			nt="00";
		}
		else
		{
			nt=ttime[0];
		}
	}
	else if(ampm[1]=="PM")
	{
		var nt=parseInt(ttime[0])+12;
	}
	$('#wed_end').timepicker('option', { minTime: { hour: nt,minute:ampm[0]} });
	
	var end_time=$('#wed_end').val();
	if(end_time == '')
	{
		$('#wed_end').val(hour);
	}
	else
	{
		var from_time=_24hourformat(hour);
		var to_time=_24hourformat(end_time);
		if(from_time > to_time)
		{
			$('#wed_end').val(hour);
		}
		
	}
	
        }
	});
	$('#wed_end').timepicker({
		showMinutes: true,
		showPeriod: true,
		showLeadingZero: true
	});
	
	$('#thu_start').timepicker({
	showMinutes: true,
	showPeriod: true,
	showLeadingZero: true,
        onSelect: function(hour) {
	
	var ttime=hour.split(':');
	var ampm=ttime[1].split(" ");
	if(ampm[1]=="AM")
	{
		if(ttime[0]=='12')
		{
			nt="00";
		}
		else
		{
			nt=ttime[0];
		}
	}
	else if(ampm[1]=="PM")
	{
		var nt=parseInt(ttime[0])+12;
	}
	$('#thu_end').timepicker('option', { minTime: { hour: nt,minute:ampm[0]} });
	
	var end_time=$('#thu_end').val();
	if(end_time == '')
	{
		$('#thu_end').val(hour);
	}
	else
	{
		var from_time=_24hourformat(hour);
		var to_time=_24hourformat(end_time);
		if(from_time > to_time)
		{
			$('#thu_end').val(hour);
		}
		
	}
	
        }
	});
	$('#thu_end').timepicker({
		showMinutes:  true,
		showPeriod: true,
		showLeadingZero: true
	});
	
	$('#fri_start').timepicker({
	showMinutes: true,
	showPeriod: true,
	showLeadingZero: true,
	onSelect: function(hour) {
	
	var ttime=hour.split(':');
	var ampm=ttime[1].split(" ");
	if(ampm[1]=="AM")
	{
		if(ttime[0]=='12')
		{
			nt="00";
		}
		else
		{
			nt=ttime[0];
		}
	}
	else if(ampm[1]=="PM")
	{
		var nt=parseInt(ttime[0])+12;
	}
	$('#fir_end').timepicker('option', { minTime: { hour: nt,minute:ampm[0]} });
	
	var end_time=$('#fir_end').val();
	if(end_time == '')
	{
		$('#fir_end').val(hour);
	}
	else
	{
		var from_time=_24hourformat(hour);
		var to_time=_24hourformat(end_time);
		if(from_time > to_time)
		{
			$('#fir_end').val(hour);
		}
		
	}
	
        }
	});
	$('#fir_end').timepicker({
		showMinutes: true,
		showPeriod: true,
		showLeadingZero: true
	});
	
	$('#sat_start').timepicker({
	showMinutes: true,
	showPeriod: true,
	showLeadingZero: true,
	onSelect: function(hour) {
	
	var ttime=hour.split(':');
	var ampm=ttime[1].split(" ");
	if(ampm[1]=="AM")
	{
		if(ttime[0]=='12')
		{
			nt="00";
		}
		else
		{
			nt=ttime[0];
		}
	}
	else if(ampm[1]=="PM")
	{
		var nt=parseInt(ttime[0])+12;
	}
	$('#sat_end').timepicker('option', { minTime: { hour: nt,minute:ampm[0]} });
	
	var end_time=$('#sat_end').val();
	if(end_time == '')
	{
		$('#sat_end').val(hour);
	}
	else
	{
		var from_time=_24hourformat(hour);
		var to_time=_24hourformat(end_time);
		if(from_time > to_time)
		{
			$('#sat_end').val(hour);
		}
		
	}
	
        }
	});
	$('#sat_end').timepicker({
		showMinutes:  true,
		showPeriod: true,
		showLeadingZero: true
	});
	
	$('#sun_start').timepicker({
	showMinutes: true,
	showPeriod: true,
	showLeadingZero: true,
	onSelect: function(hour) {
	
	var ttime=hour.split(':');
	var ampm=ttime[1].split(" ");
	if(ampm[1]=="AM")
	{
		if(ttime[0]=='12')
		{
			nt="00";
		}
		else
		{
			nt=ttime[0];
		}
	}
	else if(ampm[1]=="PM")
	{
		var nt=parseInt(ttime[0])+12;
	}
	$('#sun_end').timepicker('option', { minTime: { hour: nt,minute:ampm[0]} });
	
	var end_time=$('#sun_end').val();
	if(end_time == '')
	{
		$('#sun_end').val(hour);
	}
	else
	{
		var from_time=_24hourformat(hour);
		var to_time=_24hourformat(end_time);
		if(from_time > to_time)
		{
			$('#sun_end').val(hour);
		}
		
	}
	
        }
	});
	$('#sun_end').timepicker({
		showMinutes: true,
		showPeriod: true,
		showLeadingZero: true
	});
	
	
	
});
