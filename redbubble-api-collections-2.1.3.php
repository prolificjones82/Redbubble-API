<?php

/*   Redbubble API - Collections
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
$rbuser = "USERNAME HERE";

// ERROR LIST
$error1 = "The user <i><b>'" . $rbuser. "'</b></i> doesn't exist on Redbubble.<br />\n"
	. "<a href='" . $_SERVER['HTTP_REFERER'] . "'><< Go Back</a>";
$error2 = "PHP Error: Please enable <b><i>'allow_url_fopen'</i></b> in your PHP configuration.\n";

if (!empty($rbuser) && empty($_GET['coll'])) {
	$url = sprintf($rburl . "/people/%s/portfolio/", $rbuser);

	if ($xhtml = @file_get_contents($url, FILE_SKIP_EMPTY_LINES)) {
		$data = array();
		
		$doc = new DOMDocument();
			if (!@$doc->loadHTML($xhtml)) {
				die($error2);
			}
		
		// Grab Link URL
		$xpath = new DOMXpath($doc);
		$itemquery = "//a[contains(concat(' ',normalize-space(@class),' '), 'collection-link')]";
		$items = $xpath->query($itemquery);
		
		echo "<h1>Collections</h1>";
		
		echo "<ul>";
		foreach($items as $item) {
			echo "<a href='" . $_SERVER['REQUEST_URI'] . "&coll=";
			
			// Strip link to leave collection ID and title
			$pattern = "/people/" . $rbuser . "/collections/";
			$coll_id = str_replace($pattern, "", $item->getAttribute('href'));
			echo $coll_id;
			
			echo "''><li>";
			
			// Grab Background Image of collection link
			$strip = array('background-image: url(', ');');
			$img = $item->getAttribute('style');
			$bgimg = str_replace($strip, '', $img);
			echo "<img src='" . $bgimg . "' border='1' />";
			
			// Grab Collection Title
			if ($title = $item->getElementsByTagName('span')) {
				$data['title'] = $title->item(0)->nodeValue;
			}
			echo "<h5>" . $data['title'] . "</h5>";
			
			
			echo "</li></a>";
		}
		echo "</ul>";
	
	} else {
		die($error1);
	}


} elseif (!empty($_GET['coll'])) {	

	$url = sprintf($rburl . "/people/%s/collections/%s", $rbuser, $_GET['coll']);

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
		
		// Back Link
		echo "<a href='" . $_SERVER['HTTP_REFERER'] . "'>&laquo; Back</a>";
		
		echo "<ul>";
		foreach($items as $item) {
			echo "<a href='" . $rburl . $item->getAttribute('href') . "' target='_blank'><li>";
			
			// Get Images
			if ($img = $item->getElementsByTagName('img')) {
				$data['img'] = $img->item(0)->getAttribute('src');
			}
			echo "<img src='" . $data['img'] . "' />";
			
			echo "</li></a>";
		}
		echo "</ul>";
		
		// Back Link
		echo "<a href='" . $_SERVER['HTTP_REFERER'] . "'>&laquo; Back</a>";
	
	} else {
		die($error1);
	}
	
}

?>
