<?php
/**
 * Created by PhpStorm.
 * User: marcintha
 * Date: 03/12/2018
 * Time: 18:13
 */

namespace App\Doctrine;


use App\Common\Saver\SaverInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Airliners;

class AirlinerSaver implements SaverInterface
{

    /**
     * @var
     */
    protected $airliners;

    /**
     * @var EntityManagerInterface
     */
    protected $em;

    /**
     * AirlinerSaver constructor.
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
     * @param $object
     * @return Airliners $object
     */
    public function create($object)
    {
        $this->airliners = new Airliners(
            $object->engines,
            $object->distance,
            $object->reg,
            $object->type,
            $object->name,
            $object->manufacturer
        );

        $this->airliners->setCargo($object->cargo);
        $this->airliners->setPassenger($object->passenger);
        $this->airliners->setAisle($object->aisle);
        $this->airliners->setThrust($object->thrust);
    }

    /**
     * Hydrate the db object with the update object
     *
     * @param $dbObject
     */
    public function update(Airliners $dbObject) {
        $dbObject->setPassenger($this->airliners->getPassenger());
        $dbObject->setReg($this->airliners->getReg());
        $dbObject->setAisle($this->airliners->getAisle());
        $dbObject->setEngines($this->airliners->getEngines());

        $this->em->flush();
    }
}