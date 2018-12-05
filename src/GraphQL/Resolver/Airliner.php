<?php
/**
 * Created by PhpStorm.
 * User: marcintha
 * Date: 03/12/2018
 * Time: 23:32
 */

namespace App\GraphQL\Resolver;

use App\Repository\AirlinersRepository;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\ResolverInterface;

/**
 * Class Airliner
 * @package App\Resolvers
 */
class Airliner implements ResolverInterface, AliasedInterface
{

    /**
     * @var
     */
    protected $repository;

    /**
     * Airliner constructor.
     * @param AirlinersRepository $airlinersRepository
     */
    public function __construct(AirlinersRepository $airlinersRepository) {
        $this->repository = $airlinersRepository;
    }

    /**
     * @param string $reg
     * @return object
     */
    public function resolve(string $reg) {
        return $this->repository->findByReg($reg);
    }

    /**
     * @return array
     */
    public static function getAliases(): array
    {
        return [
            'resolve' => 'Airliner'
        ];
    }

}