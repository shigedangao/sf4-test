<?php
/**
 * Created by PhpStorm.
 * User: marcintha
 * Date: 05/12/2018
 * Time: 10:41
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class MilitaryAirliner
 *
 * @package App\Entity
 * @ORM\Entity
 */
class MilitaryAirliner extends AbstractAircraft
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
     * @var string
     *
     * @ORM\Column(name="weapon", type="string", length=255)
     */
    protected $weapon;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255)
     */
    protected $type;

    /**
     * @var
     *
     * @ORM\ManyToOne(targetEntity="BaseAircraft")
     * @ORM\JoinColumn(name="military_aircraft_id", referencedColumnName="id")
     */
    protected $aircraft;

    /**
     * MilitaryAirliner constructor.
     *
     * @param string $base
     * @param string $weapon
     * @param string $type
     * @param string $owner
     * @param int $passenger
     */
    public function __construct(
        string $base,
        string $weapon,
        string $type,
        string $owner,
        int $passenger
    ) {
        parent::__construct(
            $passenger,
            $owner
        );

        $this->base = $base;
        $this->weapon = $weapon;
        $this->type = $type;
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
     * @return string
     */
    public function getWeapon(): string
    {
        return $this->weapon;
    }

    /**
     * @param string $weapon
     */
    public function setWeapon(string $weapon): void
    {
        $this->weapon = $weapon;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
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