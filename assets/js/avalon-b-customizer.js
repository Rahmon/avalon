( function( $ ) {

	//Update header background.
	wp.customize( 'avalon_header_background_color', function( value ) {
		value.bind( function( newval ) {
			$( '.navbar-default' ).css( 'background-color', newval );
		} );
	} );

	//Update widget header background.
	wp.customize( 'avalon_widget_header_background_color', function( value ) {
		value.bind( function( newval ) {
			$( '.widget .title' ).css( 'background-color', newval );
		} );
	} );
	
} )( jQuery );