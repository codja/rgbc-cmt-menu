const firstLvlMenuItems = document.querySelectorAll(
	'.rgbcode-menu__first-lvl-menu-item'
);
const firstLvlLinks = document.querySelectorAll(
	'.rgbcode-menu__first-lvl-link'
);
const langBar = document.querySelector(
	'.rgbcode-menu__first-lvl-menu-item.lang_bar_item'
);

export function detectTablet() {
	return window.innerWidth <= 1280;
}

export const deselectLinks = () => {
	firstLvlMenuItems.forEach( ( link ) => {
		link.classList.remove( 'rgbcode-menu-active' );
	} );
};

const langBarTransform = () => {
	if ( langBar ) {
		langBar.classList.add( 'lang_bar_active' );
	}
};

export const langBarTransformDisable = () => {
	if ( langBar ) {
		langBar.classList.remove( 'lang_bar_active' );
	}
};

const menuItemsHandler = ( item, add = true ) => {
	if ( add ) {
		deselectLinks();
		item.classList.add( 'rgbcode-menu-active' );
	} else {
		item.classList.toggle( 'rgbcode-menu-active' );
	}
	if ( detectTablet() && ! item.classList.contains( 'lang_bar_item' ) ) {
		langBarTransform();
	}
};

export function initLinks() {
	firstLvlMenuItems.forEach( ( item ) => {
		item.addEventListener( 'mouseenter', ( e ) => {
			if ( detectTablet() ) {
				return;
			}
			menuItemsHandler( item );
		} );
	} );

	document
		.querySelector( '.rgbcode-menu' )
		.addEventListener( 'mouseleave', ( e ) => {
			if ( detectTablet() ) {
				return;
			}
			setTimeout( () => {
				deselectLinks();
			}, 300 );
		} );

	// eslint-disable-next-line @wordpress/no-global-event-listener
	document.addEventListener( 'click', ( e ) => {
		if ( ! detectTablet() ) {
			return null;
		}

		const target = e.target;

		if (
			! elementHasMenuParent( target ) ||
			elementHasValidHyperlinkParent( target ) ||
			elementHasEditorParent( target )
		) {
			return null;
		}

		e.preventDefault();

		const menuParent = target.closest( '.menu-item-has-children' );

		if ( menuParent ) {
			menuParent.classList.toggle( 'rgbcode-menu-active' );
		}

		const currentActiveMenuRoot = target.closest(
			'.rgbcode-menu__first-lvl-menu-item.rgbcode-menu-active'
		);

		if ( ! currentActiveMenuRoot ) {
			return;
		}

		const activeMenus = document.querySelectorAll( '.rgbcode-menu-active' );

		activeMenus.forEach( ( item ) => {
			if (
				item.closest(
					'.rgbcode-menu__first-lvl-menu-item.rgbcode-menu-active'
				) !== currentActiveMenuRoot
			) {
				item.classList.remove( 'rgbcode-menu-active' );
			}
		} );
	} );

	const emptySubtitles = document.querySelectorAll(
		'.rgbcode-menu-empty-subtitle'
	);

	// eslint-disable-next-line @wordpress/no-global-event-listener
	document.addEventListener( 'click', ( e ) => {} );

	if ( emptySubtitles ) {
		emptySubtitles.forEach( ( item ) => {
			const element = item.closest( '.menu-item-has-children' );
			if ( element ) {
				element.classList.add( 'menu-item-has-children__hide-control' );
			}
		} );
	}
}

function elementHasMenuParent( e ) {
	return e.closest( '.menu-item-has-children' );
}

function elementHasValidHyperlinkParent( e ) {
	const link = e.closest( 'a' );
	if ( ! link ) {
		return false;
	}

	return link.href.trim().length !== 0;
}

function elementHasEditorParent( e ) {
	return e.closest( '.rgbcode-menu__editor' );
}
