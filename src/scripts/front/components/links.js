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
	return window.innerWidth < 1280;
}

export const deselectLinks = () => {
	firstLvlMenuItems.forEach( ( link ) => {
		link.classList.remove( 'rgbcode-menu-active' );
	} );
};

const hideActiveMenu = ( e ) => {
	deselectLinks();
	hideBackBtn();
	langBarTransformDisable();
};

export const hideBackBtn = () => {
	const menuItems = document.querySelectorAll(
		'.rgbcode-menu__first-lvl-link'
	);

	if ( ! menuItems ) {
		return null;
	}

	menuItems.forEach( ( item ) => {
		item.classList.remove( 'rgbcode-menu-header__back' );
	} );
};

const showBackBtn = ( item ) => {
	const menuItem = item.querySelector( '.rgbcode-menu__first-lvl-link' );

	if ( ! menuItem ) {
		return null;
	}

	menuItem.classList.add( 'rgbcode-menu-header__back' );
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
		showBackBtn( item );
		langBarTransform();
	}
};

export function initLinks() {
	firstLvlLinks.forEach( ( item ) => {
		item.addEventListener( 'click', ( evt ) => {
			if (
				( detectTablet() &&
					! item.parentElement.classList.contains(
						'rgbcode-menu-active'
					) ) ||
				item.parentElement.classList.contains( 'lang_bar_item' ) ||
				item.closest( '.rgbcode-menu-header__back' )
			) {
				evt.preventDefault();
			}
		} );
	} );

	firstLvlMenuItems.forEach( ( item ) => {
		item.addEventListener( 'mouseenter', ( e ) => {
			if ( detectTablet() ) {
				return;
			}
			menuItemsHandler( item );
		} );

		item.addEventListener( 'click', ( e ) => {
			if (
				detectTablet() &&
				( ! item.classList.contains( 'rgbcode-menu-active' ) ||
					item.classList.contains( 'lang_bar_item' ) )
			) {
				menuItemsHandler( item, false );
			} else {
				if ( ! detectTablet() ) {
					return null;
				}

				const menuItem = item.querySelector(
					'.rgbcode-menu__first-lvl-link.rgbcode-menu-header__back'
				);

				if (menuItem &&
					e.target.closest('.rgbcode-menu-header__back')
				) {
					hideActiveMenu(item);
				}
			}
		} );
	} );

	document
		.querySelector( '.rgbcode-menu' )
		.addEventListener( 'mouseleave', ( e ) => {
			if ( detectTablet() ) {
				return;
			}
			deselectLinks();
		} );
}
