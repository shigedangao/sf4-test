<?php
/**
 * Created by PhpStorm.
 * User: marcintha
 * Date: 18/12/2018
 * Time: 12:34
 */

namespace App\Validator\User;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class UserModel
 *
 * @package App\Validator\User
 */
class UserModel
{
    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Length(min="5", max="255")
     */
    protected $username;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Length(min="5", max="255")
     */
    protected $password;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Choice({"user", "admin"})
     */
    protected $roles;
}