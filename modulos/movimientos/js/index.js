	function calculo_cptosfijos()
	{
		var total=0;
		
		if(!isNaN(parseFloat($("#con.personal_cptosfijos").val())))		total=total+parseFloat($("#con.personal_cptosfijos").val());		
		
		if(!isNaN(parseFloat($("#imp.personal_cptosfijos").val())))		total=total+parseFloat($("#imp.personal_cptosfijos").val());		
		
		if(!isNaN(parseFloat($("#uni.personal_cptosfijos").val())))		total=total+parseFloat($("#uni.personal_cptosfijos").val());		
				
		
		total=parseInt(Math.round(total*100))/100;								
		
		//total=parseInt(parseFloat(total*100))/100;		
		$("input#cif.personal_cptosfijos").val(total);
	}	
	$(document).ready(function()
	{	
		$("input.personal_cptosfijos").focusout(function() 
		{		
			calculo_cptosfijos();
		});
		
			
	});	
		
		
