<?php
/**
 * Created by PhpStorm.
 * User: marcintha
 * Date: 03/12/2018
 * Time: 18:13
 */

namespace App\Doctrine\Airplane;


use App\Common\Saver\SaverInterface;
use App\Entity\BaseAircraft;
use App\Validator\Aircraft\AircraftModel;
use Doctrine\ORM\EntityManagerInterface;

class AirplaneSaver implements SaverInterface
{

    /**
     * @var \App\Entity\BaseAircraft
     */
    protected $airliners;

    /**
     * @var EntityManagerInterface
     */
    protected $em;

    /**
     * AirplaneSaver constructor.
     *
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @return mixed
     */
    public function save()
    {
        try {
            $this->em->persist($this->airliners);
            $this->em->flush();
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Create the entity based on the Model
     *
     * @param $object AircraftModel
     */
    public function create($object)
    {
        $this->airliners = new BaseAircraft($object);
    }

    /**
     * Hydrate the db object with the update object
     *
     * @param $dbObject
     */
    public function update(BaseAircraft $dbObject) {
        $dbObject->setCode($this->airliners->getCode());
        $dbObject->setEngines($this->airliners->getEngines());
        $dbObject->setDistance($this->airliners->getDistance());
        $dbObject->setManufacturer($this->airliners->getManufacturer());
        $dbObject->setName($this->airliners->getName());

        $this->em->flush();
    }
}