<?php
/**
 * Created by PhpStorm.
 * User: marcintha
 * Date: 03/12/2018
 * Time: 18:18
 */

namespace App\Validator\Airliners;

use App\Validator\AbstractAircraftModel;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class PassengerModel
 * @package App\Validator\PassengerAirliners
 */
class PassengerModel extends AbstractAircraftModel
{
    /**
     * @var float
     *
     * @Assert\NotNull
     */
    public $thrust;

    /**
     * @var integer
     *
     * @Assert\NotNull
     * @Assert\Range(
     *     min = 1,
     *     max = 2
     * )
     */
    public $aisle;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     */
    public $reg;

    /**
     * @var \App\Entity\BaseAircraft
     *
     * @Assert\NotNull()
     */
    public $aircraft;

    /**
     * @return float
     */
    public function getThrust(): float
    {
        return $this->thrust;
    }

    /**
     * @param float $thrust
     */
    public function setThrust(float $thrust): void
    {
        $this->thrust = $thrust;
    }

    /**
     * @return int
     */
    public function getAisle(): int
    {
        return $this->aisle;
    }

    /**
     * @param int $aisle
     */
    public function setAisle(int $aisle): void
    {
        $this->aisle = $aisle;
    }

    /**
     * @return string
     */
    public function getReg(): string
    {
        return $this->reg;
    }

    /**
     * @param string $reg
     */
    public function setReg(string $reg): void
    {
        $this->reg = $reg;
    }

    /**
     * @return \App\Entity\BaseAircraft
     */
    public function getAircraft(): \App\Entity\BaseAircraft
    {
        return $this->aircraft;
    }

    /**
     * @param \App\Entity\BaseAircraft $aircraft
     */
    public function setAircraft(\App\Entity\BaseAircraft $aircraft): void
    {
        $this->aircraft = $aircraft;
    }
}