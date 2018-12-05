<?php
/**
 * Created by PhpStorm.
 * User: marcintha
 * Date: 05/12/2018
 * Time: 10:25
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class PersonalAircraft
 *
 * @package App\Entity
 * @ORM\Entity
 */
class PersonalAircraft extends AbstractAircraft
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
     * @var string
     *
     * @ORM\Column(name="base", type="string", length=255)
     */
    protected $base;

    /**
     * @var
     *
     * @ORM\ManyToOne(targetEntity="BaseAircraft")
     * @ORM\JoinColumn(name="personal_aircraft_id", referencedColumnName="id")
     */
    protected $aircraft;

    /**
     * PersonalAircraft constructor.
     *
     * @param int $passenger
     * @param string $owner
     * @param string $base
     */
    public function __construct(
        int $passenger,
        string $owner,
        string $base
    ) {
        parent::__construct(
            $passenger,
            $owner
        );

        $this->base = $base;
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
     * @return string
     */
    public function getBase(): string
    {
        return $this->base;
    }

    /**
     * @param string $base
     */
    public function setBase(string $base): void
    {
        $this->base = $base;
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