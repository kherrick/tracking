<?php

if (!$bootstrap = require_once __DIR__ . '/../bootstrap.php') {
    die('You must set up the project dependencies.');
}

use Tracker\Service\Log;
use Tracker\Entity\Post;
use Tracker\Utilities\File;
use Tracker\Utilities\Entity;

/**
 * log the post data to a database
 * @param  Tracker\Utilities\Post     $post
 * @param  Doctrine\ORM\EntityManager $entityManager
 * @return null
 */
function logToDatabase($post, Doctrine\ORM\EntityManager $entityManager)
{
    $entityOps = new Entity($entityManager);
    $data      = [];
    $postKeys  = [
        'DATE', 'TIME', 'BATT', 'SMSRF', 'LOC', 'LOCACC', 'LOCALT', 'LOCSPD',
        'LOCTMS', 'LOCN', 'LOCNACC', 'LOCNTMS', 'CELLID', 'CELLSIG', 'CELLSRV',
    ];

    foreach ($postKeys as $key) {
        array_push($data, $post[$key]);
    }

    $entityOps->insert($data);

    // // other operations
    // $entityOps->show();

    // $entityOps->select('1', 'Date');

    // $entityOps->update('1', 'Date', '01-01-1970');

    // $entityOps->drop('1');
}

$settings = parse_ini_file(__DIR__ . '/../config/settings.ini', true);

//setup the post
$post = $_POST;

//check the key
if (!isset($post['key'])) exit();

if ($settings['global']['key'] == $post['key'])
{
    // // $entityManager comes from bootstrap.php
    // logToDatabase($post, $entityManager);

    //log to a file
    //setup new log container
    $container = new Pimple();

    // define some parameters
    $container['file'] = new File();
    $container['post'] = new Post($post);

    $container['log'] = $container->share(function($c) {
        return new Log(
            $c['file'],
            $c['post']
        );
    });

    $container['log']->write();
}
