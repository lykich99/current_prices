(function() {
     /* Register the buttons */
     tinymce.create('tinymce.plugins.MyButtons', {
          init : function(ed, url) {
               /**
               * Add list button for edit panel
               */
              ed.addButton( 'button_correct_prices', {
                       			text: 'CorrectPricesCode',
			                    icon: false,
			                    type: 'menubutton',
			                    menu: [
			                     
			                              {
										    text: 'ShortCodeInsert',
									         onclick: function( e ) {
												        
														ed.insertContent( "[correct_prices_short_code]");
												
													}
												 
			                               },
			                               
			                               {
							                    text: 'InsertDataCorrectPrices',
							                    onclick: function() {
								                       ed.windowManager.open( {
									                   title: 'This data will be correct',
									                   body: [
										                       { 
											                     type: 'textbox',
											                     name: 'textboxName',
											                     label: 'Data',
											                     value: '0'
										                        }

									                          ],
												       onsubmit: function( e ) {
													         ed.insertContent( "<span class=\"correct_prices\">" + e.data.textboxName + "</span>");
												           }
								                   });
							                    }
						                    }
			                               
								      ]
                    
                    
                    
               });
               
               
          },
          createControl : function(n, cm) {
               return null;
          }, 
     });
     /* Start the buttons */
     tinymce.PluginManager.add( 'correct_prices_button_script', tinymce.plugins.MyButtons );
})();
