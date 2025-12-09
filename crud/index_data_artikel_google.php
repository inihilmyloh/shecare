<?php

$query = isset($_GET["query_rss"]) ? $_GET["query_rss"] : "penyakit kesehatan wanita";
$limit = isset($_GET["limit"]) ? intval($_GET["limit"]) : 3;

$rss = simplexml_load_file("https://news.google.com/rss/search?q=$query&hl=id&gl=ID&ceid=ID:id");

$items = [];

foreach ($rss->channel->item as $item) {
    if($limit <= 0) break;
    $items[] = $item;
    $limit--;
}

echo json_encode($items);