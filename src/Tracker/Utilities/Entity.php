<?php
namespace Tracker\Utilities;

use Tracker\Entity\Location;

class Entity
{

    private $entityManager;

    public function __construct($entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function select($id, $getter)
    {
        $location = $this->entityManager->find('Tracker\Entity\Location', $id);

        if ($location === null) {
            echo "No location found.\n";
        }

        return $location->{"get$getter"}();
    }

    public function insert($data)
    {
        $location = new Location;

        $location->setDate($data[0]);
        $location->setTime($data[1]);
        $location->setBatt($data[2]);
        $location->setSmsrf($data[3]);
        $location->setLoc($data[4]);
        $location->setLocacc($data[5]);
        $location->setLocalt($data[6]);
        $location->setLocspd($data[7]);
        $location->setLoctms($data[8]);
        $location->setLocn($data[9]);
        $location->setLocnacc($data[10]);
        $location->setLocntms($data[11]);
        $location->setCellid($data[12]);
        $location->setCellsig($data[13]);
        $location->setCellsrv($data[14]);

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

