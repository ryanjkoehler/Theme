
var config = module.exports;

config["My tests"] = {
	env: "browser",
	rootPath : "./",
	sources: [
		"assets/javascript/libs/modernizr.js",
		"assets/javascript/socd.js",
		"assets/javascript/viewport.js",
	],
	tests: [
		"test/*-test.js"
	]
}