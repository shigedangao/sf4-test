<?php
/**
 * Created by PhpStorm.
 * User: marcintha
 * Date: 03/12/2018
 * Time: 23:36
 */

namespace App\GraphQL\Resolver;


use App\Repository\AirlinersRepository;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\ResolverInterface;

/**
 * Class Airliners
 * @package App\Resolvers
 */
class Airliners implements ResolverInterface, AliasedInterface
{

    /**
     * @var
     */
    protected $repository;

    /**
     * Airliners constructor.
     * @param AirlinersRepository $airlinersRepository
     */
    public function __construct(AirlinersRepository $airlinersRepository)
    {
        $this->repository = $airlinersRepository;
    }

    /**
     * @return array
     */
    public function resolve() {
        return $this->repository->findAllOrderedByName();
    }

    /**
     * @return array
     */
    public static function getAliases()
    {
        return [
            'resolve' => 'Airliners'
        ];
    }
}