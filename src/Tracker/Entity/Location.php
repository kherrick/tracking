<?php
namespace Tracker\Entity;

class Location
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $date;

    /**
     * @var string
     */
    protected $time;

    /**
     * @var integer
     */
    protected $batt;

    /**
     * @var string
     */
    protected $smsrf;

    /**
     * @var string
     */
    protected $loc;

    /**
     * @var integer
     */
    protected $locacc;

    /**
     * @var double
     */
    protected $localt;

    /**
     * @var double
     */
    protected $locspd;

    /**
     * @var integer
     */
    protected $loctms;

    /**
     * @var string
     */
    protected $locn;

    /**
     * @var string
     */
    protected $locnacc;

    /**
     * @var integer
     */
    protected $locntms;

    /**
     * @var string
     */
    protected $cellid;

    /**
     * @var integer
     */
    protected $cellsig;

    /**
     * @var string
     */
    protected $cellsrv;

    public function getId()
    {
        return $this->id;
    }

    public function getDate()
    {
        return $this->date->format('m-d-Y');
    }

    public function setDate($date)
    {
        $this->date = date_create_from_format('m-d-Y', $date);
    }

    public function getTime()
    {
        return $this->time->format('H.i');
    }

    public function setTime($time)
    {
        $this->time = date_create_from_format('H.i', $time);
    }

    public function getBatt()
    {
        return $this->batt;
    }

    public function setBatt($batt)
    {
        $this->batt = $batt;
    }

    public function getSmsrf()
    {
        return $this->smsrf;
    }

    public function setSmsrf($smsrf)
    {
        $this->smsrf = $smsrf;
    }

    public function getLoc()
    {
        return $this->loc;
    }

    public function setLoc($loc)
    {
        $this->loc = $loc;
    }

    public function getLocacc()
    {
        return $this->locacc;
    }

    public function setLocacc($locacc)
    {
        $this->locacc = $locacc;
    }

    public function getLocalt()
    {
        return $this->localt;
    }

    public function setLocalt($localt)
    {
        $this->localt = $localt;
    }

    public function getLocspd()
    {
        return $this->locspd;
    }

    public function setLocspd($locspd)
    {
        $this->locspd = $locspd;
    }

    public function getLoctms()
    {
        return $this->loctms;
    }

    public function setLoctms($loctms)
    {
        $this->loctms = $loctms;
    }

    public function getLocn()
    {
        return $this->locn;
    }

    public function setLocn($locn)
    {
        $this->locn = $locn;
    }

    public function getLocnacc()
    {
        return $this->locnacc;
    }

    public function setLocnacc($locnacc)
    {
        $this->locnacc = $locnacc;
    }

    public function getLocntms()
    {
        return $this->locntms;
    }

    public function setLocntms($locntms)
    {
        $this->locntms = $locntms;
    }

    public function getCellid()
    {
        return $this->cellid;
    }

    public function setCellid($cellid)
    {
        $this->cellid = $cellid;
    }

    public function getCellsig()
    {
        return $this->cellsig;
    }

    public function setCellsig($cellsig)
    {
        $this->cellsig = $cellsig;
    }

    public function getCellsrv()
    {
        return $this->cellsrv;
    }

    public function setCellsrv($cellsrv)
    {
        $this->cellsrv = $cellsrv;
    }
}
