export default () => {
	let pandaForexHeaderMenuBtn = window.rgbcode_menu_ajax.panda_forex_header_menu_button ?? '';
	pandaForexHeaderMenuBtn = JSON.parse(pandaForexHeaderMenuBtn);

	const observer = new MutationObserver(function (mutations_list) {
		mutations_list.forEach(function (mutation) {
			mutation.addedNodes.forEach(function (node) {

				if (!node || !node.closest) {
					return null;
				}

				const button = node.closest('button.forex-button-pandats');
				const isDeposit = node.closest('panda-forex-deposit-credit');
				const isWebTraderPage = (window.location.pathname.split('/')[1] ?? '') === 'webtrader';

				if (!button || !isDeposit || isWebTraderPage) {
					return null;
				}

				stopObserve();

				const textButton = button.innerText;

				if (textButton !== pandaForexHeaderMenuBtn.title) {
					let title = pandaForexHeaderMenuBtn.title;
					title = title ? title : 'Trading Room';
					button.innerText = title;

					let url = pandaForexHeaderMenuBtn.url;
					url = url ? url : '/webtrader';
					button.setAttribute('data-panda-forex-header-button-link', url);

					//remove all events
					button.outerHTML = button.outerHTML;

					listenClick();
				}

				startObserve();
			});
		});
	});

	const menu = document.getElementById("rgbcode-menu");

	if (!menu) {
		return null;
	}

	function startObserve() {
		observer.observe(menu, {childList: true, subtree: true});
	}

	function stopObserve() {
		observer.disconnect();
	}

	startObserve();

	function listenClick() {
		document.addEventListener('click', e => {
			const button = e.target.closest('[data-panda-forex-header-button-link]');

			if (!button) {
				return null;
			}

			let link = button.dataset.pandaForexHeaderButtonLink;

			if (link) {
				window.location.href = link;
			}
		});
	}
};
