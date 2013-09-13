/**
 * Core School of Communication Functionality
 * 
 */
(function() {
	var SOCD = window.SOCD || {};

	SOCD.Config = SOCD.Config || {};
	SOCD.breakpoints = [
		34 // Palm
	];


	SOCD.Debugger = function() {
		$('#beta').attr('href', $('#beta').attr('href') + '%0D Screen Size: ' + window.innerWidth + "x" + window.innerHeight );
	}();

})();