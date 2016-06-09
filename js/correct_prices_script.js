//console.info("starting js in plugin correct_prices");

jQuery(document).ready(function($){
	  
		 if( $( ".correcr_price_shortcode" ).length ) {
	  
			  var price_dollar_today = corrrect_prices_current_rate;
			  $(".correct_prices").each(function() { 
					var $this = $(this);
						$this.text( ($this.text() * price_dollar_today).toFixed(2));

			  });

		  }

});







