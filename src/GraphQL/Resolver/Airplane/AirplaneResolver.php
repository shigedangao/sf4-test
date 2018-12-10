<?php
/**
 * Created by PhpStorm.
 * User: marcintha
 * Date: 07/12/2018
 * Time: 14:05
 */

namespace App\GraphQL\Resolver\Airplane;


use App\Common\GraphQL\BaseResolverInterface;
use App\Repository\AirplaneRepository;
use App\Utils\GraphQL\ArgsParser;
use Overblog\GraphQLBundle\Definition\Argument;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\ResolverInterface;

/**
 * Class AirplaneResolver
 *
 * @package App\GraphQL\Resolver\Airplane
 */
class AirplaneResolver implements ResolverInterface, AliasedInterface, BaseResolverInterface
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
     * @param \Overblog\GraphQLBundle\Definition\Argument $args
     * @return \App\Entity\BaseAircraft|mixed|null|object
     */
    public function resolve(Argument $args) {
        $criteria = ArgsParser::parseArguments($args, [
            'code'
        ]);

        if (isset($criteria)) {
            return $this->repository->findOneByCode($criteria[0]);
        }

        return NULL;
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