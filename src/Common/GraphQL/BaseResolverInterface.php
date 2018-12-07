<?php
/**
 * Created by PhpStorm.
 * User: marcintha
 * Date: 07/12/2018
 * Time: 14:08
 */

namespace App\Common\GraphQL;

use Overblog\GraphQLBundle\Definition\Argument;

/**
 * Interface BaseResolverInterface
 *
 * @package App\Common\GraphQL
 */
interface BaseResolverInterface
{
    /**
     * @param \Overblog\GraphQLBundle\Definition\Argument $args
     * @return mixed
     */
    public function resolve(Argument $args);
}