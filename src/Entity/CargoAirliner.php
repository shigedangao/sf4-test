<?php
/**
 * Created by PhpStorm.
 * User: marcintha
 * Date: 05/12/2018
 * Time: 10:34
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class CargoAirliner
 *
 * @package App\Entity
 * @ORM\Entity
 */

class CargoAirliner extends AbstractAircraft
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
     * @ORM\Column(name="payload", type="decimal")
     */
    protected $payload;

    /**
     * @var float
     *
     * @ORM\Column(name="container", type="decimal")
     */
    protected $container;

    /**
     * @var
     *
     * @ORM\ManyToOne(targetEntity="BaseAircraft")
     * @ORM\JoinColumn(name="cargo_aircraft_id", referencedColumnName="id")
     */
    protected $aircraft;

    /**
     * CargoAirliner constructor.
     *
     * @param float $cargo
     * @param string $container
     * @param string $passenger
     * @param int $owner
     */
    public function __construct(
        float $cargo,
        string $container,
        string $passenger,
        int $owner
    ) {
        parent::__construct(
            $passenger,
            $owner
        );

        $this->payload = $cargo;
        $this->container = $container;
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
     * @return float
     */
    public function getPayload(): float
    {
        return $this->payload;
    }

    /**
     * @param float $payload
     */
    public function setPayload(float $payload): void
    {
        $this->payload = $payload;
    }

    /**
     * @return float
     */
    public function getContainer(): float
    {
        return $this->container;
    }

    /**
     * @param float $container
     */
    public function setContainer(float $container): void
    {
        $this->container = $container;
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