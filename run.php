#!/usr/bin/php
<?php

if (!$bootstrap = require_once __DIR__ . '/bootstrap.php') {
    die('You must set up the project dependencies.');
}

use Tracker\Process\Process;

$config  = parse_ini_file('config/settings.ini', true);
$name    = $config['global']['name'];
$version = $config['global']['version'];
$app     = new \Cilex\Application($name, $version);

$app->command(new Process('logs/'));

$app->run();

