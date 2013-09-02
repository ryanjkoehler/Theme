/**
 * 
 */
buster.testCase("SOCD", {
	"object exists in the window": function() {
		assert.equals( typeof window.SOCD, "object" );
	},
	"default breakpoints exist": function() {
		assert.defined(window.SOCD.breakpoints);
		assert.greater(window.SOCD.breakpoints.length, 0);
	},
	"configuration object present": function() {
		assert.isObject(window.SOCD.Config);
	}
	
});