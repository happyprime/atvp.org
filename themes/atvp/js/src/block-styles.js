// WordPress dependencies
import { __ } from '@wordpress/i18n';

wp.domReady( () => {
	// Register styles for the button block.
	wp.blocks.registerBlockStyle( 'core/button',
		{
			name: 'arrow-link',
			label: __( 'Arrow link' ),
		}
	);

	// Register styles for the list block.
	wp.blocks.registerBlockStyle( 'core/list',
		{
			name: 'icon-replacement',
			label: __( 'Icon replacement' ),
		}
	);

	// Unregister the "Outline" style from the button block.
	wp.blocks.unregisterBlockStyle( 'core/button', 'outline' );
} );
