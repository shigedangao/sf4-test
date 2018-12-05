<?php
/**
 * Created by PhpStorm.
 * User: marcintha
 * Date: 03/12/2018
 * Time: 18:15
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Airliners
 * @package App\Entity
 *
 * @ORM\Entity
 */
class Airliners extends AbstractAircraft
{
    /**
     * @var float
     *
     * @ORM\Column(name="thrust", type="decimal")
     */
    protected $thrust;

    /**
     * @var integer
     *
     * @ORM\Column(name="passenger", type="integer")
     */
    protected $passenger;

    /**
     * @var float
     *
     * @ORM\Column(name="cargo", type="decimal")
     */
    protected $cargo;

    /**
     * @var integer
     *
     * @ORM\Column(name="aisle", type="integer")
     */
    protected $aisle;

    /**
     * Airliners constructor
     *
     * @param int $engines
     * @param int $distance
     * @param string $reg
     * @param string $type
     * @param string $name
     * @param string $manufacturer
     */
    public function __construct(
        int $engines,
        int $distance,
        string $reg,
        string $type,
        string $name,
        string $manufacturer
    ){
        parent::__construct(
            $engines,
            $distance,
            $reg,
            $type,
            $name,
            $manufacturer
        );
    }

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
    public function getPassenger(): int
    {
        return $this->passenger;
    }

    /**
     * @param int $passenger
     */
    public function setPassenger(int $passenger): void
    {
        $this->passenger = $passenger;
    }

    /**
     * @return float
     */
    public function getCargo(): float
    {
        return $this->cargo;
    }

    /**
     * @param float $cargo
     */
    public function setCargo(float $cargo): void
    {
        $this->cargo = $cargo;
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
}