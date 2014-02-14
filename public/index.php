<?php

if (!$loader = include __DIR__ . '/../vendor/autoload.php') {
    die('You must set up the project dependencies.');
}

use Tracker\Utilities\File as File;
use Tracker\Utilities\Post as Post;

//Instantiate a new fileOps class
$fileOps = new File();

//Instantiate a new postUtility class
$postUtility = new Post();

//Check the key passed via the post
if ($postUtility->config['global']['key'] == $postUtility->post['key'])
{
    //setup content to be wrote the file
    $date    = $postUtility->post['DATE'];
    $time    = $postUtility->post['TIME'];
    $batt    = $postUtility->post['BATT'];
    $smsrf   = $postUtility->post['SMSRF'];
    $loc     = $postUtility->post['LOC'];
    $locacc  = $postUtility->post['LOCACC'];
    $localt  = $postUtility->post['LOCALT'];
    $locspd  = $postUtility->post['LOCSPD'];
    $loctms  = $postUtility->post['LOCTMS'];
    $locn    = $postUtility->post['LOCN'];
    $locnacc = $postUtility->post['LOCNACC'];
    $locntms = $postUtility->post['LOCNTMS'];
    $cellid  = $postUtility->post['CELLID'];
    $cellsig = $postUtility->post['CELLSIG'];
    $cellsrv = $postUtility->post['CELLSRV'];

    $content = 'DT:' . $date . "_$time@BATT:$batt,SMSRF:$smsrf,LOC:$loc,LOCACC:$locacc,LOCALT:$localt,LOCSPD:$locspd,LOCTMS:$loctms,LOCN:$locn,LOCNACC:$locnacc,LOCNTMS:$locntms,CELLID:$cellid,CELLSIG:$cellsig,CELLSRV:$cellsrv\n";

    $fileOps->write($content, FILE_APPEND, __DIR__ . '../logs/' . $fileOps->date . '_post_capture.log');
}