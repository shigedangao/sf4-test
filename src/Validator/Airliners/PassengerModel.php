<?php
/**
 * Created by PhpStorm.
 * User: marcintha
 * Date: 03/12/2018
 * Time: 18:18
 */

namespace App\Validator\Airliners;

use App\Validator\AbstractAircraftModel;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class PassengerModel
 * @package App\Validator\PassengerAirliners
 */
class PassengerModel extends AbstractAircraftModel
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
     * @Assert\Range(
     *     min = 1,
     *     max = 2
     * )
     */
    public $aisle;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     */
    public $reg;

    /**
     * @var \App\Entity\BaseAircraft
     *
     * @Assert\NotNull()
     */
    public $aircraft;
}