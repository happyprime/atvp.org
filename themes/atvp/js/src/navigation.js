import { __ } from '@wordpress/i18n';

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
			menuLabel: {
				open: __( 'Open menu' ),
				close: __( 'Close menu' ),
			},
			submenuLabel: {
				open: __( 'Open sub-menu' ),
				close: __( 'Close sub-menu' ),
			},
		};

		let property;

		for ( property in options ) {
			if ( Object.prototype.hasOwnProperty.call( options, property ) ) {
				defaults[ property ] = options[ property ];
			}
		}

		return defaults;
	};

	const setMarginBottomValue = () => {
		const siteFooter = document.querySelector( '.site-footer' );

		if ( siteFooter ) {
			settings.menu.style.setProperty(
				'--margin-bottom',
				`${ siteFooter.offsetHeight }px`
			);
		}
	};

	/**
	 * Add a class to the menu element to leverage for progressive enhacement.
	 *
	 * @private
	 */
	const updateMenu = () => {
		settings.menu.classList.add( 'js-menu' );

		setMarginBottomValue();
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
		menuToggle.setAttribute( 'aria-label', settings.menuLabel.open );
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
		const ariaExpanded = expanded ? 'true' : 'false';
		const ariaLabel = expanded
			? settings.submenuLabel.close
			: settings.submenuLabel.open;

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
			const toggleButton =
				listItem.classList.contains( 'current-menu-ancestor' ) ||
				listItem.classList.contains( 'current-menu-item' )
					? getSubMenuToggle( true )
					: getSubMenuToggle();

			listItem.insertBefore( toggleButton, submenu );
		} );

		menu.classList.add( 'has-sub-menus', 'js-has-sub-menus' );
	};

	/**
	 * Handle click events.
	 *
	 * @private
	 * @param {Event} event The click event.
	 */
	const clickHandler = ( event ) => {
		let target = event.target;
		let label;
		let elementToToggle;

		if ( target.classList.contains( 'js-sub-menu-toggle' ) ) {
			label = settings.submenuLabel;
			elementToToggle = target.nextElementSibling;
		} else {
			target = settings.toggle;
			label = settings.menuLabel;
			elementToToggle = settings.menu;

			document.body.classList.toggle( `${ settings.menu.id }-open` );
		}

		const expanded =
			'false' === target.getAttribute( 'aria-expanded' )
				? 'true'
				: 'false';

		label =
			label.open === target.getAttribute( 'aria-label' )
				? label.close
				: label.open;

		target.setAttribute( 'aria-expanded', expanded );
		target.setAttribute( 'aria-label', label );

		elementToToggle.classList.toggle( 'toggled-open' );
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
		settings.toggle.removeEventListener( 'click', clickHandler, false );
		settings.menu
			.querySelectorAll( '.js-sub-menu-toggle' )
			.forEach( ( subMenuToggle ) => {
				subMenuToggle.removeEventListener(
					'click',
					clickHandler,
					false
				);
			} );
		window.removeEventListener( 'resize', setMarginBottomValue, false );

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
		settings.toggle.addEventListener( 'click', clickHandler, false );
		settings.menu
			.querySelectorAll( '.js-sub-menu-toggle' )
			.forEach( ( subMenuToggle ) => {
				subMenuToggle.addEventListener( 'click', clickHandler, false );
			} );

		window.addEventListener( 'resize', setMarginBottomValue, false );
	};

	return navigation;
} );
