<?php
/**
 * Created by PhpStorm.
 * User: marcintha
 * Date: 18/12/2018
 * Time: 12:28
 */

namespace App\Entity\User;


use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class User
 *
 * @package App\Entity\User
 */
class User implements UserInterface
{

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="username", length=255, unique=true)
     */
    protected $username;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string")
     */
    protected $password;

    /**
     * @var string
     *
     * @ORM\Column(name="roles", type="string")
     */
    protected $roles;

    /**
     * User constructor.
     *
     * @param string $username
     */
    public function __construct(string $username)
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getRoles(): string
    {
        return $this->roles;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @return string
     */
    public function getSalt()
    {
        return NULL;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }


    public function eraseCredentials()
    {
    }
}