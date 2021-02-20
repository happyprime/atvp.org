/* global module */
module.exports = {
	extends: [
		'plugin:@wordpress/eslint-plugin/esnext',
	],
	env: {
		browser: true,
	},
	rules: {
		'no-console': [ 'warn', { allow: [ 'error' ] } ],
	},
};
