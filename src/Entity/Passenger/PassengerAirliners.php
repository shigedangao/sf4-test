<?php
/**
 * Created by PhpStorm.
 * User: marcintha
 * Date: 03/12/2018
 * Time: 18:15
 */

namespace App\Entity\Passenger;

use App\Entity\AbstractAircraft;
use App\Validator\Airliners\PassengerModel;
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
     * @var string
     *
     * @ORM\Column(name="reg", type="string", length=255)
     */
    protected $reg;


    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\BaseAircraft")
     * @ORM\JoinColumn(name="base_aircraft_id", referencedColumnName="id")
     */
    protected $aircraft;

    /**
     * PassengerAirliners constructor.
     *
     * @param $model \App\Validator\Airliners\PassengerModel
     */
    public function __construct(
        PassengerModel $model
    ) {
        parent::__construct(
            $model->passenger,
            $model->owner
        );

        $this->thrust = $model->thrust;
        $this->cargo = $model->cargo;
        $this->aisle = $model->aisle;
        $this->reg = $model->reg;
        $this->aircraft = $model->aircraft;
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
}