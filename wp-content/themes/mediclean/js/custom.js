( function( $ ) {

  $(document).ready(function($){

  	// Team hover.
  	$('.thumb-summary-wrap').hover( function(){
  		$(this).children('.our-team-summary').stop().slideDown(300);
  	}, function(){
  		$(this).children('.our-team-summary').stop().slideUp(300);
  	});

  	// Search in Header.
  	if( $('.search-icon').length > 0 ) {
  		$('.search-icon').on( 'click',function(e){
  			e.preventDefault();
  			$('.search-box-wrap').slideToggle();
  		});
  	}

    // Trigger mobile menu.
    $('#mobile-trigger').sidr({
		timing: 'ease-in-out',
		speed: 500,
		source: '#mob-menu',
		name: 'sidr-main'
    });

    // Implement go to top.
	var $scroll_obj = $( '#btn-scrollup' );
	$( window ).on( 'scroll',function(){
		if ( $( this ).scrollTop() > 100 ) {
			$scroll_obj.fadeIn();
		} else {
			$scroll_obj.fadeOut();
		}
	});

	$scroll_obj.on( 'click',function(){
		$( 'html, body' ).animate( { scrollTop: 0 }, 600 );
		return false;
	});


  });

} )( jQuery );
