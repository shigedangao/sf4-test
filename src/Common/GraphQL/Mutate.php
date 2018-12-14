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
     * @param string $operation
     * @param \Overblog\GraphQLBundle\Definition\Argument $args
     * @return mixed
     */
    public function mutate(string $operation, Argument $args);

    /**
     * @return mixed
     */
    public function insert();

    /**
     * @return mixed
     */
    public function update();

    /**
     * @return mixed
     */
    public function delete();
}