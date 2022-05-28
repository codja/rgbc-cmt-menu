import { initLinks } from './components/links';
import { initVideo } from "./components/modalVideo";

document.addEventListener( 'DOMContentLoaded', () => {
	if ( ! document.getElementById( 'rgbcode-menu-header' ) ) {
		return;
	}
	initLinks();
	initVideo();
} );
