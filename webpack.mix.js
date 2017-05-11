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

// App
mix.js('resources/assets/js/app/app.js', 'public/js').version();
mix.sass('resources/assets/sass/app/app.scss', 'public/css').version();

// Admin
mix.js('resources/assets/js/admin/admin.js', 'public/js').version();
mix.sass('resources/assets/sass/admin/admin.scss', 'public/css').version();
mix.copy('node_modules/tinymce/skins', 'public/js/skins', false);
mix.copy('node_modules/tinymce-codemirror/plugins/codemirror', 'public/js/plugins/codemirror', false);
