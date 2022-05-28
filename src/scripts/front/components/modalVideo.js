const html = document.querySelector( 'html' ),
	modal = document.querySelector( '.rgbcode-menu-modal' ),
	buttonInModal = modal.querySelector( '.rgbcode-menu-modal__close' ),
	modalWindow = modal.querySelector( '.rgbcode-menu-modal__window' );

const showModal = () => {
	html.style.overflow = 'hidden';
	modal.style.display = 'flex';
};

const hideModal = () => {
	html.style.overflow = '';
	modal.style.display = 'none';
};

const parseMediaURL = ( media ) => {
	let regexp = /https:\/\/i\.ytimg\.com\/vi\/([a-zA-Z0-9_-]+)\/maxresdefault\.jpg/i;
	let url = media.src;
	let match = url.match( regexp );

	return match[1];
}

const generateURL = ( id ) => {
	let query = '?rel=0&showinfo=0&autoplay=1';

	return 'https://www.youtube.com/embed/' + id + query;
}

const createIframe = ( id ) => {
	let iframe = document.createElement('iframe');

	iframe.setAttribute('allowfullscreen', '');
	iframe.setAttribute('allow', 'autoplay');
	iframe.setAttribute('src', generateURL( id ));
	iframe.classList.add('rgbcode-menu-video__media');

	return iframe;
}

const setupVideo = ( video ) => {
	let media = video.querySelector( '.rgbcode-menu-video__media' );
	let id = parseMediaURL( media );
	let iframe = createIframe( id );

	video.addEventListener( 'click', () => {
		modalWindow.appendChild( iframe );
		showModal();
	} );

	buttonInModal.addEventListener( 'click', () => {
		hideModal();
		iframe.remove();
	} );
}

export function initVideo() {
	let videos = document.querySelectorAll('.rgbcode-menu-video');

	if ( ! videos.length ) {
		return;
	}

	videos.forEach( video => setupVideo(video) );
}
