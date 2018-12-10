<?php
/**
 * Created by PhpStorm.
 * User: marcintha
 * Date: 03/12/2018
 * Time: 23:32
 */

namespace App\GraphQL\Resolver\Airliner;

use App\Repository\Airliner\AirlinersRepository;
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
            'resolve' => 'AirlinerResolver'
        ];
    }

}