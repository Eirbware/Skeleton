<?php
$app = include('core.php');

/**
 * Page d'accueil
 */
$app->get('/', function() use ($app) {
    return $app->render('index.html.twig', array(
        'name' => 'World'
    ));
});

$app->run();
