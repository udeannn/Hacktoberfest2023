<?php
/*
	Description: HacktoberFest2k23
	Author: Sean W.
	Author URI: https://www.cybersholt.com
	Version: 0.0.1
*/

/**
 * Retrieves the k largest elements from an array.
 *
 * This function sorts the entire array in descending order and then
 * returns the first k elements.
 *
 * @param array $arr Array to get elements from.
 * @param int   $k   Number of elements to return.
 *
 * @return array Returns the k largest elements from $arr.
 */
function getKLargestElements( $arr, $k ) {
	// Sort the array in descending order
	rsort( $arr );

	// Return the first k elements
	return array_slice( $arr, 0, $k );
}

// Example usage
$arr = [ 3, 1, 4, 1, 5, 9, 2, 6, 5, 3, 5 ];
$k   = 5;
echo '<div class="row"><div class="col-6">Input Array:';
echo '<br  /><br  /><pre>';
print_r($arr);
$largestElements = getKLargestElements( $arr, $k );
echo '</pre></div>';

echo '<div class="col-6">Output Array:';
echo '<br  /><br  /><pre>';
print_r( $largestElements );
echo '</pre></div></div>';
/*
 * Example output:
 * Array
 * (
 *    [0] => 9
 *    [1] => 6
 *    [2] => 5
 *    [3] => 5
 *    [4] => 5
 * )
 */