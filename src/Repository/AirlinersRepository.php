<?php
/**
 * Created by PhpStorm.
 * User: marcintha
 * Date: 03/12/2018
 * Time: 18:17
 */

namespace App\Repository;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\PassengerAirliners;

/**
 * Class AirlinersRepository
 * @package App\Repository
 */
class AirlinersRepository
{

    /**
     * @var
     */
    private $repository;

    /**
     * AirlinersRepository constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->repository = $entityManager->getRepository(PassengerAirliners::class);
    }

    /**
     * Find All Ordered By Name
     *
     * @return array
     */
    public function findAllOrderedByName(): array {
        return $this->repository->findBy([], [
            'name' => 'ASC'
        ]);
    }

    /**
     * Find By Reg
     *
     * @param string $reg
     * @return object
     */
    public function findByReg(string $reg) {
        return $this->repository->findOneBy([
            'reg' => $reg
        ]);
    }

    /**
     * Find By Manufacturer
     *
     * @param string $manufacturer
     * @return array
     */
    public function findByManufacturer(string $manufacturer): array {
        return $this->respository->findBy([
            'manufacturer' => $manufacturer
        ], [
            'name' => 'ASC'
        ]);
    }
}