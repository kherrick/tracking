<?php
namespace Tracker\Data\Transformer;

use Tracker\Utilities\File;

class Log
{
    protected $data = null;

    protected $results  = array();

    public function __construct($filename)
    {
        $file = new File();
        $this->data = $file->fileHandler($filename);
    }

    public function lineHandler()
    {
        foreach ($this->data as $line) {
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

    /**
     * getter for results
     *
     * @return array the results of the script
     */
    public function getResults()
    {
        return $this->results;
    }

    protected function getDate($line)
    {
        $comma      = explode(',', $line);
        $at         = explode('@', $comma[0]);
        $underscore = explode('_', $at[0]);
        $colon      = explode(':', $underscore[0]);
        $date       = explode('-', $colon[1]);
        $year       = empty($date[2]) ? null : $date[2];
        $month      = $date[0];
        $day        = empty($date[1]) ? null : $date[1];
        $results    = $year . '-' . $month  . '-' . $day;

        return $results;
    }

    protected function getTime($line)
    {
        $comma      = explode(',', $line);
        $at         = explode('@', $comma[0]);
        $underscore = explode('_', $at[0]);
        $time       = explode('.', $underscore[1]);
        $hour       = $time[0];
        $minute     = empty($time[1]) ? null : $time[1];
        $results    = $hour . ':' . $minute;

        return $results;
    }

    protected function getBattery($line)
    {
        $comma   = explode(',', $line);
        $at      = explode('@', $comma[0]);
        $colon   = explode(':', $at[1]);
        $results = $colon[1];

        return $results;
    }

    protected function getLastSMS($line)
    {
        $comma   = explode(',', $line);
        $colon   = explode(':', $comma[1]);
        $results = $colon[1];

        return $results;
    }

    protected function getLatitude($line)
    {
        $comma   = explode(',', $line);
        $colon   = explode(':', $comma[2]);
        $results = $colon[1];

        return $results;
    }

    protected function getLongitude($line)
    {
        $comma   = explode(',', $line);
        $results = $comma[3];

        return $results;
    }

    protected function getLocationAccuracy($line)
    {
        $comma   = explode(',', $line);
        $colon   = explode(':', $comma[4]);
        $results = $colon[1];

        return $results;
    }

    protected function getLocationAltitude($line)
    {
        $comma   = explode(',', $line);
        $colon   = explode(':', $comma[5]);
        $results = $colon[1];

        return $results;
    }

    protected function getLocationSpeed($line)
    {
        $comma   = explode(',', $line);
        $colon   = explode(':', $comma[6]);
        $results = $colon[1];

        // data is saved in meters per second
        // for miles per hour use:
        $results = $results * 2.2369363;

        return $results;
    }

    protected function getLocationFixTimeSeconds($line)
    {
        $comma   = explode(',', $line);
        $colon   = explode(':', $comma[7]);
        $results = $colon[1];

        return $results;
    }

    protected function getLatitudeNetwork($line)
    {
        $comma   = explode(',', $line);
        $colon   = explode(':', $comma[8]);
        $results = $colon[1];

        return $results;
    }

    protected function getLongitudeNetwork($line)
    {
        $comma   = explode(',', $line);
        $results = $comma[9];

        return $results;
    }

    protected function getLocationNetworkAccuracy($line)
    {
        $comma   = explode(',', $line);
        $colon   = explode(':', $comma[10]);
        $results = $colon[1];

        return $results;
    }

    protected function getLocationNetworkFixTimeSeconds($line)
    {
        $comma   = explode(',', $line);
        $colon   = explode(':', $comma[11]);
        $results = $colon[1];

        return $results;
    }

    protected function getCellTowerId($line)
    {
        $comma   = explode(',', $line);
        $colon   = explode(':', $comma[12]);

        $results = empty($colon[1]) || empty($colon[2])
            ? null
            : $colon[1] . ':' . $colon[2];

        return $results;
    }

    protected function getCellSignalStrength($line)
    {
        $comma   = explode(',', $line);
        $colon   = empty($comma[13]) ? null : explode(':', $comma[13]);
        $results = $colon[1];

        return $results;
    }

    protected function getCellServiceState($line)
    {
        $comma   = explode(',', $line);
        $colon   = empty($comma[14]) ? null : explode(':', $comma[14]);
        $results = $colon[1];

        return $results;
    }
}
