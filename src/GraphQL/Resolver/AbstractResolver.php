<?php
/**
 * Created by PhpStorm.
 * User: marcintha
 * Date: 07/12/2018
 * Time: 17:23
 */

namespace App\GraphQL\Resolver;


use App\GraphQL\Resolver\Airliner\AirlinersResolver;
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
     * @return null
     */
    public function getContainerByName(string $name) {
        if (!isset($name)) {
            return NULL;
        }

        // @TODO pass name or maybe use a list that will return a resolver...
        $resolver = $this->container->get(AirlinersResolver::class);
        return $resolver;
    }
}