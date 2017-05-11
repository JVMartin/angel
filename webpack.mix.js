const { mix } = require('laravel-mix');

mix.disableNotifications();
mix.autoload({});

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

mix.js('resources/assets/js/app.js', 'public/js').version();
mix.sass('resources/assets/sass/app.scss', 'public/css').version();

mix.copy('node_modules/tinymce/skins', 'public/js/skins', false);
mix.copy('node_modules/tinymce-codemirror/plugins/codemirror', 'public/js/plugins/codemirror', false);
mix.copy('node_modules/font-awesome/fonts', 'public/fonts', false);
