<?php
/**
 * Created by PhpStorm.
 * User: marcintha
 * Date: 19/12/2018
 * Time: 12:21
 */

namespace App\Security;


use App\Entity\User\User;
use App\Repository\User\UserRepository;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

/**
 * Class UserProvider
 *
 * @package App\Security
 */
class UserProvider implements UserProviderInterface
{
    private $repo;

    /**
     * UserProvider constructor.
     *
     * @param \App\Repository\User\UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->repo = $userRepository;
    }

    /**
     * @param string $username
     * @return null|object|\Symfony\Component\Security\Core\User\UserInterface
     */
    public function loadUserByUsername($username)
    {
        $user = $this->repo->findByUsername($username);
        if (isset($user)) {
            return $user;
        }

        throw new UnsupportedUserException(sprintf("Unable to refresh the user for username: %s", $username));
    }

    /**
     * @param \Symfony\Component\Security\Core\User\UserInterface $user
     * @return null|object|\Symfony\Component\Security\Core\User\UserInterface
     */
    public function refreshUser(UserInterface $user)
    {
        if (!$user instanceof User) {
            throw new UnsupportedUserException("User is invalid");
        }

        // refresh the user
        return $this->loadUserByUsername($user->getUsername());
    }

    /**
     * @param string $class
     * @return bool
     */
    public function supportsClass($class)
    {
        return User::class === $class;
    }
}