# Angel CMS
Copyright (c) 2016 Jacob Martin

Angel is a CMS built on top of Laravel.

Angel uses:
* [Laravel 5.2](https://laravel.com/docs/5.2) as its foundation.
* [Foundation for Sites 6.2.3](http://foundation.zurb.com/sites/docs/) as the
  admin panel [Sass](http://sass-lang.com/) framework and as the default
  front-end Sass framework (compiled separately).

By default, desktop notifications for gulp compilations are disabled (I find
them annoying and useless).  To enable desktop notifications, edit
`gulpfile.js` and comment out this line or set it to false:
```javascript
process.env.DISABLE_NOTIFIER = true;
```

## License

Just like the Laravel framework itself, Angel is open-sourced software licensed
under the [MIT license](http://opensource.org/licenses/MIT).
