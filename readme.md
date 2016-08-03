# Angel CMS for Laravel 5
Copyright &copy; 2016 Jacob Martin

[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg)](http://opensource.org/licenses/MIT)
[![Build Status](https://travis-ci.org/JVMartin/angel5.svg?branch=master)](https://travis-ci.org/JVMartin/angel5)

Angel is a simple, developer-friendly CMS for rapidly developing end-user-customizable web
applications and websites.

When your client needs "Team" pages with editable team members...<br />
When your client needs "FAQs" pages with editable Q&amp;A's...<br />
When your client needs "Products" pages with editable products...<br />
When your client needs a blog and WordPress sucks...

...Angel is the answer.

Build a CMS module in minutes for *any* customizable content needs simply by defining a migration.

Angel uses:
* [Laravel 5.2](https://laravel.com/docs/5.2) as its foundation.
* [Forms & HTML 5.2](https://laravelcollective.com/docs/5.2/html) by the
  [Laravel Collective](https://laravelcollective.com/) for its form building utilities.
* [Laravel Debugbar](https://github.com/barryvdh/laravel-debugbar) by
  [barryvdh](https://github.com/barryvdh), an excellent debugging tool.
* [Foundation for Sites 6.2.3](http://foundation.zurb.com/sites/docs/) as the admin panel
  [Sass](http://sass-lang.com/) framework and as the default front-end Sass framework (each compiled
  separately for maximum customizability).
* [FontAwesome 4.6.3](http://fontawesome.io/icons/) for icons.
* [CKEditor 4.5.10](http://ckeditor.com/) as the WYSIWYG editor in the administrative panel.
* [Travis CI](https://travis-ci.org/) for automated, continuous integration testing.

## Installation
Fork or clone this repository and:
```bash
composer install      # Install the Laravel framework.
bower install         # Install Foundation.
npm install           # Install Laravel Elixir and Gulp.
gulp                  # Compile and version all of the CSS and JS.
./fix.sh              # Fix the permissions, giving www-data write access to necessary folders.
mysql                 # Create a database and user.
cp .env.example .env  # And edit .env to taste.
php artisan migrate   # Run the database migrations.
```

Serve the `/public` folder from Apache.

For production CSS and JS minification, use:
```bash
gulp --production
```

Note that files in the following folders are not included in VCS as they are compiled and copied
files:
```bash
/public/css
/public/js
/public/build
/public/fonts
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
