#!/usr/bin/php
<?php

if (!$loader = include __DIR__.'/vendor/autoload.php') {
    die('You must set up the project dependencies.');
}

use Tracker\Process\Process;

$config  = parse_ini_file('config/settings.ini', true);
$name    = $config['global']['name'];
$version = $config['global']['version'];
$app     = new \Cilex\Application($name, $version);

$app->command(new Process('logs/'));

$app->run();
