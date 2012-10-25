<?php

/*   Redbubble API v1
 *   Written by Lee Jones (mail@leejones.me.uk)
 *   Project Home Page: https://github.com/prolificjones82/Redbubble-API
 *   Released under GNU Lesser General Public License (http://www.gnu.org/copyleft/lgpl.html)
 *
 *
 *	 Please submit all problems or questions to the Issues page on the projects GitHub page:
 *   https://github.com/prolificjones82/Redbubble-API
 *
 */ 

$rburl = "http://www.redbubble.com";

// ERROR LIST
$error1 = "The user <i><b>'" . $_GET['rb_user'] . "'</b></i> doesn't exist on Redbubble.<br />\n"
	. "<a href='" . $_SERVER['HTTP_REFERER'] . "'><< Go Back</a>";
$error2 = "Could not load items. Please check your servers PHP configuration.";

if (!empty($_GET['rb_user'])) {
	$url = sprintf($rburl . "/people/%s/shop/recent/", $_GET['rb_user']);

	if ($xhtml = @file_get_contents($url, FILE_SKIP_EMPTY_LINES)) {
		$data = array();
		
		$doc = new DOMDocument();
			if (!@$doc->loadHTML($xhtml)) {
				die($error2);
			}
		
		// Grab Link URL
		$xpath = new DOMXpath($doc);
		$itemquery = "//a[contains(concat(' ',normalize-space(@class),' '), 'shop-product')]";
		$items = $xpath->query($itemquery);
		
		echo "<ul>";
		foreach($items as $item) {
			echo "<a href='" . $rburl . $item->getAttribute('href') . "' target='_blank'><li>";
			
			if ($img = $item->getElementsByTagName('img')) {
				$data['img'] = $img->item(0)->getAttribute('src');
			}
			
			echo "<img src='" . $data['img'] . "' />";
			
			echo "</li></a>";
		}
		echo "</ul>";
	
	} else {
		die($error1);
	}
	
} else {
	$form = "<form method='get'>\n"
		. "<table>\n"
		. "<tr><th>Redbubble Username:</th><td><input type='text' name='rb_user' /></td></tr>\n"
		. "<tr><th>&nbsp;</th><td><input type='submit' value='Go' /></td></tr>\n"
		. "</table>\n"
		. "</form>";
		
	print($form);
}

?>