$(document).ready(function()
{
	$(".swipebox").swipebox();
	//alert("La sabrosa galletita de nuez");

	$().UItoTop({ easingType: 'easeOutQuart' });	


	$('#toTopHover').click(function(){        	

		$("html, body").animate({ scrollTop: 0 }, 600);
		return false;
	});

});
