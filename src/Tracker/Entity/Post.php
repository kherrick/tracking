<?php
namespace Tracker\Entity;

class Post
{
    private $date    = null;
    private $time    = null;
    private $batt    = null;
    private $smsrf   = null;
    private $loc     = null;
    private $locacc  = null;
    private $localt  = null;
    private $locspd  = null;
    private $loctms  = null;
    private $locn    = null;
    private $locnacc = null;
    private $locntms = null;
    private $cellid  = null;
    private $cellsig = null;
    private $cellsrv = null;

    public function __construct($post)
    {
        $this->date    = empty($post['DATE'])    ? null : $post['DATE'];
        $this->time    = empty($post['TIME'])    ? null : $post['TIME'];
        $this->batt    = empty($post['BATT'])    ? null : $post['BATT'];
        $this->smsrf   = empty($post['SMSRF'])   ? null : $post['SMSRF'];
        $this->loc     = empty($post['LOC'])     ? null : $post['LOC'];
        $this->locacc  = empty($post['LOCACC'])  ? null : $post['LOCACC'];
        $this->localt  = empty($post['LOCALT'])  ? null : $post['LOCALT'];
        $this->locspd  = empty($post['LOCSPD'])  ? null : $post['LOCSPD'];
        $this->loctms  = empty($post['LOCTMS'])  ? null : $post['LOCTMS'];
        $this->locn    = empty($post['LOCN'])    ? null : $post['LOCN'];
        $this->locnacc = empty($post['LOCNACC']) ? null : $post['LOCNACC'];
        $this->locntms = empty($post['LOCNTMS']) ? null : $post['LOCNTMS'];
        $this->cellid  = empty($post['CELLID'])  ? null : $post['CELLID'];
        $this->cellsig = empty($post['CELLSIG']) ? null : $post['CELLSIG'];
        $this->cellsrv = empty($post['CELLSRV']) ? null : $post['CELLSRV'];
    }

    public function getDate()
    {
        return $this->date;
    }

    public function getTime()
    {
        return $this->time;
    }

    public function getBattery()
    {
        return $this->batt;
    }

    public function getLastSMS()
    {
        return $this->smsrf;
    }

    public function getLocation()
    {
        return $this->loc;
    }

    public function getLocationAccuracy()
    {
        return $this->locacc;
    }

    public function getLocationAltitude()
    {
        return $this->localt;
    }

    public function getLocationSpeed()
    {
        return $this->locspd;
    }

    public function getLocationFixTimeSeconds()
    {
        return $this->loctms;
    }

    public function getLocationNetwork()
    {
        return $this->locn;
    }

    public function getLocationNetworkAccuracy()
    {
        return $this->locnacc;
    }

    public function getLocationNetworkFixTimeSeconds()
    {
        return $this->locntms;
    }

    public function getCellTowerId()
    {
        return $this->cellid;
    }

    public function getCellSignalStrength()
    {
        return $this->cellsig;
    }

    public function getCellServiceState()
    {
        return $this->cellsrv;
    }
}
