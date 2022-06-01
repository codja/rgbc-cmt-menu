import {deselectLinks, hideBackBtn, langBarTransformDisable} from "./links";

export function initMobileMenu() {
	const hamburger = document.querySelector( '.rgbcode-menu-hamburger' );
	const closeBtn  = document.querySelector( '.rgbcode-menu-header__close' );

	if ( ! hamburger ) {
		return;
	}

	hamburger.addEventListener( 'click', ( evt ) => {
		evt.currentTarget.classList.add( 'active' );
	} );

	closeBtn.addEventListener( 'click', ( evt ) => {
		hamburger.classList.remove( 'active' );
		deselectLinks();
		langBarTransformDisable();
		hideBackBtn();
	} );
}
