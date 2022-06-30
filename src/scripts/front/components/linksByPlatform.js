export default () => {
	const container = document.querySelector( '.rgbcode-menu-platform-urls' );

	if ( ! container ) {
		return null;
	}

	const androidElement = document.querySelector(
		'.rgbcode-menu-platform-urls__items [data-platform="android"]'
	);
	const iosElement = document.querySelector(
		'.rgbcode-menu-platform-urls__items [data-platform="ios"]'
	);
	const winElement = document.querySelector(
		'.rgbcode-menu-platform-urls__items [data-platform="win"]'
	);
	const macElement = document.querySelector(
		'.rgbcode-menu-platform-urls__items [data-platform="mac"]'
	);

	let currentElement;

	const ua = navigator.userAgent.toLowerCase();

	const isAndroid = ua.match( /android/i );
	const isIOS = ua.match( /(iphone|ipad|ipod)/i );
	const isWin = ua.match( /(win32|win64|windows|wince)/i );
	const isMac = ua.match( /(macintosh|macintel|macppc|mac68k|macos)/i );

	if ( isAndroid ) {
		currentElement = androidElement;
	} else if ( isIOS ) {
		currentElement = iosElement;
	} else if ( isWin ) {
		currentElement = winElement;
	} else if ( isMac ) {
		currentElement = macElement;
	} else if ( window.screen.width >= 1024 ) {
		currentElement = winElement;
	} else {
		currentElement = androidElement;
	}

	if ( currentElement ) {
		currentElement.classList.remove( 'rgbcode-menu-platform-urls__hidden' );
	} else {
		container.classList.add( 'rgbcode-menu-platform-urls__hidden' );
	}
};
