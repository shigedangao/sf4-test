<?php
/**
 * Created by PhpStorm.
 * User: marcintha
 * Date: 05/12/2018
 * Time: 18:13
 */

namespace App\Repository;

use App\Entity\BaseAircraft;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class AirplaneRepository
 *
 * @package App\Repository
 */
class AirplaneRepository
{
    /**
     * @var \Doctrine\ORM\EntityManagerInterface
     */
    private $repository;

    /**
     * AirplaneRepository constructor.
     *
     * @param \Doctrine\ORM\EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->repository = $entityManager->getRepository(BaseAircraft::class);
    }

    /**
     * @param string $code
     * @return \App\Entity\BaseAircraft|null|object
     */
    public function findOneByCode(string $code) {
        return $this->repository->findOneBy([
            'code' => $code
        ]);
    }


    /**
     * @return array
     */
    public function findAllOrderByCode(): array {
        return $this->repository->findBy([], [
            'code' => 'ASC'
        ]);
    }
}