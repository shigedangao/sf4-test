<?php
/**
 * Created by PhpStorm.
 * User: marcintha
 * Date: 04/12/2018
 * Time: 17:58
 */

namespace App\GraphQL\Resolver;

use App\Common\Errors\GraphQLErrorInterface;
use App\GraphQL\AbstractGraphQLInjector;
use App\Utils\GraphQL\ArgsParser;
use GraphQL\Error\UserError;
use GraphQL\Type\Definition\ResolveInfo;
use Overblog\GraphQLBundle\Definition\Argument;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class BaseResolverMap
 * @package App\GraphQL\Resolver
 */
class BaseResolverMap extends AbstractGraphQLInjector
{

    /**
     * BaseResolverMap constructor.
     *
     * @param \Symfony\Component\DependencyInjection\ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        parent::__construct($container);
    }

    /**
     * @return array|callable[]
     */
    protected function map()
    {
        return [
            'AirplaneQuery' => [
                self::RESOLVE_FIELD => function($value, Argument $args, \ArrayObject $ctx, ResolveInfo $info) {
                    $fieldName = $info->fieldName;
                    if (!isset($fieldName)) {
                        throw new UserError(GraphQLErrorInterface::FIELD_NAME_EMPTY);
                    }

                    $resolver = parent::getResolver($fieldName);
                    return $resolver->resolve($args);
                }
            ],
            'AirplaneMutation' => [
               self::RESOLVE_FIELD => function($value, Argument $args, \ArrayObject $ctx, ResolveInfo $info) {
                    $fieldName = $info->fieldName;
                    if (!isset($fieldName)) {
                        throw new UserError(GraphQLErrorInterface::FIELD_NAME_EMPTY);
                    }

                   $kind = ArgsParser::parseMutationArgs($fieldName);
                   $mutator = parent::getMutator($kind['target']);

                   return $mutator->mutate($kind['operation'], $args);
               }
            ]
        ];
    }
}