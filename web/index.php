<?php

require_once __DIR__.'/../vendor/autoload.php'; 

$conn = "mongodb://dev:mypassword@localhost:27017/demoapp";
$m = new \MongoClient($conn);
$db = $m->selectDB('demoapp');

$app = new Silex\Application(); 

$app->get('/hello/{name}', function($name) use($app, $db) { 

    $collection = new \MongoCollection($db, 'users');
    $userQuery = array('email' => 'foo@example.com');
    $cursor = $collection->find($userQuery);
    
    foreach ($cursor as $doc) {
         echo "<pre>";
         var_dump($doc);
    }
  
    return 'Hello '.$app->escape($name); 
}); 

$app->run(); 
