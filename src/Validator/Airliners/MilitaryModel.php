<?php
/**
 * Created by PhpStorm.
 * User: marcintha
 * Date: 05/12/2018
 * Time: 18:04
 */

namespace App\Validator\Airliners;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class MilitaryModel
 *
 * @package App\Validator\Airliners
 */
class MilitaryModel
{
    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Length(min="1", max="255")
     */
    protected $base;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Length(min="1", max="255")
     */
    protected $weapon;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Length(min="1", max="255")
     */
    protected $type;

    /**
     * @var integer
     *
     * @Assert\NotNull()
     */
    protected $aircraft;
}