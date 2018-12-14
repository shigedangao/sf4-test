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
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class AirplaneSaver
 *
 * @package App\Doctrine\Airplane
 */
class AirplaneSaver implements SaverInterface
{

    /**
     * @var \App\Entity\BaseAircraft
     */
    protected $airplane;

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
            $this->em->persist($this->airplane);
            $this->em->flush();
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * @param $model
     * @return \App\Entity\BaseAircraft|mixed
     */
    public function create($model)
    {
        $this->airplane = new BaseAircraft();
        $this->airplane->setName($model->name);
        $this->airplane->setEngines($model->engines);
        $this->airplane->setDistance($model->distance);
        $this->airplane->setType($model->type);
        $this->airplane->setManufacturer($model->manufacturer);
        $this->airplane->setCode($model->code);

        return $this->airplane;
    }

    /**
     * Hydrate the db object with the update object
     *
     * @param $dbObject \App\Entity\BaseAircraft
     */
    public function update($dbObject) {
        $dbObject->setCode($this->airplane->getCode());
        $dbObject->setEngines($this->airplane->getEngines());
        $dbObject->setDistance($this->airplane->getDistance());
        $dbObject->setManufacturer($this->airplane->getManufacturer());
        $dbObject->setName($this->airplane->getName());

        $this->em->flush();
    }
}