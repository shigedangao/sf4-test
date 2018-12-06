<?php
/**
 * Created by PhpStorm.
 * User: marcintha
 * Date: 05/12/2018
 * Time: 17:57
 */

namespace App\Validator\GA;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class PersonalModel
 *
 * @package App\Validator\Airliners
 */
class PersonalModel
{
    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Length(min="1", max="255")
     */
    protected $base;

    /**
     * @var integer
     *
     * @Assert\NotNull()
     */
    protected $aircraft;
}