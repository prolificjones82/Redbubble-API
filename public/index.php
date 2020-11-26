<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

try {
    $redbubble = new Redbubble\Redbubble('prolificlee', 'object', false);
} catch (Exception $e) {
    echo $e->getMessage();
}

echo '<hr/>';
$collections = $redbubble->getCollections();
print_r($collections);
