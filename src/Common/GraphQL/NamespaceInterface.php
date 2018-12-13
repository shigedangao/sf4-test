<?php
/**
 * Created by PhpStorm.
 * User: marcintha
 * Date: 13/12/2018
 * Time: 10:36
 */

namespace App\Common\GraphQL;

/**
 * Interface NamespaceInterface
 *
 * @package App\Common\GraphQL
 */
interface NamespaceInterface
{
    public const BASE_RESOLVER_NAMESPACE = "App\GraphQL\Resolver\{folder}\{cls}";
    public const BASE_MUTATION_NAMESPACE = "App\GraphQL\Mutation\{folder}\{cls}";
}