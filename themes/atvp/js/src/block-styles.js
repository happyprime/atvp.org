// WordPress dependencies
import { __ } from '@wordpress/i18n';

wp.domReady( () => {
	// Register styles for the button block.
	wp.blocks.registerBlockStyle( 'core/button', {
		name: 'arrow-link',
		label: __( 'Arrow link' ),
	} );

	// Unregister the "Outline" style from the button block.
	wp.blocks.unregisterBlockStyle( 'core/button', 'outline' );
} );
