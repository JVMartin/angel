import './bootstrap';

$(document).foundation();

// Date / time picker
$('input.dateTime').datetimepicker({
	format: 'Y-m-d H:i:00'
});

// Date picker
$('input.date').datetimepicker({
	timepicker:false,
	format: 'Y-m-d'
});

// Tags
$('input.tags').selectize({
	delimiter: ',',
	persist: false,
	create: function (input) {
		return {
			value: input,
			text: input
		}
	}
});

// Delete forms
$('.deleteForm').submit(function(e) {
		let message = $(this).data('confirm');
		if ( ! confirm(message)) e.preventDefault();
});
