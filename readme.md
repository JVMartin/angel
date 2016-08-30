# Angel CMS for Laravel 5.3
Copyright &copy; 2016 Jacob Martin

[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg)](http://opensource.org/licenses/MIT)
[![Build Status](https://travis-ci.org/JVMartin/angel5.svg?branch=master)](https://travis-ci.org/JVMartin/angel5)

Angel is a simple, developer-friendly CMS for rapidly developing end-user-customizable web
applications and websites.

When your client needs a "Team" page with editable team members...<br />
When your client needs an "FAQs" page with editable questions and answers...<br />
When your client needs "Products" pages with editable products...<br />
When your client needs a blog and *WordPress sucks*...

...Angel is the answer.

Build a CMS module in minutes for *any* customizable content needs simply by creating a database
table and defining some variables to let the CMS know how to present each column to the user.  For
instance: if you define a column named `html` with a "pretty name" of "Content" and a type of
`wysiwyg`, a "what-you-see-is-what-you-get" editor will be used to edit that column in the
administrative panel like so:

![wysiwyg screenshot](/public/img/ss-1.png?raw=true)

Each column has its own change log, so you can easily see who made a change, when they made it, and
exactly what they altered:

![Change log screenshot](/public/img/ss-2.png?raw=true)

The CMS leverages only robust, modern, well-written packages to accomplish its functionality.  Angel
uses:
* [Laravel 5.3](https://laravel.com/docs/5.3) as its foundation.
* [Forms & HTML 5.3](https://laravelcollective.com/docs/5.3/html) by the
  [Laravel Collective](https://laravelcollective.com/) for its form building utilities.
* [Laravel Debugbar](https://github.com/barryvdh/laravel-debugbar) by
  [barryvdh](https://github.com/barryvdh), an excellent debugging tool.
* [Foundation for Sites 6.2.3](http://foundation.zurb.com/sites/docs/) as the admin panel
  [Sass](http://sass-lang.com/) framework and as the default front-end Sass framework (each compiled
  separately for maximum customizability).
* [FontAwesome 4.6.3](http://fontawesome.io/icons/) for icons.
* [CKEditor 4.5.10](http://ckeditor.com/) as the WYSIWYG editor in the administrative panel.
* [Travis CI](https://travis-ci.org/) for automated, continuous integration testing.

## Demo
[See the YouTube demo here.](https://www.youtube.com/watch?v=Xkq5gYCLzB0&feature=youtu.be)

The demo includes a demonstration of how to create your own custom modules in minutes!

## Installation
Requirements:
- PHP >= 5.6.4
- MySQL >= 5.6

Fork or clone this repository and:
```bash
composer install         # Install the Laravel framework.
bower install            # Install Foundation.
npm install              # Install Laravel Elixir and Gulp.
gulp                     # Compile and version all of the CSS and JS.
./fix.sh                 # Fix the permissions, giving www-data write access to necessary folders.
mysql                    # Create a database and user.
cp .env.example .env     # And edit .env to taste.
php artisan key:generate # Generate a key
php artisan migrate      # Run the database migrations.
php artisan db:seed      # Seed the database with the default users.
```

Serve the `/public` folder from Apache.

For production CSS and JS minification, instead use:
```bash
gulp --production
```

Note that files in the following folders are not tracked as they are compiled
and/or copied files:
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
