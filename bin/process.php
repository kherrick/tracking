#!/usr/bin/php
<?php

//DT:9-25-2013_19.00@BATT:62,SMSRF:+16782088377,LOC:42.5248564,-83.12676441,LOCACC:49,LOCALT:165.3000030517578,LOCSPD:0.0,LOCTMS:1380150011,LOCN:42.525519,-83.1263469,LOCNACC:101,LOCNTMS:1380150001,CELLID:GSM:11298.13457083,CELLSIG:4,CELLSRV:service

class scriptHandler
{
    public $results = array();

    /**
     * getter for results
     *
     * @return array the results of the script
     */
    public function getResults()
    {
        return $this->results;
    }

    /**
     * fileHandler
     * @param  string $filename filename of log to process
     * @return object
     */
    public function fileHandler($filename)
    {
        return file($filename);
    }

    /**
     * processes the lines of a file
     */
    public function lineHandler($file)
    {
        foreach ($file as $lineNum => $line) {
            $dates     = $this->getDates($line);
            $times     = $this->getTimes($line);
            $content   = $dates . '@' . $times;

            $this->results[] = $content;
        }
    }

    private function getDates($line)
    {
        $results    = '';

        $comma      = explode(',', $line);
        $at         = explode('@', $comma[0]);
        $underscore = explode('_', $at[0]);
        $colon      = explode(':', $underscore[0]);
        $content    = $colon[1];

        $results    = $content;

        return $results;
    }

    private function getTimes($line)
    {
        $results    = '';

        $comma      = explode(',', $line);
        $at         = explode('@', $comma[0]);
        $underscore = explode('_', $at[0]);
        $content    = $underscore[1];

        $results    = $content;

        return $results;
    }
}

$script      = new scriptHandler;
$fileHandler = $script->fileHandler('../logs/2013-Sep-25_post_capture.log');
$lineHandler = $script->lineHandler($fileHandler);
$results     = $script->getResults();

var_dump($results);
