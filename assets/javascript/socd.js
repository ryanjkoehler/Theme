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
		var screenSize = window.innerWidth + "x" + window.innerHeight;
		
		$('.beta').each(function() {
			$(this).attr('href', $(this).attr('href') + '%0D Screen Size: ' + screenSize );
		});
	}();

})();