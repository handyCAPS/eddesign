
function showActiveMenuItem() {
"use strict";
	var location = window.location.pathname,
	nav = document.querySelectorAll('.top-nav a');

	for (var i = 0; i < nav.length; i++) {
		var reg = new RegExp(nav[i].attributes.href.value);
		if (reg.test(location)) {
			nav[i].parentElement.className += ' active-menu-item';
		}
	}
}

showActiveMenuItem();