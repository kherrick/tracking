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
        $content  = 'DT:' . $this->data->getDate() . '_' . $this->data->getTime();
        $content .= '@BATT:' . $this->data->getBattery();
        $content .= ',SMSRF:' . $this->data->getLastSMS();
        $content .= ',LOC:' . $this->data->getLocation();
        $content .= ',LOCACC:' . $this->data->getLocationAccuracy();
        $content .= ',LOCALT:' . $this->data->getLocationAltitude();
        $content .= ',LOCSPD:' . $this->data->getLocationSpeed();
        $content .= ',LOCTMS:' . $this->data->getLocationFixTimeSeconds();
        $content .= ',LOCN:' . $this->data->getLocationNetwork();
        $content .= ',LOCNACC:' . $this->data->getLocationNetworkAccuracy();
        $content .= ',LOCNTMS:' . $this->data->getLocationNetworkFixTimeSeconds();
        $content .= ',CELLID:' . $this->data->getCellTowerId();
        $content .= ',CELLSIG:' . $this->data->getCellSignalStrength();
        $content .= ',CELLSRV:' . $this->data->getCellServiceState() . "\n";

        $this->file->write($content, FILE_APPEND, __DIR__ . '/../../../logs/' . $this->file->date . '_data_capture.log');
    }
}
