buster.testCase("SOCD::Viewport", {
	"Viewports present": function() {
		assert.isObject(SOCD.Viewport);
	},
	"isBiggerThan() method present": function() {
		assert.isFunction(SOCD.Viewport.isBiggerThan );
	},
	"isBiggerThan() works": function() {
		window.innerWidth = 350;
		assert.isTrue(SOCD.Viewport.isBiggerThan(340));
		window.innerWidth = 10;
		assert.isFalse(SOCD.Viewport.isBiggerThan(340));
	},
	"isSmallerThan() method present": function() {
		assert.isFunction(SOCD.Viewport.isSmallerThan );
	},
	"isSmallerThan() method works": function() {
		window.innerWidth = 350;
		assert.isFalse(SOCD.Viewport.isSmallerThan(340));
		window.innerWidth = 10;
		assert.isTrue(SOCD.Viewport.isSmallerThan(340));
	}
});