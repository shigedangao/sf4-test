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
}