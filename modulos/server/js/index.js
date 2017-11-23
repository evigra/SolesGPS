
	$(document).ready(function()
	{

		$("#traccar_play").button({
			icons: {	primary: "ui-icon-play" },
			text: true
		    })
		    .click(function(){
		        window.location="&sys_section=traccar_play";
		    }
	    );		
		$("#traccar_stop").button({
			icons: {	primary: "ui-icon-stop" },
			text: true
		    })
		    .click(function(){
		        window.location="&sys_section=traccar_stop";
		    }
	    );		
		$("#traccar_status").button({
			icons: {	primary: "ui-icon-note" },
			text: true
		    })
		    .click(function(){
		        window.location="&sys_section=traccar_status";
		    }
	    );		
		$("#server_reboot").button({
			icons: {	primary: "ui-icon-power" },
			text: true
		    })
		    .click(function(){
		        window.location="&sys_section=server_reboot";
		    }
	    );		
		$("#server_update").button({
			icons: {	primary: "ui-icon-refresh" },
			text: true
		    })
		    .click(function(){
		        window.location="&sys_section=server_update";
		    }
	    );		

    });
