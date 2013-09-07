
var config = module.exports;

config["My tests"] = {
	env: "browser",
	rootPath : "./",
	sources: [
		"assets/javascript/socd.js",
		"assets/javascript/viewport.js",
		"assets/javascript/maps.js",
	],
	tests: [
		"test/*-test.js"
	]
}