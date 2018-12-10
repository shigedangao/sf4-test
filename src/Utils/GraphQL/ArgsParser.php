<?php
/**
 * Created by PhpStorm.
 * User: marcintha
 * Date: 10/12/2018
 * Time: 11:24
 */

namespace App\Utils\GraphQL;


use Overblog\GraphQLBundle\Definition\Argument;

/**
 * Class ArgsParser
 *
 * @package App\Utils\GraphQL
 */
class ArgsParser
{
    /**
     * @param \Overblog\GraphQLBundle\Definition\Argument $args
     * @param array $wanted
     * @return array|NULL
     */
    static function parseArguments(Argument $args, array $wanted) {
        $filtered = array();

        foreach($wanted as $id) {
            if ($args->offsetExists($id)) {
                array_push($filtered, $args->offsetGet($id));
            }
        }

        $has = count($filtered);
        if (!$has) {
            return NULL;
        }

        return $filtered;
    }
}