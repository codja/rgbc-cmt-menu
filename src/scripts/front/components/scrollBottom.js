import {detectTablet} from "./links";

const scrollBlocks = document.querySelectorAll( '.rgbcode-menu__second-lvl-menu' );

export function initScrollBottom () {
	scrollBlocks.forEach( item => {
		item.addEventListener( 'scroll', () => {
			if ( ! detectTablet() ) {
				return;
			}
			if ( item.offsetHeight + item.scrollTop >= item.scrollHeight ) {
				item.classList.add( 'rgbcode-menu__second-lvl-menu_no-mask' );
				item.nextElementSibling.classList.add( 'rgbcode-menu-scrolldown_hide' );
			} else {
				item.classList.remove( 'rgbcode-menu__second-lvl-menu_no-mask' );
				item.nextElementSibling.classList.remove( 'rgbcode-menu-scrolldown_hide' );
			}
		} )
	} );
}