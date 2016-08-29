<?php

/**
 * Get an HTML table of differences between two strings.
 *
 * @param String $old - The old content.
 * @param String $new - The new content.
 * @return String - The HTML table of the differences between the strings.
 */
if ( ! function_exists('diff')) {
	function diff($old, $new) {
		static $renderer = null;
		if ($renderer === null) {
			$renderer = new Diff_Renderer_Html_Inline;
		}

		$old = explode("\n", $old);
		$new = explode("\n", $new);
		$diff = new Diff($old, $new);

		return $diff->Render($renderer);
	}
}