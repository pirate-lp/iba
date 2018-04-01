const { mix } = require('laravel-mix');

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
// mix.options({ processCssUrls: false })  
mix.js('resources/assets/js/analog.js', 'public/js/')
	.js('resources/assets/js/selectize.js', 'public/js/')
	.sass('resources/assets/sass/selectize.scss', 'public/css')
	.sass('resources/assets/sass/style.scss', 'public/css');
	
mix.copy('node_modules/css-oldschool/src/fonts', 'public/fonts');

