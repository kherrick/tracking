<?php
namespace Tracker\Entity;

class Post
{
    /**#@+
     * @var string
     */
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
    /**#@-*/

    /**
     * @param array $post
     */
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

    /**
     * @return string
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @return string
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * @return string
     */
    public function getBattery()
    {
        return $this->batt;
    }

    /**
     * @return string
     */
    public function getLastSMS()
    {
        return $this->smsrf;
    }

    /**
     * @return string
     */
    public function getLocation()
    {
        return $this->loc;
    }

    /**
     * @return string
     */
    public function getLocationAccuracy()
    {
        return $this->locacc;
    }

    /**
     * @return string
     */
    public function getLocationAltitude()
    {
        return $this->localt;
    }

    /**
     * @return string
     */
    public function getLocationSpeed()
    {
        return $this->locspd;
    }

    /**
     * @return string
     */
    public function getLocationFixTimeSeconds()
    {
        return $this->loctms;
    }

    /**
     * @return string
     */
    public function getLocationNetwork()
    {
        return $this->locn;
    }

    /**
     * @return string
     */
    public function getLocationNetworkAccuracy()
    {
        return $this->locnacc;
    }

    /**
     * @return string
     */
    public function getLocationNetworkFixTimeSeconds()
    {
        return $this->locntms;
    }

    /**
     * @return string
     */
    public function getCellTowerId()
    {
        return $this->cellid;
    }

    /**
     * @return string
     */
    public function getCellSignalStrength()
    {
        return $this->cellsig;
    }

    /**
     * @return string
     */
    public function getCellServiceState()
    {
        return $this->cellsrv;
    }
}
