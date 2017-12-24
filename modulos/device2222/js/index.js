$(document).ready(function()
{         
    $("#slider3").responsiveSlides(
    {
	    auto: true,
	    pager: false,
	    nav: true,
	    speed: 500,
	    namespace: "callbacks",
	    before: function () {
	    		$('.events').append("<li>before event fired.</li>");
	    	},
	    after: function () {
	    		$('.events').append("<li>after event fired.</li>");
	    	}
    });

    $(".swipebox").swipebox();
				
	$().UItoTop({ easingType: 'easeOutQuart' });	

		
	$('#toTopHover').click(function(){        	

	    $("html, body").animate({ scrollTop: 0 }, 600);
	    return false;
		});
		

});

	
 

    
    
  
   
    
   
                   
   
 
