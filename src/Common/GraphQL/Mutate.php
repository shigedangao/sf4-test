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
     * @param array $given
     * @return \stdClass
     */
    public function extract(Argument $args, array $given): \stdClass;

    /**
     * @param string $operation
     * @param \Overblog\GraphQLBundle\Definition\Argument $args
     * @return mixed
     */
    public function mutate(string $operation, Argument $args);

    /**
     * @param \Overblog\GraphQLBundle\Definition\Argument $args
     * @return mixed
     */
    public function insert(Argument $args);

    /**
     * @param \Overblog\GraphQLBundle\Definition\Argument $args
     * @return mixed
     */
    public function update(Argument $args);

    /**
     * @param \Overblog\GraphQLBundle\Definition\Argument $args
     * @return mixed
     */
    public function delete(Argument $args);

    /**
     * @param \Overblog\GraphQLBundle\Definition\Argument $args
     * @return mixed
     */
    public function validate(Argument $args);
}