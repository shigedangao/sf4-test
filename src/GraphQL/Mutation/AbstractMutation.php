<?php
/**
 * Created by PhpStorm.
 * User: marcintha
 * Date: 11/12/2018
 * Time: 17:44
 */

namespace App\GraphQL\Mutation;

use App\Common\Errors\GraphQLErrorInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class AbstractMutation
 *
 * @package App\GraphQL\Mutation
 */
abstract class AbstractMutation
{
    /**
     * @var string
     */
    private const BASE_MUTATION_NAMESPACE = "App\GraphQL\Mutation\{folder}\{cls}";

    /**
     * @var \Symfony\Component\DependencyInjection\ContainerInterface
     */
    private $container;

    /**
     * AbstractMutation constructor.
     *
     * @param \Symfony\Component\DependencyInjection\ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @param string $name
     * @return mixed|string
     */
    private function getMutaterNamespace(string $name) {
        $namespace = self::BASE_MUTATION_NAMESPACE;
        $namespace = str_replace("{folder}", $name, $namespace);
        $namespace = str_replace("{cls}", $name, $namespace);

        return $namespace;
    }

    /**
     * @param string $ns
     * @return object
     * @throws \Exception
     */
    public function getMutationByName(string $ns) {
        if (!isset($ns)) {
            throw new \Exception(GraphQLErrorInterface::EMPTY_NS);
        }

        $namespace = $this->getMutaterNamespace($ns);
        try {
            $mutater = $this->container->get($namespace);
            if (isset($mutater)) {
                return $mutater;
            }

            throw new \Exception(GraphQLErrorInterface::MUTATION_NOT_FOUND);
        } catch (\Exception $e) {
            throw $e;
        }
    }
}