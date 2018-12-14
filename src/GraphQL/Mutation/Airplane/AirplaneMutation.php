<?php
/**
 * Created by PhpStorm.
 * User: marcintha
 * Date: 11/12/2018
 * Time: 17:08
 */

namespace App\GraphQL\Mutation\Airplane;


use App\Common\Errors\ErrorInterface;
use App\Doctrine\Airplane\AirplaneSaver;
use App\GraphQL\Mutation\AbstractMutation;
use App\Validator\Aircraft\AircraftModel;
use Overblog\GraphQLBundle\Definition\Argument;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\MutationInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Yaml\Exception\ParseException;

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
     * @var ValidatorInterface
     */
    protected $validator;

    /**
     * AirplaneMutation constructor.
     *
     * @param \App\Doctrine\Airplane\AirplaneSaver $airplaneSaver
     * @param \Symfony\Component\Validator\Validator\ValidatorInterface $validator
     */
    public function __construct(
        AirplaneSaver $airplaneSaver,
        ValidatorInterface $validator
    ) {
        $this->saver = $airplaneSaver;
        $this->validator = $validator;
    }

    /**
     * @param \Overblog\GraphQLBundle\Definition\Argument $args
     * @return mixed
     */
    public function insert(Argument $args)
    {
        try {
            $model = $this->validate($args);
        } catch (\Exception $e) {
            var_dump($e->getMessage());
            die;
            // do soemthing with the error
        }

        $airplane = $this->saver->create($model);
        $this->saver->save();

        return $airplane;
    }

    public function update()
    {
        // TODO: Implement update() method.
    }

    public function delete()
    {
        // TODO: Implement delete() method.
    }

    public function validate(Argument $args)
    {
        $model = new AircraftModel();
        $data = $args->getRawArguments();
        $input = $data['input'];

        if (!isset($input)) {
            throw new ParseException(ErrorInterface::EMPTY_INPUT);
        }

        $model->setName($input['name']);
        $model->setEngines($input['engines']);
        $model->setDistance($input['distance']);
        $model->setType($input['type']);
        $model->setManufacturer($input['manufacturer']);
        $model->setCode($input['code']);

        $errors = $this->validator->validate($model);

        if (count($errors) > 0) {
            throw new \Exception(ErrorInterface::ASSERT_ERR);
        }

        return $model;
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