<?php
/**
 * Created by PhpStorm.
 * User: marcintha
 * Date: 03/12/2018
 * Time: 23:32
 */

namespace App\GraphQL\Resolver\Airliner;

use App\Repository\Airliner\AirlinersRepository;
use App\Utils\GraphQL\ArgsParser;
use Overblog\GraphQLBundle\Definition\Argument;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\ResolverInterface;

/**
 * Class AirlinerResolver
 * @package App\Resolvers
 */
class AirlinerResolver implements ResolverInterface, AliasedInterface
{

    /**
     * @var
     */
    protected $repository;

    /**
     * AirlinerResolver constructor.
     *
     * @param $airlinersRepository AirlinersRepository
     */
    public function __construct(AirlinersRepository $airlinersRepository) {
        $this->repository = $airlinersRepository;
    }

    /**
     * @param \Overblog\GraphQLBundle\Definition\Argument $args
     * @return null|object
     */
    public function resolve(Argument $args) {
        $criteria = ArgsParser::parseArguments($args, [
            'reg'
        ]);

        if (isset($criteria)) {
            return $this->repository->findByReg($criteria[0]);
        }

        return NULL;
    }

    /**
     * @return array
     */
    public static function getAliases(): array
    {
        return [
            'resolve' => 'AirlinerResolver'
        ];
    }

}