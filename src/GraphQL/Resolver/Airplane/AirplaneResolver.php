<?php
/**
 * Created by PhpStorm.
 * User: marcintha
 * Date: 07/12/2018
 * Time: 14:05
 */

namespace App\GraphQL\Resolver\Airplane;


use App\Repository\AirplaneRepository;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\ResolverInterface;

/**
 * Class AirplaneResolver
 *
 * @package App\GraphQL\Resolver\Airplane
 */
class AirplaneResolver implements ResolverInterface, AliasedInterface
{
    /**
     * @var $repository \App\Repository\AirplaneRepository
     */
    public $repository;

    /**
     * AirplaneResolver constructor.
     *
     * @param \App\Repository\AirplaneRepository $airplaneRepository
     */
    public function __construct(AirplaneRepository $airplaneRepository)
    {
        $this->repository = $airplaneRepository;
    }

    /**
     * @return array
     */
    public function resolve() {
        return $this->repository->findAllOrderByCode();
    }

    /**
     * @return array
     */
    public static function getAliases()
    {
        return [
            'resolve' => 'Airplane'
        ];
    }

}