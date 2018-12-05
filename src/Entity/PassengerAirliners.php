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
 * Class PassengerAirliners
 * @package App\Entity
 *
 * @ORM\Entity
 */
class PassengerAirliners extends AbstractAircraft
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var float
     *
     * @ORM\Column(name="thrust", type="decimal")
     */
    protected $thrust;

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
     * @var
     *
     * @ORM\ManyToOne(targetEntity="BaseAircraft")
     * @ORM\JoinColumn(name="passenger_aircraft_id", referencedColumnName="id")
     */
    protected $aircraft;

    /**
     * PassengerAirliners constructor.
     *
     * @param float $thrust
     * @param float $cargo
     * @param int $passenger
     * @param string $owner
     * @param int $aisle
     */
    public function __construct(
        float $thrust,
        float $cargo,
        int $passenger,
        string $owner,
        int $aisle
    ) {
        parent::__construct(
            $passenger,
            $owner
        );

        $this->thrust = $thrust;
        $this->cargo = $cargo;
        $this->aisle = $aisle;
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

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getAircraft()
    {
        return $this->aircraft;
    }

    /**
     * @param mixed $aircraft
     */
    public function setAircraft($aircraft): void
    {
        $this->aircraft = $aircraft;
    }
}