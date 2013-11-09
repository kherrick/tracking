#!/usr/bin/php
<?php
namespace bin\process;

const   PATH_TO_TRANSFORMER = '../src/Tracker/Data/Transformer.php';
include __DIR__ . '/' . PATH_TO_TRANSFORMER;

use Tracker\Data\Transformer as Transformer;

class Process
{
    protected $pathToLogs = '../logs/YYYY-MM-DD_post_capture.log';

    protected $results = array();

    public function __construct()
    {
        $this->execute();
    }

    protected function execute()
    {
        $data            = new Transformer(__DIR__ . '/' . $this->pathToLogs);
        $dataLineHandler = $data->lineHandler();
        $dataResults     = $data->getResults();

        $this->results = $dataResults;

        print_r($this->results);
    }
}

$run = new \bin\process\Process();