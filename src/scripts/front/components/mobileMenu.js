import {deselectLinks, hideBackBtn, langBarTransformDisable} from "./links";

export function initMobileMenu() {
	const html = document.querySelector( 'html' );
	const back = document.querySelector( '.rgbcode-menu-back' );
	const hamburger = document.querySelector( '.rgbcode-menu-hamburger' );
	const closeBtn  = document.querySelector( '.rgbcode-menu-header__close' );

	if ( ! hamburger ) {
		return;
	}

	hamburger.addEventListener( 'click', ( evt ) => {
		evt.currentTarget.classList.add( 'active' );
		back.classList.add( 'rgbcode-menu-back_active' );
		html.style.overflow = 'hidden';
	} );

	closeBtn.addEventListener( 'click', ( evt ) => {
		hamburger.classList.remove( 'active' );
		back.classList.remove( 'rgbcode-menu-back_active' );
		html.style.overflow = '';
		deselectLinks();
		langBarTransformDisable();
		hideBackBtn();
	} );
}
