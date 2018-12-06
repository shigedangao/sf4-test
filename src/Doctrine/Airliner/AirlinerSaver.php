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
 * @package App\Doctrine\Airliner
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
     * @param $object \App\Validator\Airliners\PassengerModel
     * @return mixed|void
     */
    public function create($object)
    {
        $this->airliners = new PassengerAirliners($object);
    }

}