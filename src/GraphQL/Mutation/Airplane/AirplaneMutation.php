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
use App\GraphQL\Mutation\AbstractMutation;
use Overblog\GraphQLBundle\Definition\Argument;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\MutationInterface;

/**
 * Class AirplaneMutation
 *
 * @package App\GraphQL\Mutation\Airplane
 */
class AirplaneMutation extends AbstractMutation implements MutationInterface, AliasedInterface
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
     * @return array
     */
    public static function getAliases()
    {
        return [
            'mutation' => 'AirplaneMutation'
        ];
    }

    public function insert()
    {
        // TODO: Implement insert() method.
    }

    public function update()
    {
        // TODO: Implement update() method.
    }

    public function delete()
    {
        // TODO: Implement delete() method.
    }

}