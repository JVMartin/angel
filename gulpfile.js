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
			'bower/what-input/what-input.js',
			'bower/foundation-sites/js/foundation.core.js',
			'bower/foundation-sites/js/foundation.offcanvas.js',
			'bower/foundation-sites/js/foundation.drilldown.js',
			'bower/foundation-sites/js/foundation.equalizer.js',
			'bower/foundation-sites/js/foundation.accordion.js',
			'bower/foundation-sites/js/foundation.util.mediaQuery.js',
			'bower/foundation-sites/js/foundation.util.triggers.js',
			'bower/foundation-sites/js/foundation.util.keyboard.js',
			'bower/foundation-sites/js/foundation.util.motion.js',
			'bower/foundation-sites/js/foundation.util.nest.js',
			'bower/foundation-sites/js/foundation.util.timerAndImageLoader.js',
			'js/global.js'
		],
		'public/js/app.js',
		'resources/assets'
	);

	mix.version(["public/css/app.css", "public/js/app.js"]);
});
