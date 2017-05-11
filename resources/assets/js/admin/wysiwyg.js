//--------------------------------
// WYSIWYG editors
//--------------------------------
tinymce.init({
	path_absolute: '/',
	selector: 'textarea.tinymce',
	plugins: [
		'advlist autoresize codemirror image link lists paste'
	],
	toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | code',
	removed_menuitems: 'newdocument',
	paste_as_text: true,
	relative_urls: false,
	file_browser_callback: function (field_name, url, type, win) {
		const x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
		const y = window.innerHeight || document.documentElement.clientHeight || document.getElementsByTagName('body')[0].clientHeight;

		let cmsURL = '/laravel-filemanager?field_name=' + field_name;
		if (type == 'image') {
			cmsURL = cmsURL + "&type=Images";
		} else {
			cmsURL = cmsURL + "&type=Files";
		}

		tinyMCE.activeEditor.windowManager.open({
			file: cmsURL,
			title: 'Filemanager',
			width: x * 0.8,
			height: y * 0.8,
			resizable: "yes",
			close_previous: "no"
		});
	},
	codemirror: {
		indentOnInit: true, // Whether or not to indent code on init.
		width: 800,
		height: 600,
	}
});
