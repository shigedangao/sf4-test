<?php
/**
 * Created by PhpStorm.
 * User: marcintha
 * Date: 03/12/2018
 * Time: 18:18
 */

namespace App\Validator\Airliners;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class AirlinersModel
 * @package App\Validator\Airliners
 */
class AirlinersModel
{
    /**
     * @var float
     *
     * @Assert\NotNull
     */
    public $thrust;

    /**
     * @var integer
     *
     * @Assert\NotNull
     * @Assert\GreaterThan(80)
     */
    public $passenger;

    /**
     * @var float
     *
     * @Assert\NotNull
     */
    public $cargo;

    /**
     * @var integer
     *
     * @Assert\NotNull
     * @Assert\Range(
     *     min = 1,
     *     max = 2
     * )
     */
    public $aisle;
}