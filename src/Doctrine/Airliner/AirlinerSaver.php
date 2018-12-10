<?php
/**
 * Created by PhpStorm.
 * User: marcintha
 * Date: 06/12/2018
 * Time: 13:15
 */

namespace App\Doctrine\Airliner;


use App\Common\Saver\SaverInterface;
use App\Entity\Passenger\PassengerAirliners;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class AirlinerSaver
 *
 * @package App\Doctrine\AirlinerResolver
 */
class AirlinerSaver implements SaverInterface
{

    /**
     * @var EntityManagerInterface
     */
    protected $em;

    /**
     * @var \App\Entity\Passenger\PassengerAirliners
     */
    protected $airliners;

    /**
     * AirlinerSaver constructor.
     *
     * @param \Doctrine\ORM\EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @return mixed|string
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
     * @param $model \App\Validator\Airliners\PassengerModel
     * @return mixed|void
     */
    public function create($model)
    {
        $this->airliners = new PassengerAirliners(
            $model->passenger,
            $model->owner
        );

        $this->airliners->setThrust($model->thrust);
        $this->airliners->setCargo($model->cargo);
        $this->airliners->setAisle($model->aisle);
        $this->airliners->setReg($model->reg);
        $this->airliners->setAircraft($model->aircraft);
    }

    /**
     * @param $object \App\Entity\Passenger\PassengerAirliners
     * @return mixed|void
     */
    public function update($object)
    {
        $object->setPassenger($this->airliners->getPassenger());
        $object->setAisle($this->airliners->getAisle());
        $object->setReg($this->airliners->getReg());
        $object->setThrust($this->airliners->getThrust());
        $object->setCargo($this->airliners->getCargo());
        $object->setAircraft($this->airliners->getAircraft());

        $this->em->flush();
    }
}