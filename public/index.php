<?php

if (!$bootstrap = require_once __DIR__ . '/../bootstrap.php') {
    die('You must set up the project dependencies.');
}

use Tracker\Service\Log;
use Tracker\Service\Database;

use Tracker\Entity\Post;
use Tracker\Utilities\File;

$settings = parse_ini_file(__DIR__ . '/../config/settings.ini', true);

//check the key
if (!isset($_POST['key'])) exit();

if ($settings['global']['key'] == $_POST['key'])
{
    /**
     * log to database: $entityManager comes from bootstrap.php
     * @todo look into getting $entityManager out of bootstrap.php
     */

    //setup new log container
    $container = new Pimple();

    // define some parameters
    $container['entityManager'] = $entityManager;
    $container['data'] = new Tracker\Entity\Post($_POST);

    $container['database'] = $container->share(function($c) {
        return new Database(
            $c['entityManager'],
            $c['data']
        );
    });

    $container['database']->insert();

    // // other operations
    // $container['database']->show();

    // $container['database']->select('1', 'Date');

    // $container['database']->update('1', 'Date', '01-01-1970');

    // $container['database']->drop('1');

    // /**
    //  * log to a file
    //  */
    // //setup new log container
    // $container = new Pimple();

    // // define some parameters
    // $container['file'] = new Tracker\Utilities\File();
    // $container['data'] = new Tracker\Entity\Post($_POST);

    // $container['log'] = $container->share(function($c) {
    //     return new Log(
    //         $c['file'],
    //         $c['data']
    //     );
    // });

    // $container['log']->write();
}
