<?php
/**
 * Created by PhpStorm.
 * User: marcintha
 * Date: 11/12/2018
 * Time: 17:10
 */

namespace App\Common\GraphQL;


use Overblog\GraphQLBundle\Definition\Argument;

/**
 * Interface Mutate
 *
 * @package App\Common\GraphQL
 */
interface Mutate
{
    /**
     * @param \Overblog\GraphQLBundle\Definition\Argument $args
     * @return mixed
     */
    public function mutate(Argument $args);
}