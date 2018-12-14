<?php
/**
 * Created by PhpStorm.
 * User: marcintha
 * Date: 13/12/2018
 * Time: 10:34
 */

namespace App\GraphQL;

use App\Common\Errors\GraphQLErrorInterface;
use App\Common\GraphQL\NamespaceInterface;
use Overblog\GraphQLBundle\Resolver\ResolverMap;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class AbstractGraphQLInjector
 *
 * @package App\GraphQL
 */
abstract class AbstractGraphQLInjector extends ResolverMap implements NamespaceInterface
{
    /**
     * @var \Symfony\Component\DependencyInjection\ContainerInterface
     */
    private $container;

    /**
     * AbstractGraphQLInjector constructor.
     *
     * @param \Symfony\Component\DependencyInjection\ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @param string $nsBase
     * @param string $query
     * @return string
     */
    protected function buildNamespace(string $nsBase, string $query): string {
        $ns = $query;
        $kind = mb_substr($query, -1);
        // Check if it's a plural query and return the singular in order to get the folder
        if (!strcmp('s', $kind)) {
            $ns = mb_substr($query, 0, -1);
            $ns = ucfirst($ns);
        } else {
            $ns = ucfirst($ns);
        }

        if (preg_match('/\bResolver\b/', $nsBase)) {
            $baseName = ucfirst($query."Resolver");
        } else {
            $baseName = ucfirst($query."Mutation");
        }

        $namespace = $nsBase;
        $namespace = str_replace("{folder}", $ns, $namespace);
        $namespace = str_replace("{cls}", $baseName, $namespace);

        return $namespace;
    }

    /**
     * @param string $ns
     * @return object
     */
    protected function getClsFromStr(string $ns) {
        if (!isset($ns)) {
            throw new Exception(GraphQLErrorInterface::EMPTY_NS);
        }

        $class = $this->container->get($ns);
        if (isset($class)) {
            return $class;
        }

        throw new Exception(GraphQLErrorInterface::CLASS_NOT_FOUND);
    }

    /**
     * @param string $query
     * @return object
     */
    public function getResolver(string $query) {
        if (!isset($query)) {
            throw new Exception(GraphQLErrorInterface::QUERY_EMPTY);
        }

        $ns = $this->buildNamespace(NamespaceInterface::BASE_RESOLVER_NAMESPACE, $query);
        $resolver = $this->getClsFromStr($ns);

        return $resolver;
    }

    /**
     * @param string $query
     * @return object
     */
    public function getMutator(string $query) {
        if (!isset($query)) {
            throw new Exception(GraphQLErrorInterface::QUERY_EMPTY);
        }

        $ns = $this->buildNamespace(NamespaceInterface::BASE_MUTATION_NAMESPACE, $query);
        $resolver = $this->getClsFromStr($ns);

        return $resolver;
    }
}