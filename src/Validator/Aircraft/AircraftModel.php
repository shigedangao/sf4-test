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
     * @Assert\Length(min="5")
     */
    public $reg;

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
}