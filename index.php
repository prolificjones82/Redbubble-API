<?php 

require 'redbubble/redbubble.php';

$redbubble = new Redbubble('prolificlee');
$collections = $redbubble->getCollections();

echo '<pre>';
print_r($collections);
echo '</pre>';