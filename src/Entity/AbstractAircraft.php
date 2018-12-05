<?php
/**
 * Created by PhpStorm.
 * User: marcintha
 * Date: 05/12/2018
 * Time: 11:01
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class AbstractAircraft
 *
 * @package App\Entity
 * @ORM\MappedSuperclass
 */
abstract class AbstractAircraft
{

    /**
     * @var int
     *
     * @ORM\Column(name="passenger", type="string", length=255)
     */
    protected $passenger;

    /**
     * @var string
     *
     * @ORM\Column(name="owner", type="string", length=255)
     */
    protected $owner;

    /**
     * AbstractAircraft constructor.
     *
     * @param int $passenger
     * @param string $owner
     */
    public function __construct(
        int $passenger,
        string $owner
    ) {
        $this->passenger = $passenger;
        $this->owner = $owner;
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
     * @return string
     */
    public function getOwner(): string
    {
        return $this->owner;
    }

    /**
     * @param string $owner
     */
    public function setOwner(string $owner): void
    {
        $this->owner = $owner;
    }
}