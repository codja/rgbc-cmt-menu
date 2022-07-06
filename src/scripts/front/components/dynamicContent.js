export default () => {
	if (!window.rgbcode_menu_ajax) {
		return null;
	}

	const entities = document.querySelectorAll('[data-rgbcode-menu-dc-entity]');

	const ajaxUrl = window.rgbcode_menu_ajax.url;
	const nonce = window.rgbcode_menu_ajax.nonce;

	if (!entities || !ajaxUrl || !nonce) {
		return null;
	}

	entities.forEach((item) => {
		const entity = item.dataset.rgbcodeMenuDcEntity;

		const body = {
			action: 'rgbcode_menu_get_dynamic_content',
			nonce,
			entity,
		};

		fetch(ajaxUrl, {
			method: 'POST',
			headers: new Headers({
				'Content-Type': 'application/x-www-form-urlencoded',
			}),
			body: new URLSearchParams(body).toString(),
		}).then((response) => response.json()).then((responseData) => {
			if (responseData.data) {
				switch (entity) {
					case 'is-mobile':
						if (responseData.data === true) {
							item.classList.remove('rgbcode-menu-hidden');
						}
						break;
				}
			}
		}).catch(() => {
			//TODO
		}).finally(() => {
			//TODO
		});
	});
};
