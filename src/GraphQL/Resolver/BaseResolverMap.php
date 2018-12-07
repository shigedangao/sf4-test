<?php
/**
 * Created by PhpStorm.
 * User: marcintha
 * Date: 04/12/2018
 * Time: 17:58
 */

namespace App\GraphQL\Resolver;

use App\GraphQL\Resolver\Airliner\AirlinersResolver;
use GraphQL\Type\Definition\ResolveInfo;
use Overblog\GraphQLBundle\Resolver\ResolverMap;
use Overblog\GraphQLBundle\Definition\Argument;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class BaseResolverMap
 * @package App\GraphQL\Resolver
 */
class BaseResolverMap extends AbstractResolver
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
                        return NULL;
                    }


                   /** if ($fieldName == "airliners") {
                        return $this->airliner->resolve();
                    }

                    return 'Lol';**/
                   $resolver = parent::getContainerByName("lol");
                   return $resolver->resolve();
                }
            ]
        ];
    }

}