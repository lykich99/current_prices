//console.info("starting js in plugin correct_prices");

if(!window.jQuery)
{
	      
      
  	getScript('http://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js', function() {
	
		if (typeof jQuery=='undefined') {
		
			     // Super failsafe - still somehow failed...
			     console.info('jQuery undefined');
		
		} else {
		
			      // jQuery loaded!
			
			     if( $( ".correcr_price_shortcode" ).length ) {
  
					  var price_dollar_today = corrrect_prices_current_rate;
					  $(".correct_prices").each(function() { 
							var $this = $(this);
								$this.text( ($this.text() * price_dollar_today).toFixed(2));
					  });

				 }
			
			

	  }
	
   });


} else {

	jQuery(document).ready(function($){
	  
		 if( $( ".correcr_price_shortcode" ).length ) {
	  
			  var price_dollar_today = corrrect_prices_current_rate;
			  $(".correct_prices").each(function() { 
					var $this = $(this);
						$this.text( ($this.text() * price_dollar_today).toFixed(2));

			  });

		  }

	});


}




function getScript(url, success) {
	
		var script     = document.createElement('script');
		     script.src = url;
		
		var head = document.getElementsByTagName('head')[0],
		done = false;
		
		// Attach handlers for all browsers
		script.onload = script.onreadystatechange = function() {
		
			if (!done && (!this.readyState || this.readyState == 'loaded' || this.readyState == 'complete')) {
			
			done = true;
				
				// callback function provided as param
				success();
				
				script.onload = script.onreadystatechange = null;
				head.removeChild(script);
				
			};
		
		};
		
		head.appendChild(script);
	
}





