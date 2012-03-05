/*
 * Convert normal links into ajax links 
 * - so JS Enabled users doesn't have to reload the WHOLE page
 *
 * Copyright 2011 Sajak & Farki. All rights reserved.
 * (http://sajakfarki.com)
 */

(function($) {


	$.fn.ajaxifyLinks = function( options )
	{
	
		 var settings = {
	      'ignoreClasses'	: 'noAjaxify',
	      'ignoreExt' 		: new Array( 'jpg', 'png', 'pdf',' gif', '#' ),
	      'internalOnly'	: true,
	      'ajaxSep'			: '#!'
	    };
	    
	    // overwrite default settings with passed in options
	    if ( options ) { 
        	$.extend( settings, options );
      	}
	
		// check for ignore classes
		var ignoreStr = '';
		var sep = '';
		
		if( settings.ignoreClasses instanceof Array ){		
			// ignoreClasses is an array
			for( i=0; i<settings.ignoreClasses.length; i++ ){
				
				ignoreStr += sep + '.' + settings.ignoreClasses[i];
				
				if( sep == '' ){
					sep = ', ';
				}
			}
		}else if( settings.ignoreClasses != undefined && settings.ignoreClasses.length > 0 ){
		
			// ignoreClasses is a string
		
			// add the '.' if it isn't on there already
			if( settings.ignoreClasses.indexOf( '.' ) != 0 ){
				ignoreStr = '.';
			}
			
		 	ignoreStr += settings.ignoreClasses;
		}
		
		
		// file exts - build up a regex string
		var fileExtStr = '';
		sep = '';
		if( settings.ignoreExt instanceof Array ){
			
			for( i=0; i< settings.ignoreExt.length; i++ ){
				
				fileExtStr += sep + '(' + settings.ignoreExt[i] + ')';
				
				if( sep == '' ){
					sep = '|';
				}
			}
		}else if( settings.ignoreExt != undefined && settings.ignoreExt.length > 0 ){
		
			// ignoreExt is a string
			if( settings.ignoreClasses.indexOf( '(' ) == 0 ){
				fileExtStr = settings.ignoreExt[i];	
			}else {
				fileExtStr = '(' + settings.ignoreExt[i] + ')';
			}
		}
	
		var extMatch = new RegExp( '\\.' + fileExtStr  + '$', 'i');	
		var rootUrl = location.protocol + '//' + location.host;
	
		this.attr( 'href', function( i, link ){
							
			// only convert if it's not already ajaxified!
			if( link != undefined && link.indexOf( settings.ajaxSep ) == -1 ){
			
				// ignore some resources that aren't pages
				if( !link.match( extMatch ) ){
								
					var newLink = link.replace( rootUrl, '' );
					
					// only change internal links
					if( settings.internalOnly == false || 
						( newLink.indexOf( '://' ) == -1 && newLink.indexOf( 'mailto:' ) == -1 ) ){ 
										
						if( !$(this).is( ignoreStr ) ){
							link = '/' + settings.ajaxSep + newLink;
						}
					}
				
				}
			}
			
			return link;
		});
		
		return this;
	};
	
})(jQuery);