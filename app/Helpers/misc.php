<?php

/**
 * A helper method for displaying currency.
 *
 * @param  int     $dollars
 * @param  boolean $symbol
 * @return string
 */
function currency($dollars, $symbol = true) {
    $dollars = (int) $dollars;
    $currency = '';
    if ($symbol) {
        $currency .= 'US&#36;';
    }
    $currency .= number_format($dollars / 100, 2, '.', ',');
    return $currency;
}

/**
 * Strip all except some safe tags.
 *
 * @param string $string
 * @return int|array|null
 */
function stripUnsafeTags($string)
{
	static $whitelist = '';

	if ( ! strlen($whitelist)) {
		$whitelist = implode('', [
			// Links
			'<a>',

			// Text
			'<p>',
			'<br>',
			'<strong>',
			'<b>',
			'<em>',
			'<i>',

			// Images, videos
			'<img>',
		]);
	}

	return strip_tags($string, $whitelist);
}
