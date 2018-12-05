<?php
/**
 * Created by PhpStorm.
 * User: marcintha
 * Date: 03/12/2018
 * Time: 18:14
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class AbstractAircraft
 * @package App\Entity
 *
 * @ORM\Entity
 *
 */
class Aircraft
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    protected $name;

    /**
     * @var integer
     *
     * @ORM\Column(name="engines", type="integer")
     */
    protected $engines;

    /**
     * @var integer
     *
     * @ORM\Column(name="distance", type="integer")
     */
    protected $distance;

    /**
     * @var string
     *
     * @ORM\Column(name="reg", type="string", length=255)
     */
    private $reg;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="manufacturer", type="string", length=255)
     */
    private $manufacturer;

    /**
     * AbstractAircraft constructor
     *
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
        $this->engines  = $engines;
        $this->distance = $distance;
        $this->reg      = $reg;
        $this->type     = $type;
        $this->name     = $name;
        $this->manufacturer = $manufacturer;
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
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getEngines(): int
    {
        return $this->engines;
    }

    /**
     * @param int $engines
     */
    public function setEngines(int $engines): void
    {
        $this->engines = $engines;
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
     * @return string
     */
    public function getManufacturer(): string
    {
        return $this->manufacturer;
    }

    /**
     * @param string $manufacturer
     */
    public function setManufacturer(string $manufacturer): void
    {
        $this->manufacturer = $manufacturer;
    }

    /**
     * @return int
     */
    public function getDistance(): int
    {
        return $this->distance;
    }

    /**
     * @param int $distance
     */
    public function setDistance(int $distance): void
    {
        $this->distance = $distance;
    }
}