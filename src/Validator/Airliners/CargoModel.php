<?php
/**
 * Created by PhpStorm.
 * User: marcintha
 * Date: 05/12/2018
 * Time: 18:01
 */

namespace App\Validator\Airliners;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class CargoModel
 *
 * @package App\Validator\Airliners
 */
class CargoModel
{
    /**
     * @var integer
     *
     * @Assert\NotNull()
     */
    protected $payload;

    /**
     * @var float
     *
     * @Assert\NotNull()
     */
    protected $container;

    /**
     * @var integer
     *
     * @Assert\NotNull()
     */
    protected $aircraft;
}