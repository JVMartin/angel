// Please don't notify me!
process.env.DISABLE_NOTIFIER = true;
var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
	mix.sass(
		'admin/main.scss',
		'public/css/admin.css',
		{
			includePaths: [
				'resources/assets/bower/foundation-sites/scss',
				'resources/assets/bower/motion-ui/src',
			]
		}
	);

	mix.sass(
		'app/main.scss',
		'public/css/app.css',
		{
			includePaths: [
				'resources/assets/bower/foundation-sites/scss',
				'resources/assets/bower/motion-ui/src',
			]
		}
	);

	mix.scripts(
		[
			'bower/jquery/dist/jquery.js',
			'bower/foundation-sites/dist/foundation.js',
			'js/admin/global.js'
		],
		'public/js/admin.js',
		'resources/assets'
	);

	mix.scripts(
		[
			'bower/jquery/dist/jquery.js',
			'bower/foundation-sites/dist/foundation.js',
			'js/app/global.js'
		],
		'public/js/app.js',
		'resources/assets'
	);

	mix.version([
		'public/css/admin.css',
		'public/css/app.css',
		'public/js/admin.js',
		'public/js/app.js'
	]);
});
