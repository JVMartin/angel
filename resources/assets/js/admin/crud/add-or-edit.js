$(function() {
	if ($('#crudAddOrEdit').length) {
		var $changesModal = $('#changesModal'),
			$changesModalContent = $('#changesModalContent');

		$('.openChangesButton').click(function(e) {
			var url = $(this).data('url');
			e.preventDefault(); // Don't highlight the text in the input.
			$changesModalContent.html('<p>Loading...</p>');
			$.get(url, function(data) {
				$changesModalContent.html(data);
				$changesModal.trigger('resizeme.zf.trigger');
			}).fail(function(xhr, status, error) {
				console.log(error);
				$changesModalContent.html('<p>There was an error contacting the server.</p>');
			});
		});
	}
});