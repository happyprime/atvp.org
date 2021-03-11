import DOMPurify from 'dompurify';

( ( data ) => {
	if ( ! data ) {
		return;
	}

	document.querySelectorAll( '.is-style-icon-replacement a' )
		.forEach( ( link ) => {
			if ( data[ link.href ] ) {
				const originalHTML = link.innerHTML;

				link.innerHTML = DOMPurify.sanitize( data[ link.href ] );

				const span = link.querySelector( '.screen-reader-text' );

				if ( span ) {
					span.innerHTML = DOMPurify.sanitize( originalHTML );
				}
			}
		} );
} )( window.iconReplacementData );
