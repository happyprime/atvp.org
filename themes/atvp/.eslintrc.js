/* global module */
module.exports = {
	extends: [
		'plugin:@wordpress/eslint-plugin/esnext',
	],
	env: {
		browser: true,
	},
	globals: {
		wp: true,
	},
	ignorePatterns: [
		'.*.js',
		'*.config.js',
		'js/build/*.js',
	],
	rules: {
		'no-console': [ 'warn', { allow: [ 'error' ] } ],
	},
};
