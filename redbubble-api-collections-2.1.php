 <?php

/*   Redbubble API - Collections
 *   Written by Lee Jones (mail@leejones.me.uk)
 *   Project Home Page: https://github.com/prolificjones82/Redbubble-API
 *   Released under GNU Lesser General Public License (http://www.gnu.org/copyleft/lgpl.html)
 *
 *
 *     Please submit all problems or questions to the Issues page on the projects GitHub page:
 *   https://github.com/prolificjones82/Redbubble-API
 *
 */ 

$rburl = "http://www.redbubble.com";


$rbuser = ''; // ENTER YOU REBUBBLE USERNAME HERE FOR STATIC FUNCTIONALITY


if (empty($_GET['rb_user']) && empty($rbuser)) {
?>

<form method="get" action="">
    <h2>Enter a Redbubble Username</h2>
    <input type="text" name="rb_user" placeholder="Rebubble Username" autofocus="">
    <input type="submit" value="View Collections" />
</form>

<?php
} elseif (!empty($_GET['rb_user'])) {
    $rbuser = $_GET['rb_user'];
}

// ERROR LIST
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
        
        echo "<ul>";
        foreach($items as $item) {
            echo "<li><a href='?rb_user=" . $rbuser . "&coll=";
            
            // Strip link to leave collection ID and title
            $pattern = "/people/" . $rbuser . "/collections/";
            $coll_id = str_replace($pattern, "", $item->getAttribute('href'));
            echo $coll_id;
            
            echo "''>";
            
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
            
            
            echo "</a></li>";
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
        echo "<ul>";
        echo "<li><a href='" . $_SERVER['HTTP_REFERER'] . "'>Back</a></li>";
        echo "</ul>";
        
        echo "<ul>";
        foreach($items as $item) {
            echo "<li><a href='" . $rburl . $item->getAttribute('href') . "' target='_blank'>";
            
            // Get Images
            if ($img = $item->getElementsByTagName('img')) {
                $data['img'] = $img->item(0)->getAttribute('src');
            }
            echo "<img src='" . $data['img'] . "' />";
            
            // Get item price
	    if ($prices = $item->getElementsByTagName('meta')) {
                $data['currency'] = $prices->item(5)->getAttribute('content');
                if ($data['currency'] == 'GBP') {
                    $currency = '&pound;';
                } elseif ($data['currency'] == 'USD' || $data['currency'] == 'AUS' || $data['currency'] == 'CAD') {
                    $currency = '$';
                } elseif ($data['currency'] == 'EUR') {
                    $currency = '&euro;';
            	}
                $data['price'] = $prices->item(4)->getAttribute('content');
	    }
	    echo "<h5>" . $currency . number_format((float)$data['price'], 2, '.', '') . "</h5>";
            
            echo "</a></li>";
        }
        echo "</ul>";
        
        // Back Link
        echo "<ul>";
        echo "<li><a href='" . $_SERVER['HTTP_REFERER'] . "'>Back</a></li>";
        echo "</ul>";
    
    }
    
}

?>
