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
mix.options({ processCssUrls: false })  
mix.js('resources/assets/js/index.js', 'public/js/')
	.sass('resources/assets/sass/backend.scss', 'public/css');
   
/*
mix.copy([
    'node_modules/purecss/build/grids-responsive-min.css'
], 'public/css/pure-responsive.css');

mix.copy([
	'node_modules/purecss/build/pure-min.css',
], 'public/css/pure.css');

mix.combine([
	'node_modules/purecss/build/pure-min.css',
	'node_modules/purecss/build/grids-responsive-min.css',
    'resources/assets/sass/grid.scss'
], 'public/css/pure.css');
*/

mix.copy('node_modules/font-awesome/fonts', 'public/fonts');

