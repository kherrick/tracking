#!/usr/bin/php
<?php
namespace bin\Process;

const   PATH_TO_TRANSFORMER = '../src/Tracker/Data/Transformer.php';
include __DIR__ . '/' . PATH_TO_TRANSFORMER;

use Tracker\Data\Transformer as Transformer;

class Process
{
    protected $pathToLogs = '../logs/YYYY-MM-DD_post_capture_DOT_log';

    protected $results;

    public function __construct()
    {
        $this->execute();
    }

    protected function execute()
    {
        $data            = new Transformer(__DIR__ . '/' . $this->pathToLogs);
        $dataLineHandler = $data->lineHandler();
        $dataResults     = $data->getResults();

        //see https://developers.google.com/maps/documentation/staticmaps/
        $url = 'http://maps.googleapis.com/maps/api/staticmap?size=640x640&zoom=4&sensor=false&markers=';

        //append latitude and longitude from each line of the file
        foreach ($dataResults as $key => $value) {
            $url .= $value['latitude'] . ',' . $value['longitude'] . "|";
        }

        //strip last pipe from the foreach above
        $url = substr($url, 0, strlen($url)-1);

        $this->results = $url . "\n";

        echo $this->results;
    }
}

$run = new \bin\Process\Process();