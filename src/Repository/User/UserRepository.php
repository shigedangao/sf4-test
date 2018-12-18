<?php
/**
 * Created by PhpStorm.
 * User: marcintha
 * Date: 18/12/2018
 * Time: 13:02
 */

namespace App\Repository\User;


use App\Entity\User\User;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class UserRepository
 *
 * @package App\Repository\User
 */
class UserRepository
{
    /**
     * @var \Doctrine\Common\Persistence\ObjectRepository
     */
    private $repository;

    /**
     * UserRepository constructor.
     *
     * @param \Doctrine\ORM\EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->repository = $entityManager->getRepository(User::class);
    }

    /**
     * @param string $username
     * @return null|object
     */
    public function findByUsername(string $username) {
        return $this->repository->findOneBy([
            'username' => $username
        ]);
    }
}