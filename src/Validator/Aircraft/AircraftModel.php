<?php
/**
 * Created by PhpStorm.
 * User: marcintha
 * Date: 03/12/2018
 * Time: 18:19
 */

namespace App\Validator\Aircraft;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class AircraftModel
 * @package App\Validator
 */
class AircraftModel
{
    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Length(min="1", max="255")
     */
    public $name;

    /**
     * @var integer
     *
     * @Assert\NotNull
     * @Assert\Range(
     *      min = 1,
     *      max = 6,
     *      minMessage = "You must enter at least 1 engine",
     *      maxMessage = "You must enter at least 1 engine but no more than 6 engines"
     * )
     */
    public $engines;

    /**
     * @var integer
     *
     * @Assert\NotNull
     * @Assert\GreaterThan(1)
     */
    public $distance;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     */
    public $type;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     */
    public $manufacturer;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     */
    public $code;

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
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @param string $code
     */
    public function setCode(string $code): void
    {
        $this->code = $code;
    }
}