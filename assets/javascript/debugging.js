(function() {

	/**
	 * Adds a class to the body class based on the hash,
	 * initially added to enable conditionally
	 * applying some debugging styles.
	 * 
	 * @return {[type]} [description]
	 */
	bodyHashClass = function() {
		var hash_name = window.location.hash.replace('#','');
		document.body.classList.add( hash_name );
	}

	document.onreadystatechange = function() {
		if (document.readyState === 'complete') {
			bodyHashClass();
		}
	};
	window.onhashchange = bodyHashClass;
})();