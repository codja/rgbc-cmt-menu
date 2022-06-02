const firstLvlMenuItems = document.querySelectorAll( '.rgbcode-menu__first-lvl-menu-item' );
const firstLvlLinks = document.querySelectorAll( '.rgbcode-menu__first-lvl-link' );
const backBtn = document.querySelector( '.rgbcode-menu-header__back' );
const langBar = document.querySelector( '.rgbcode-menu__first-lvl-menu-item.lang_bar_item' );

export function detectTablet() {
	return window.innerWidth <= 1280;
}

export const deselectLinks = () => {
	firstLvlMenuItems.forEach( link => {
		link.classList.remove( 'rgbcode-menu-active' );
	} )
}

export const hideBackBtn = () => {
	backBtn.classList.remove( 'show' );
}

const showBtn = () => {
	backBtn.classList.add( 'show' );
}

const langBarTransform = () => {
	if ( langBar ) {
		langBar.classList.add( 'lang_bar_active' );
	}
}

export const langBarTransformDisable = () => {
	if ( langBar ) {
		langBar.classList.remove( 'lang_bar_active' );
	}
}

const menuItemsHandler = ( item, add = true ) => {
	if ( add ) {
		deselectLinks();
		item.classList.add( 'rgbcode-menu-active' )
	} else {
		item.classList.toggle( 'rgbcode-menu-active' )
	}
	if ( ! item.classList.contains( 'lang_bar_item' ) ) {
		showBtn();
		langBarTransform();
	}
}

export function initLinks() {
	firstLvlLinks.forEach( item => {
		item.addEventListener('click', (evt) => {
			if (
				detectTablet()
				&& ! item.parentElement.classList.contains( 'rgbcode-menu-active' )
				|| item.parentElement.classList.contains( 'lang_bar_item' )
			) {
				evt.preventDefault();
			}
		});
	} );

	firstLvlMenuItems.forEach( item => {
		item.addEventListener( 'mouseenter', ( e ) => {
			if ( detectTablet() ) {
				return;
			}
			menuItemsHandler( item );
		} );

		item.addEventListener( 'click', ( e ) => {
			if ( detectTablet() && ( ! item.classList.contains( 'rgbcode-menu-active' ) || item.classList.contains( 'lang_bar_item' ) ) ) {
				menuItemsHandler( item, false );
				const secondMenu = item.querySelector( '.rgbcode-menu__second-lvl-menu' );
				const isNotHaveScroll = secondMenu.scrollHeight <= secondMenu.clientHeight;
				if ( isNotHaveScroll ) {
					secondMenu.classList.add( 'rgbcode-menu__second-lvl-menu_no-mask' );
					secondMenu.nextElementSibling.classList.add( 'rgbcode-menu-scrolldown_hide' );
				}
			}
		} );
	} );

	backBtn.addEventListener( 'click', () => {
		deselectLinks();
		hideBackBtn();
		langBarTransformDisable()
	} );

	document.querySelector( '.rgbcode-menu' ).addEventListener( 'mouseleave', ( e ) => {
		if ( detectTablet() ) {
			return;
		}
		setTimeout( () => {
			deselectLinks();
		}, 300 );
	} );
}
