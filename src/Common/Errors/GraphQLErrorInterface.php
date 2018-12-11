<?php
/**
 * Created by PhpStorm.
 * User: marcintha
 * Date: 11/12/2018
 * Time: 17:51
 */

namespace App\Common\Errors;


interface GraphQLErrorInterface
{
    public const EMPTY_NS = "Namespace is empty";
    public const MUTATION_NOT_FOUND = "Mutation not found on container";
}