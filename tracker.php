#!/usr/bin/php
<?php

if (!$bootstrap = require_once __DIR__ . '/bootstrap.php') {
    die('You must set up the project dependencies.');
}

use Tracker\Command\Map;

$settings = parse_ini_file(__DIR__ . '/config/settings.ini', true);
$name     = $settings['global']['name'];
$version  = $settings['global']['version'];
$app      = new \Cilex\Application($name, $version);

$app->command(new Map());

$app->run();

