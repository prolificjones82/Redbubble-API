<?php 

require_once('../class.redbubble.php');

$config = new RedbubbleConfig('prolificlee', 'object', false);
$connection = new Redbubble($config);

if (!isset($_GET['rbu']) && !isset($_GET['cID'])) {
    $collections = $connection->getCollections();
    foreach ($collections as $collection) {
        echo '<a href="' . $collection->url . '">';
        echo '<img src="' . $collection->image . '" alt="' . $collection->collection_id . '" />';
        echo '<h5>' . $collection->title . '</h5>';
        echo '</a>';
    }
} else {
    $products = $connection->getProducts($_GET['cID']);
    foreach ($products as $product) {
        echo '<a href="' . $product->link . '" target="_blank">';
        echo '<img src="' . $product->design_image . '" alt="' . $product->title . '" />';
        echo '<img src="' . $product->product_image . '" alt="' . $product->title . '" />';
        echo '<h5>' . $product->title . '</h5>';
        echo '<h6>' . $product->price . '</h6>';
        echo '</a>';
    }
}