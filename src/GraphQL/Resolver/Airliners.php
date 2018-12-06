<?php
/**
 * Created by PhpStorm.
 * User: marcintha
 * Date: 03/12/2018
 * Time: 23:36
 */

namespace App\GraphQL\Resolver;


use App\Repository\Airliner\AirlinersRepository;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\ResolverInterface;

/**
 * Class PassengerAirliners
 * @package App\Resolvers
 */
class Airliners implements ResolverInterface, AliasedInterface
{

    /**
     * @var
     */
    protected $repository;

    /**
     * PassengerAirliners constructor.
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
            'resolve' => 'PassengerAirliners'
        ];
    }
}