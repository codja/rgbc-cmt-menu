import { initLinks } from './components/links';
import { initVideo } from './components/modalVideo';
import { initMobileMenu } from './components/mobileMenu';
import linksByPlatform from './components/linksByPlatform.js';

document.addEventListener( 'DOMContentLoaded', () => {
	if ( ! document.getElementById( 'rgbcode-menu-header' ) ) {
		return;
	}
	initMobileMenu();
	initLinks();
	initVideo();
	linksByPlatform();
} );
