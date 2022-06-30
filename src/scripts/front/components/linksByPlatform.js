export default () => {
	const containers = document.querySelectorAll(
		'.rgbcode-menu-platform-urls'
	);

	if ( ! containers ) {
		return null;
	}

	const androidElements = document.querySelectorAll(
		'.rgbcode-menu-platform-urls__items [data-platform="android"]'
	);
	const iosElements = document.querySelectorAll(
		'.rgbcode-menu-platform-urls__items [data-platform="ios"]'
	);
	const winElements = document.querySelectorAll(
		'.rgbcode-menu-platform-urls__items [data-platform="win"]'
	);
	const macElements = document.querySelectorAll(
		'.rgbcode-menu-platform-urls__items [data-platform="mac"]'
	);

	let currentElements;

	const ua = navigator.userAgent.toLowerCase();

	const isAndroid = ua.match( /android/i );
	const isIOS = ua.match( /(iphone|ipad|ipod)/i );
	const isWin = ua.match( /(win32|win64|windows|wince)/i );
	const isMac = ua.match( /(macintosh|macintel|macppc|mac68k|macos)/i );

	if ( isAndroid ) {
		currentElements = androidElements;
	} else if ( isIOS ) {
		currentElements = iosElements;
	} else if ( isWin ) {
		currentElements = winElements;
	} else if ( isMac ) {
		currentElements = macElements;
	} else if ( window.screen.width >= 1024 ) {
		currentElements = winElements;
	} else {
		currentElements = androidElements;
	}

	if ( currentElements ) {
		currentElements.forEach( ( item ) => {
			item.classList.remove( 'rgbcode-menu-platform-urls__hidden' );
		} );
	} else {
		containers.forEach( ( item ) => {
			item.classList.add( 'rgbcode-menu-platform-urls__hidden' );
		} );
	}
};
