<?php
/**
 * Created by PhpStorm.
 * User: marcintha
 * Date: 05/12/2018
 * Time: 18:25
 */

namespace App\Validator;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class AbstractAircraftModel
 *
 * @package App\Validator
 */
abstract class AbstractAircraftModel
{
    /**
     * @var integer
     *
     * @Assert\NotNull()
     */
    public $passenger;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     */
    public $owner;

    /**
     * @var float
     *
     * @Assert\NotNull
     */
    public $cargo;

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
}