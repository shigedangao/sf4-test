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

/**
 * Class BaseResolverMap
 * @package App\GraphQL\Resolver
 */
class BaseResolverMap extends ResolverMap
{

    /**
     * @var \App\GraphQL\Resolver\AirlinersResolver
     */
    protected $airliner;


    public function __construct(AirlinersResolver $airliner)
    {
        $this->airliner = $airliner;
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

                    if ($fieldName == "airliners") {
                        return $this->airliner->resolve();
                    }

                    return 'Lol';
                }
            ]
        ];
    }

}