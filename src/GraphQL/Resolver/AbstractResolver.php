<?php
/**
 * Created by PhpStorm.
 * User: marcintha
 * Date: 07/12/2018
 * Time: 17:23
 */

namespace App\GraphQL\Resolver;


use Overblog\GraphQLBundle\Resolver\ResolverMap;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class AbstractResolver
 *
 * @package App\GraphQL\Resolver
 */
abstract class AbstractResolver extends ResolverMap
{
    /**
     * @var string
     */
    private const BASE_RESOLVER_NAMESPACE = "App\GraphQL\Resolver\{folder}\{cls}";
    
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * AbstractResolver constructor.
     *
     * @param \Symfony\Component\DependencyInjection\ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @param string $name
     * @return string
     */
    private function getResolverNamespace(string $name) {
        $ns = $name;
        $kind = mb_substr($name, -1);
        // Check if it's a plural schema and return the singular in order to get the folder
        if (!strcmp('s', $kind)) {
            $ns = mb_substr($name, 0, -1);
            $ns = ucfirst($ns);
        } else {
            $ns = ucfirst($ns);
        }

        $baseResolverName = ucfirst($name."Resolver");
        $namespace = self::BASE_RESOLVER_NAMESPACE;
        $namespace = str_replace("{folder}", $ns, $namespace);
        $namespace = str_replace("{cls}", $baseResolverName, $namespace);

        return $namespace;
    }

    /**
     * @param string $name
     * @return null|object|string
     */
    public function getContainerByName(string $name) {
        if (!isset($name)) {
            return NULL;
        }

        $resolverName = $this->getResolverNamespace($name);
        try {
            $resolver = $this->container->get($resolverName);
            if (isset($resolver)) {
                return $resolver;
            }

            throw new \Exception("Unable to find resolver");
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}