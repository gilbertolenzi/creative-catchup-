// remap jQuery to $
(function($){})(window.jQuery);


/* trigger when page is ready */
$(document).ready(function (){

  $(function(){
    
    var $container = $('.home #page-wrap');
    
    $container.imagesLoaded(function(){
      $container.masonry({
        itemSelector: '.home .post',
        columnWidth: 30,
        animationOptions: {
        	    duration: 1500
        	  }
      });
    });
    
    $container.infinitescroll({
      navSelector  : '.next-posts',    // selector for the paged navigation 
      nextSelector : '.next-posts a',  // selector for the NEXT link (to page 2)
      itemSelector : '.box',     // selector for all items you'll retrieve
      loading: {
          finishedMsg: 'No more pages to load.',
          img: 'http://i.imgur.com/6RMhx.gif'
        }
      },
      // trigger Masonry as a callback
      function( newElements ) {
        // hide new items while they are loading
        var $newElems = $( newElements ).css({ opacity: 0 });
        // ensure that images load before adding to masonry layout
        $newElems.imagesLoaded(function(){
          // show elems now they're ready
          $newElems.animate({ opacity: 1 });
          $container.masonry( 'appended', $newElems, true ); 
        });
      }
    );
    
  });
  //control the nice smooth scroll effect
  function filterPath(string) {
  	  return string
  	    .replace(/^\//,'')
  	    .replace(/(index|default).[a-zA-Z]{3,4}$/,'')
  	    .replace(/\/$/,'');
  	  }
  	  var locationPath = filterPath(location.pathname);
  	  var scrollElem = scrollableElement('html', 'body');
  	
  	  $('a[href*=#]').each(function() {
  	    var thisPath = filterPath(this.pathname) || locationPath;
  	    if (  locationPath == thisPath
  	    && (location.hostname == this.hostname || !this.hostname)
  	    && this.hash.replace(/#/,'') ) {
  	      var $target = $(this.hash), target = this.hash;
  	      if (target) {
  	        var targetOffset = $target.offset().top;
  	        $(this).click(function(event) {
  	          event.preventDefault();
  	          $(scrollElem).animate({scrollTop: targetOffset}, 400, function() {
  	            location.hash = target;
  	          });
  	        });
  	      }
  	    }
  	  });
  	
  	  // use the first element that is "scrollable"
  	  function scrollableElement(els) {
  	    for (var i = 0, argLength = arguments.length; i <argLength; i++) {
  	      var el = arguments[i],
  	          $scrollElement = $(el);
  	      if ($scrollElement.scrollTop()> 0) {
  	        return el;
  	      } else {
  	        $scrollElement.scrollTop(1);
  	        var isScrollable = $scrollElement.scrollTop()> 0;
  	        $scrollElement.scrollTop(0);
  	        if (isScrollable) {
  	          return el;
  	        }
  	      }
  	    }
  	    return [];
  	  }

});


/* optional triggers

$(window).load(function() {
	
});

$(window).resize(function() {
	
});

*/