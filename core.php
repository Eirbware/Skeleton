<?php
require_once('/net/web/core/autoload.php');
require_once(__DIR__.'/classes/Model.php');

/**
 * Configuration de l'application
 */
$app = new Eirbware\Application(array(
    'debug' => (preg_match('#^/net/dev#', __DIR__)==1),
    'user.object' => true,
));

/**
 * Sécurité de l'application
 */
$app['security']->secure(array(
    'force_auth' => true,
    // Vérification que l'utilisateur est un élève
    'callback' => function($user) use ($app) {
        return $user->isEleve();
    },
));

/**
 * Connexion à la base de donnée
 */
$config = include(__DIR__.'/config.php');

$app->connectDb(
    $config['host'],
    $config['database'],
    $config['username'],
    $config['password']
);

/**
 * Inclusion du modèle
 */
$app['model'] = $app->share(function() use ($app) {
    return new Model($app);
});

return $app;
