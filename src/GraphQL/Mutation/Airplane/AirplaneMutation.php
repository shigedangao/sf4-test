<?php
/**
 * Created by PhpStorm.
 * User: marcintha
 * Date: 11/12/2018
 * Time: 17:08
 */

namespace App\GraphQL\Mutation\Airplane;


use App\Common\GraphQL\Mutate;
use App\Doctrine\Airliner\AirlinerSaver;
use Overblog\GraphQLBundle\Definition\Argument;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\MutationInterface;

/**
 * Class AirplaneMutation
 *
 * @package App\GraphQL\Mutation\Airplane
 */
class AirplaneMutation implements MutationInterface, AliasedInterface, Mutate
{
    /**
     * @var \App\Doctrine\Airliner\AirlinerSaver
     */
    protected $saver;

    /**
     * AirplaneMutation constructor.
     *
     * @param \App\Doctrine\Airliner\AirlinerSaver $airlinerSaver
     */
    public function __construct(AirlinerSaver $airlinerSaver)
    {
        $this->saver = $airlinerSaver;
    }

    /**
     * @param \Overblog\GraphQLBundle\Definition\Argument $args
     * @return mixed|void
     */
    public function mutate(Argument $args) {
        var_dump("pass into saver");
        die;
    }

    /**
     * @return array
     */
    public static function getAliases()
    {
        return [
            'mutation' => 'AirplaneMutation'
        ];
    }
}