<?php
namespace Tracker\Service;

class Log
{
    private $file = null;
    private $data = null;

    public function __construct($file, $data) {
        $this->file = $file;
        $this->data = $data;
    }

    /**
     * log the data to a file
     * @return null
     */
    public function write()
    {
        $location  = 'DT:' . $this->data->getDate() . '_' . $this->data->getTime();
        $location .= '@BATT:' . $this->data->getBattery();
        $location .= ',SMSRF:' . $this->data->getLastSMS();
        $location .= ',LOC:' . $this->data->getLocation();
        $location .= ',LOCACC:' . $this->data->getLocationAccuracy();
        $location .= ',LOCALT:' . $this->data->getLocationAltitude();
        $location .= ',LOCSPD:' . $this->data->getLocationSpeed();
        $location .= ',LOCTMS:' . $this->data->getLocationFixTimeSeconds();
        $location .= ',LOCN:' . $this->data->getLocationNetwork();
        $location .= ',LOCNACC:' . $this->data->getLocationNetworkAccuracy();
        $location .= ',LOCNTMS:' . $this->data->getLocationNetworkFixTimeSeconds();
        $location .= ',CELLID:' . $this->data->getCellTowerId();
        $location .= ',CELLSIG:' . $this->data->getCellSignalStrength();
        $location .= ',CELLSRV:' . $this->data->getCellServiceState() . "\n";

        $this->file->write(
            $location,
            FILE_APPEND,
            __DIR__ . '/../../../logs/' . $this->file->date . '_data_capture.log'
        );
    }
}
