	const lazyloadRunObserver = () => {
			const lazyloadBackgrounds = document.querySelectorAll(`.e-con.e-parent:not(.e-lazyloaded)`);
			const lazyloadBackgroundObserver = new IntersectionObserver((entries) => {
				entries.forEach((entry) => {
					if (entry.isIntersecting) {
						let lazyloadBackground = entry.target;
						if (lazyloadBackground) {
							lazyloadBackground.classList.add('e-lazyloaded');
						}
						lazyloadBackgroundObserver.unobserve(entry.target);
					}
				});
			}, { rootMargin: '200px 0px 200px 0px' });
			lazyloadBackgrounds.forEach((lazyloadBackground) => {
				lazyloadBackgroundObserver.observe(lazyloadBackground);
			});
		};
		const events = [
			'DOMContentLoaded',
			'elementor/lazyload/observe',
		];
		events.forEach((event) => {
			document.addEventListener(event, lazyloadRunObserver);
		});



        {"prefetch":[{"source":"document","where":{"and":[{"href_matches":"\/footclub\/sports-club\/*"},{"not":{"href_matches":["\/footclub\/sports-club\/wp-*.php","\/footclub\/sports-club\/wp-admin\/*","\/footclub\/sports-club\/wp-content\/uploads\/*","\/footclub\/sports-club\/wp-content\/*","\/footclub\/sports-club\/wp-content\/plugins\/*","\/footclub\/sports-club\/wp-content\/themes\/footclub\/*","\/footclub\/sports-club\/*\\?(.+)"]}},{"not":{"selector_matches":"a[rel~=\"nofollow\"]"}},{"not":{"selector_matches":".no-prefetch, .no-prefetch a"}}]},"eagerness":"conservative"}]}