<?php

if (!$bootstrap = require_once __DIR__ . '/../bootstrap.php') {
    die('You must set up the project dependencies.');
}

use Tracker\Utilities\File;
use Tracker\Utilities\Post;
use Tracker\Data\EntityOperations;

function logToFile($post)
{
    $file    = new File();

    $date    = empty($post->post['DATE'])    ? null : $post->post['DATE'];
    $time    = empty($post->post['TIME'])    ? null : $post->post['TIME'];
    $batt    = empty($post->post['BATT'])    ? null : $post->post['BATT'];
    $smsrf   = empty($post->post['SMSRF'])   ? null : $post->post['SMSRF'];
    $loc     = empty($post->post['LOC'])     ? null : $post->post['LOC'];
    $locacc  = empty($post->post['LOCACC'])  ? null : $post->post['LOCACC'];
    $localt  = empty($post->post['LOCALT'])  ? null : $post->post['LOCALT'];
    $locspd  = empty($post->post['LOCSPD'])  ? null : $post->post['LOCSPD'];
    $loctms  = empty($post->post['LOCTMS'])  ? null : $post->post['LOCTMS'];
    $locn    = empty($post->post['LOCN'])    ? null : $post->post['LOCN'];
    $locnacc = empty($post->post['LOCNACC']) ? null : $post->post['LOCNACC'];
    $locntms = empty($post->post['LOCNTMS']) ? null : $post->post['LOCNTMS'];
    $cellid  = empty($post->post['CELLID'])  ? null : $post->post['CELLID'];
    $cellsig = empty($post->post['CELLSIG']) ? null : $post->post['CELLSIG'];
    $cellsrv = empty($post->post['CELLSRV']) ? null : $post->post['CELLSRV'];

    $content = 'DT:' . $date . "_$time@BATT:$batt,SMSRF:$smsrf,LOC:$loc,LOCACC:$locacc,LOCALT:$localt," .
        "LOCSPD:$locspd,LOCTMS:$loctms,LOCN:$locn,LOCNACC:$locnacc,LOCNTMS:$locntms,CELLID:$cellid," .
        "CELLSIG:$cellsig,CELLSRV:$cellsrv\n";

    $file->write($content, FILE_APPEND, __DIR__ . '/../logs/' . $file->date . '_post_capture.log');
}

function logToDatabase($post, $entityManager)
{
    $entityOps = new EntityOperations($entityManager);
    $data      = [];
    $postKeys  = [
        'DATE', 'TIME', 'BATT', 'SMSRF', 'LOC', 'LOCACC', 'LOCALT', 'LOCSPD',
        'LOCTMS', 'LOCN', 'LOCNACC', 'LOCNTMS', 'CELLID', 'CELLSIG', 'CELLSRV',
    ];

    foreach ($postKeys as $key) {
        array_push($data, $post->post[$key]);
    }

    $entityOps->insert($data);

    // // other operations
    // $entityOps->show();

    // $entityOps->select('1', 'Date');

    // $entityOps->update('1', 'Date', '01-01-1970');

    // $entityOps->drop('1');
}

//setup the post
$post = new Post();

//check the key
if (!isset($post->post['key'])) exit();

if ($post->config['global']['key'] == $post->post['key'])
{
    // $entityManager comes from bootstrap.php
    logToDatabase($post, $entityManager);

    // logToFile($post);
}
