buster.testCase("SOCD::Mapping", {
	tearDown: function() {
		delete window.SOCD.Mapping;
	},
	"has been loaded": function() {
		window.innerWidth = 360;
		assert.isObject(window.SOCD.Mapping);
	},
	"not loaded on small viewport": function() {
		window.innerWidth = 10;
		assert.equals( typeof window.SOCD.Mapping, 'undefined' );
	},
});