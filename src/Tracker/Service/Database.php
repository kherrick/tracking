<?php
namespace Tracker\Service;

use Tracker\Entity\Location;

class Database
{

    private $entityManager = null;
    private $data = null;

    public function __construct($entityManager, $data)
    {
        $this->entityManager = $entityManager;
        $this->data = $data;
    }

    /**
     * send a query to the entity manager
     * @param  string $string
     * @return array
     */
    public function query($string)
    {
        $query = $this->entityManager->createQuery($string);

        $result = $query->getResult();

        return $result;
    }

    public function select($id, $getter)
    {
        $location = $this->entityManager->find('Tracker\Entity\Location', $id);

        if ($location === null) {
            echo "No location found.\n";
        }

        return $location->{"get$getter"}();
    }

    public function insert()
    {
        $location = new Location;

        $location->setDate($this->data->getDate());
        $location->setTime($this->data->getTime());
        $location->setBatt($this->data->getBattery());
        $location->setSmsrf($this->data->getLastSMS());
        $location->setLoc($this->data->getLocation());
        $location->setLocacc($this->data->getLocationAccuracy());
        $location->setLocalt($this->data->getLocationAltitude());
        $location->setLocspd($this->data->getLocationSpeed());
        $location->setLoctms($this->data->getLocationFixTimeSeconds());
        $location->setLocn($this->data->getLocationNetwork());
        $location->setLocnacc($this->data->getLocationNetworkAccuracy());
        $location->setLocntms($this->data->getLocationNetworkFixTimeSeconds());
        $location->setCellid($this->data->getCellTowerId());
        $location->setCellsig($this->data->getCellSignalStrength());
        $location->setCellsrv($this->data->getCellServiceState());

        $this->entityManager->persist($location);
        $this->entityManager->flush();

        return $location->getId();
    }

    public function drop($id)
    {
        $entity = $this->entityManager->find('Tracker\Entity\Location', $id);

        try {
            $location = $this->entityManager->remove($entity);
        } catch (Doctrine\ORM\ORMInvalidArgumentException $e) {
            return false;
        }

        $this->entityManager->flush();

        return true;
    }

    public function update($id, $setter, $value)
    {
        $location = $this->entityManager->find('Tracker\Entity\Location', $id);

        if ($location === null) {
            echo "Location $id does not exist.\n";

            return false;
        } else {
            $val = $location->{"set$setter"}($value);

            $this->entityManager->flush();

            return true;
        }
    }

    public function show()
    {
        $locationRepository = $this->entityManager->getRepository('Tracker\Entity\Location');
        $locations = $locationRepository->findAll();

        $results = [];

        foreach ($locations as $location) {
            $id      = $location->getId();
            $date    = $location->getDate();
            $time    = $location->getTime();
            $batt    = $location->getBatt();
            $smsrf   = $location->getSmsrf();
            $loc     = $location->getLoc();
            $locacc  = $location->getLocacc();
            $localt  = $location->getLocalt();
            $locspd  = $location->getLocspd();
            $loctms  = $location->getLoctms();
            $locn    = $location->getLocn();
            $locnacc = $location->getLocnacc();
            $locntms = $location->getLocntms();
            $cellid  = $location->getCellid();
            $cellsig = $location->getCellsig();
            $cellsrv = $location->getCellsrv();

            $content = [
                $id =>
                [
                    'DATE'    => $date,
                    'TIME'    => $time,
                    'BATT'    => $batt,
                    'SMSRF'   => $smsrf,
                    'LOC'     => $loc,
                    'LOCACC'  => $locacc,
                    'LOCALT'  => $localt,
                    'LOCSPD'  => $locspd,
                    'LOCTMS'  => $loctms,
                    'LOCN'    => $locn,
                    'LOCNACC' => $locnacc,
                    'LOCNTMS' => $locntms,
                    'CELLID'  => $cellid,
                    'CELLSIG' => $cellsig,
                    'CELLSRV' => $cellsrv,
                ]
            ];

            $results[] = $content;
        }

        return $results;
    }
}

