// Window-bound objects.
window._ = require('lodash');
window.$ = window.jQuery = require('jquery');
window.tinymce = require('tinymce/tinymce');

// External packages - order matters.
require('jquery-ui');
require('jquery-datetimepicker');
require('selectize');
require('foundation-sites');
require('tinymce/themes/modern/theme');
require('tinymce/plugins/advlist');
require('tinymce/plugins/autoresize');
require('tinymce/plugins/code');
require('tinymce/plugins/image');
require('tinymce/plugins/link');
require('tinymce/plugins/lists');
require('tinymce/plugins/paste');

// My scripts
require('./crud/changes-log');
require('./wysiwyg');
require('./lfm');
