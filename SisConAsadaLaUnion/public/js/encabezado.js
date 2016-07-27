$(document).ready(function() {

	var navBar = $('nav');

	if (navBar.length) {

  		var stickyNavTop = navBar.offset().top;
			
	}
	 
	var stickyNav = function(){

		var scrollTop = $(window).scrollTop();
      
		if (scrollTop > stickyNavTop) { 
    		
    		navBar.addClass('sticky');
			
			}else{ 
    			
    			navBar.removeClass('sticky'); 
			}

	};
 
	stickyNav();
 
	$(window).scroll(function() {
	   
	    stickyNav();
	
	});

});