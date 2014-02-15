<?php

if (!$loader = include __DIR__ . '/../vendor/autoload.php') {
    die('You must set up the project dependencies.');
}

use Tracker\Utilities\File as File;
use Tracker\Utilities\Post as Post;

$file = new File();
$post = new Post();

//Check the key
if (!isset($post->post['key'])) exit();

if ($post->config['global']['key'] == $post->post['key'])
{
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

    $content = 'DT:' . $date . "_$time@BATT:$batt,SMSRF:$smsrf,LOC:$loc,LOCACC:$locacc,LOCALT:$localt,LOCSPD:$locspd,LOCTMS:$loctms,LOCN:$locn,LOCNACC:$locnacc,LOCNTMS:$locntms,CELLID:$cellid,CELLSIG:$cellsig,CELLSRV:$cellsrv\n";

    $file->write($content, FILE_APPEND, __DIR__ . '/../logs/' . $file->date . '_post_capture.log');
}
