(() => {
	document.documentElement.classList.add('storybreeze-js');

	const toggle = document.querySelector('.menu-toggle');
	const navigation = document.querySelector('.primary-navigation');
	const mobileBreakpoint = 860;

	if (!toggle || !navigation) {
		return;
	}

	const isDesktop = () => window.innerWidth > mobileBreakpoint;

	const closeMenu = () => {
		navigation.classList.remove('is-open');
		toggle.setAttribute('aria-expanded', 'false');
	};

	const openMenu = () => {
		navigation.classList.add('is-open');
		toggle.setAttribute('aria-expanded', 'true');
	};

	toggle.setAttribute('aria-expanded', 'false');

	toggle.addEventListener('click', () => {
		const expanded = toggle.getAttribute('aria-expanded') === 'true';
		if (expanded) {
			closeMenu();
			return;
		}
		openMenu();
	});

	document.addEventListener('click', (event) => {
		if (isDesktop()) {
			return;
		}

		if (!navigation.classList.contains('is-open')) {
			return;
		}

		if (navigation.contains(event.target) || toggle.contains(event.target)) {
			return;
		}

		closeMenu();
	});

	navigation.querySelectorAll('a').forEach((link) => {
		link.addEventListener('click', () => {
			if (!isDesktop()) {
				closeMenu();
			}
		});
	});

	document.addEventListener('keyup', (event) => {
		if (event.key === 'Escape') {
			closeMenu();
		}
	});

	window.addEventListener('resize', () => {
		if (isDesktop()) {
			closeMenu();
		}
	});
})();
