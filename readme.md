# Angel CMS
Copyright (c) 2016 Jacob Martin

Angel is a simple, highly customizable CMS built on top of Laravel.

Angel uses:
* [Laravel 5.2](https://laravel.com/docs/5.2) as its foundation.
* [Foundation for Sites 6.2.3](http://foundation.zurb.com/sites/docs/) as the
  admin panel [Sass](http://sass-lang.com/) framework and as the default
  front-end Sass framework (each compiled separately).

By default, desktop notifications for gulp compilations are disabled (I find
them annoying and useless).  To enable desktop notifications, edit
`gulpfile.js` and comment out this line or set it to false:
```javascript
process.env.DISABLE_NOTIFIER = true;
```

## Installation
Simply fork or clone this repository and:
```bash
composer install    # Install the Laravel framework.
bower install       # Install Foundation.
npm install         # Install Laravel Elixir and Gulp.
gulp                # Compile the Sass files into public/css.
```

Note that all files in `public/css` are ignored, as they are compiled CSS files.

For production CSS minification use:
```bash
gulp --production
```

## License

Just like the Laravel framework itself, Angel is open-sourced software licensed
under the [MIT license](http://opensource.org/licenses/MIT).
