#!/usr/bin/php
<?php

//DT:9-25-2013_19.00@BATT:62,SMSRF:+16782088377,LOC:42.5248564,-83.12676441,LOCACC:49,LOCALT:165.3000030517578,LOCSPD:0.0,LOCTMS:1380150011,LOCN:42.525519,-83.1263469,LOCNACC:101,LOCNTMS:1380150001,CELLID:GSM:11298.13457083,CELLSIG:4,CELLSRV:service

class scriptHandler
{
    private $fileHandler;

    private $lineHandler = array();

    /**
     * __invoke method is called when a script tries to call the object as a function
     *
     * the idea here is to kick off the series of steps required to parse the log file
     *
     * @param  string $logname filename of log to process
     * @return object
     */
    private function __invoke($logname)
    {
        self::fileHandler($logname);
        self::lineHandler();

        return $this->lineHandler;
    }

    /**
     * fileHandler
     * @param  string $filename filename of log to process
     * @return object
     */
    private function fileHandler($filename)
    {
        $this->fileHandler = file($filename);
    }

    /**
     * processes the lines of a file
     */
    private function lineHandler()
    {
        foreach ($this->fileHandler as $lineNum => $line) {
            $dates     = $this->getDates($line);
            $times     = $this->getTimes($line);
            $content   = $dates . '@' . $times;

            $this->lineHandler[] = $content;
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

$script = new scriptHandler();

$results = $script('logs/2013-Sep-25_post_capture.log');

var_dump($results);
