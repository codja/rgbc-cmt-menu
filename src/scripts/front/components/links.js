export function initLinks() {
	const firstLvlLinks = document.querySelectorAll( '.rgbcode-menu__first-lvl-menu-item' );

	const deselectLinks = () => {
		firstLvlLinks.forEach( link => {
			link.classList.remove( 'rgbcode-menu-active' );
		} )
	}

	firstLvlLinks.forEach( item => {
		item.addEventListener( 'mouseenter', ( e ) => {
			deselectLinks();
			item.classList.add( 'rgbcode-menu-active' );
		} );
	} );

	// document.querySelector( '.rgbcode-menu' ).addEventListener( 'mouseleave', ( e ) => {
	// 	setTimeout( () => {
	// 		deselectLinks();
	// 	}, 300 );
	// } );
}
