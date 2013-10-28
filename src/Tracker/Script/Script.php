<?php

namespace Tracker\Script;

class Script
{
    public $fixture = array('DT:4-15-2011_11.12@BATT:12,SMSRF:+15558675309,LOC:32.5241664,-73.1145664,LOCACC:49,LOCALT:165.3000030517578,LOCSPD:0.0,LOCTMS:1458423011,LOCN:32.5241664,-73.1145664,LOCNACC:101,LOCNTMS:1458423011,CELLID:GSM:12245.14455082,CELLSIG:4,CELLSRV:service');

    public $results  = array();

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

    public function lineHandler($file)
    {
        foreach ($file as $line) {
            $content = array(
                'date'                          => $this->getDate($line),
                'time'                          => $this->getTime($line),
                'battery'                       => $this->getBattery($line),
                'lastSMS'                       => $this->getLastSMS($line),
                'latitude'                      => $this->getLatitude($line),
                'longitude'                     => $this->getLongitude($line),
                'locationAccuracy'              => $this->getLocationAccuracy($line),
                'locationAccuracy'              => $this->getLocationAccuracy($line),
                'locationSpeed'                 => $this->getLocationSpeed($line),
                'locationFixTimeSeconds'        => $this->getLocationFixTimeSeconds($line),
                'latitudeNetwork'               => $this->getLatitudeNetwork($line),
                'longitudeNetwork'              => $this->getLongitudeNetwork($line),
                'locationNetworkAccuracy'       => $this->getLocationNetworkAccuracy($line),
                'locationNetworkFixTimeSeconds' => $this->getLocationNetworkFixTimeSeconds($line),
                'cellTowerId'                   => $this->getCellTowerId($line),
                'cellSignalStrength'            => $this->getCellSignalStrength($line),
                'cellServiceState'              => $this->getCellServiceState($line)
            );

            $this->results[] = $content;
        }
    }

    private function getDate($line)
    {
        $comma      = explode(',', $line);
        $at         = explode('@', $comma[0]);
        $underscore = explode('_', $at[0]);
        $colon      = explode(':', $underscore[0]);
        $date       = explode('-', $colon[1]);
        $year       = $date[2];
        $month      = $date[0];
        $day        = $date[1];
        $results    = $year . '-' . $month  . '-' . $day;

        return $results;
    }

    private function getTime($line)
    {
        $comma      = explode(',', $line);
        $at         = explode('@', $comma[0]);
        $underscore = explode('_', $at[0]);
        $time       = explode('.', $underscore[1]);
        $hour       = $time[0];
        $minute     = $time[1];
        $results    = $hour . ':' . $minute;

        return $results;
    }

    private function getBattery($line)
    {
        $comma   = explode(',', $line);
        $at      = explode('@', $comma[0]);
        $colon   = explode(':', $at[1]);
        $results = $colon[1];

        return $results;
    }

    private function getLastSMS($line)
    {
        $comma   = explode(',', $line);
        $colon   = explode(':', $comma[1]);
        $results = $colon[1];

        return $results;
    }

    private function getLatitude($line)
    {
        $comma   = explode(',', $line);
        $colon   = explode(':', $comma[2]);
        $results = $colon[1];

        return $results;
    }

    private function getLongitude($line)
    {
        $comma   = explode(',', $line);
        $results = $comma[3];

        return $results;
    }

    private function getLocationAccuracy($line)
    {
        $comma   = explode(',', $line);
        $colon   = explode(':', $comma[4]);
        $results = $colon[1];

        return $results;
    }

    private function getLocationAltitude($line)
    {
        $comma   = explode(',', $line);
        $colon   = explode(':', $comma[5]);
        $results = $colon[1];

        return $results;
    }

    private function getLocationSpeed($line)
    {
        $comma   = explode(',', $line);
        $colon   = explode(':', $comma[6]);
        $results = $colon[1];

        // data is saved in meters per second
        // for miles per hour use:
        $results = $results * 2.2369363;

        return $results;
    }

    private function getLocationFixTimeSeconds($line)
    {
        $comma   = explode(',', $line);
        $colon   = explode(':', $comma[7]);
        $results = $colon[1];

        return $results;
    }

    private function getLatitudeNetwork($line)
    {
        $comma   = explode(',', $line);
        $colon   = explode(':', $comma[8]);
        $results = $colon[1];

        return $results;
    }

    private function getLongitudeNetwork($line)
    {
        $comma   = explode(',', $line);
        $results = $comma[9];

        return $results;
    }

    private function getLocationNetworkAccuracy($line)
    {
        $comma   = explode(',', $line);
        $colon   = explode(':', $comma[10]);
        $results = $colon[1];

        return $results;
    }

    private function getLocationNetworkFixTimeSeconds($line)
    {
        $comma   = explode(',', $line);
        $colon   = explode(':', $comma[11]);
        $results = $colon[1];

        return $results;
    }

    private function getCellTowerId($line)
    {
        $comma   = explode(',', $line);
        $colon   = explode(':', $comma[12]);
        $results = $colon[1] . ':' . $colon[2];

        return $results;
    }

    private function getCellSignalStrength($line)
    {
        $comma   = explode(',', $line);
        $colon   = explode(':', $comma[13]);
        $results = $colon[1];

        return $results;
    }

    private function getCellServiceState($line)
    {
        $comma   = explode(',', $line);
        $colon   = explode(':', $comma[14]);
        $results = $colon[1];

        return $results;
    }
}
