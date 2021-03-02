( ( root, factory ) => {
	root.navigation = factory();
} )( typeof self !== 'undefined' ? self : this, () => {
	'use strict';

	// Object for public APIs.
	const navigation = {};

	// Placeholder for defaults merged with user settings.
	let settings;

	/**
	 * Merge user options with the default settings.
	 *
	 * @private
	 * @param {Object} options  User settings.
	 */
	const extendDefaults = ( options ) => {
		const defaults = {
			menu: null,
			toggle: null,
		};

		let property;

		for ( property in options ) {
			if ( Object.prototype.hasOwnProperty.call( options, property ) ) {
				defaults[ property ] = options[ property ];
			}
		}

		return defaults;
	};

	/**
	 * Add a class to the menu element to leverage for progressive enhacement.
	 *
	 * @private
	 */
	const updateMenu = () => {
		settings.menu.classList.add( 'js-menu' );
	};

	/**
	 * Update the `button` element used for toggling the menu.
	 *
	 * @private
	 */
	const updateMenuToggle = () => {
		const menuToggle = settings.toggle;

		menuToggle.classList.add( 'js-menu-toggle' );
		menuToggle.setAttribute( 'aria-expanded', 'false' );

		// Revisit for translation/internationalization.
		menuToggle.setAttribute( 'aria-label', 'Open menu' );
		menuToggle.hidden = false;
	};

	/**
	 * Return a `button` element to use for toggling sub-menus.
	 *
	 * @private
	 *
	 * @param {boolean} expanded Whether the section is open by default
	 *
	 * @return {Object} toggleButton
	 */
	const getSubMenuToggle = ( expanded = false ) => {
		const toggleButton = document.createElement( 'button' );
		const ariaExpanded = ( expanded ) ? 'true' : 'false';
		const ariaLabel = ( expanded ) ? 'Close sub-menu' : 'Open sub-menu';

		toggleButton.classList.add( 'submenu-toggle', 'js-sub-menu-toggle' );
		toggleButton.setAttribute( 'aria-expanded', ariaExpanded );
		toggleButton.setAttribute( 'aria-label', ariaLabel );

		return toggleButton;
	};

	/**
	 * Inject `button` elements where appropriate for toggling sub-menus.
	 *
	 * @private
	 */
	const addSubMenusToggles = () => {
		const menu = settings.menu;

		// Find any sub-menus.
		const subMenus = menu.querySelectorAll( 'ul' );

		// Return early if there are no sub-menus.
		if ( ! subMenus.length ) {
			return;
		}

		// Add a toggle button for each sub-menu.
		subMenus.forEach( ( submenu ) => {
			const listItem = submenu.parentElement;

			if ( listItem.querySelector( '.js-sub-menu-toggle' ) ) {
				return;
			}

			// Create the toggle button.
			const toggleButton = listItem.classList.contains( 'current-menu-ancestor' )
				? getSubMenuToggle( true )
				: getSubMenuToggle();

			listItem.insertBefore( toggleButton, submenu );
		} );

		menu.classList.add( 'has-sub-menus', 'js-has-sub-menus' );
	};

	/**
	 * Toggle attributes used for handling element display.
	 *
	 * @private
	 * @param {Event}  target   The click event target.
	 * @param {string} expanded The updated value for the `aria-expanded` attribute.
	 * @param {string} label    The updated value for the `aria-label` attribute.
	 * @param {Object} element  The element whose display is being toggled.
	 */
	const toggle = ( target, expanded, label, element ) => {
		target.setAttribute( 'aria-expanded', expanded );
		target.setAttribute( 'aria-label', label );

		element.classList.toggle( 'toggled-open' );
	};

	/**
	 * Handle click events.
	 *
	 * @private
	 * @param {Event} event The click event.
	 */
	const clickHandler = ( event ) => {
		const target = event.target;
		const expanded = ( 'false' === target.getAttribute( 'aria-expanded' ) )
			? 'true'
			: 'false';

		if ( target.classList.contains( 'js-menu-toggle' ) ) {
			// Revisit for translation/internationalization.
			const label = ( 'Open menu' === target.getAttribute( 'aria-label' ) )
				? 'Close menu'
				: 'Open menu';

			toggle( target, expanded, label, settings.menu );

			document.body.classList.toggle( `${ settings.menu.id }-open` );
		}

		if ( target.classList.contains( 'js-sub-menu-toggle' ) ) {
			// Revisit for translation/internationalization.
			const label = ( 'Open sub-menu' === target.getAttribute( 'aria-label' ) )
				? 'Close sub-menu'
				: 'Open sub-menu';

			toggle( target, expanded, label, target.nextElementSibling );
		}
	};

	/**
	 * Destroy the current initialization.
	 *
	 * @public
	 */
	navigation.destroy = () => {
		// Return early if the plugin isn't already initialized.
		if ( ! settings ) {
			return;
		}

		// Remove event listeners.
		settings.menu.removeEventListener( 'click', clickHandler, false );
		settings.toggle.removeEventListener( 'click', clickHandler, false );

		// Reset variables.
		settings = null;
	};

	/**
	 * Initializes the plugin.
	 *
	 * @public
	 * @param {Object} options        User settings.
	 * @param {Object} options.menu   The `ul` element containing the menu items. Required. Defaults to `null`.
	 * @param {Object} options.toggle The element used to toggle the disply of the menu. Required. Defaults to `null`.
	 */
	navigation.init = ( options ) => {
		// Check for required settings.
		if ( ! options.menu || ! options.toggle ) {
			return;
		}

		// Destroy any existing initializations.
		navigation.destroy();

		// Merge user options with defaults.
		settings = extendDefaults( options || {} );

		updateMenu();

		updateMenuToggle();

		addSubMenusToggles();

		// Listen for click events on the navigation element.
		settings.menu.addEventListener( 'click', clickHandler, false );
		settings.toggle.addEventListener( 'click', clickHandler, false );
	};

	return navigation;
} );
