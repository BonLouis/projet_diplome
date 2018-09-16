let mix = require('laravel-mix');
const LiveReloadPlugin = require('webpack-livereload-plugin');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */
mix
	.disableNotifications()
	.browserSync({
		proxy: 'localhost:8000',
		notify: false
	})
	.sass('resources/assets/sass/app.scss', 'public/css')
	.js('resources/assets/js/app.js', 'public/js')
	.js('resources/assets/js/scripts/beforeDOMLoad.js', 'public/js/scripts')
	.js('resources/assets/js/scripts/initMaterialize.js', 'public/js/scripts')
	.sourceMaps();
	// .js('resources/assets/js/scripts/test.js', 'public/js/scripts')
