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
    public const QUERY_EMPTY = "The query does not contain any schema";
    public const CLASS_NOT_FOUND = "The class can not be found in the container";
    public const FIELD_NAME_EMPTY = "The query is empty";
    public const MUTATION_ARGS_NOT_FOUND = "The mutation args are not found";
}