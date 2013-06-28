(function(w) {


	/**
	 * 
	 * @param  {String}   - URL to query.
	 * @param  {Function} - callback Passed responseText on success
	 * @return void
	 */
	w.xhr = function ( url, callback ) {

		var xhr = new XMLHttpRequest();

		xhr.open('GET', url, true);

		xhr.onload = function(e) {
			if (xhr.readyState === 4) {
				if ( xhr.status === 200) {
					callback(xhr.responseText);
				} else {
					console.error(xhr.statusText);
				}
			}
		} ;

		xhr.onerror = function(e) {
			console.error(xhr.statusText);
		}
		// Initiates the transfer
		xhr.send(null);
	}

})(window);