/**
 * @copyright (c) 2016 Jacob Martin
 * @license MIT https://opensource.org/licenses/MIT
 */

// Load the change log for the specific column into the modal window via AJAX.
$(function() {
	var $changesModal = $('#changesModal'),
		$changesModalContent;

	if ( ! $changesModal.length) return;

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
});