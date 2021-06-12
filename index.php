<?php

require 'collection.php';
require 'vendor/autoload.php';


$db = new PDO (
    'mysql:host=localhost; dbname=collection', 
    'root',
    '');

$query = $db->query('SELECT * FROM articles');

$res = $query->fetchAll(PDO::FETCH_OBJ);

$articles = new collection($res);



#echo $articles;

print $articles->toJson();

#dump($articles->all());
#dump($articles->first());
#dump($articles->last());

#$articles->each(function($article, $key){
#	echo $article->title . ' ', $key. '<br>';
#});
#
#dump($articles->toJson());
#dump($articles);
#exit;
#$articles = $articles->filter(function($article){
#	return $article->id > 1;
#});

#dump($articles);

#dump($articles->last());

#dump($articles->keys());
#$articles = $articles->map(function($article) {
#	$article->body = 'Mawlid';
#	return $article->body;
#});



#dump($articles->merge(array('1' =>'Mawlid')));

#echo count($articles);

#foreach ($articles as $article) {
#	echo $article->body."<br>";
#}


$test  = new collection($res);

$moreColletions = new collection($test);

#dump($moreColletions);
//merge too collections
dump($articles->merge($test));