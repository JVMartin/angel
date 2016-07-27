# Angel CMS for Laravel 5
Copyright &copy; 2016 Jacob Martin

[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg)](http://opensource.org/licenses/MIT)
[![Build Status](https://travis-ci.org/JVMartin/angel5.svg?branch=master)](https://travis-ci.org/JVMartin/angel5)


Angel is a simple, highly customizable CMS for custom web applications built on top of Laravel using
test-driven development and all of the best practices.

Angel uses:
* [Laravel 5.2](https://laravel.com/docs/5.2) as its foundation.
* [Foundation for Sites 6.2.3](http://foundation.zurb.com/sites/docs/) as the admin panel
  [Sass](http://sass-lang.com/) framework and as the default front-end Sass framework (each compiled
  separately for maximum customizability).
* [Laravel Forms & HTML 5.2](https://laravelcollective.com/docs/5.2/html) for its form building
  utilities.
* [Laravel Debugbar](https://github.com/barryvdh/laravel-debugbar), an excellent debugging
  tool by barryvdh.

## Installation
Simply fork or clone this repository and:
```bash
composer install    # Install the Laravel framework.
bower install       # Install Foundation.
npm install         # Install Laravel Elixir and Gulp.
gulp                # Compile and version all of the CSS and JS.
./fix.sh            # Fix the permissions, giving www-data write access to necessary folders.
```

Serve the `/public` folder from Apache.

For production CSS and JS minification, instead use:
```bash
gulp --production
```

Note that all files in the following folders are gitignored, as they are compiled files:
```bash
/public/css
/public/js
/public/build
```

## Other Notes

By default, desktop notifications for gulp compilations are disabled (I find
them annoying and useless).  To enable desktop notifications, edit
`gulpfile.js` and comment out this line or set it to false:
```javascript
process.env.DISABLE_NOTIFIER = true;
```

## License

Just like the Laravel framework itself, Angel is open-sourced software licensed
under the [MIT license](http://opensource.org/licenses/MIT).
