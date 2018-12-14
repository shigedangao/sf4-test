<?php
/**
 * Created by PhpStorm.
 * User: marcintha
 * Date: 11/12/2018
 * Time: 17:08
 */

namespace App\GraphQL\Mutation\Airplane;


use App\Common\Errors\ErrorInterface;
use App\Doctrine\Airplane\AirplaneRemover;
use App\Doctrine\Airplane\AirplaneSaver;
use App\GraphQL\Mutation\AbstractMutation;
use App\Repository\AirplaneRepository;
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
     * @var AirplaneRepository
     */
    protected $repository;

    /**
     * @var ValidatorInterface
     */
    protected $validator;

    /**
     * @var \App\Doctrine\Airplane\AirplaneRemover
     */
    protected $remover;

    /**
     * AirplaneMutation constructor.
     *
     * @param \App\Doctrine\Airplane\AirplaneSaver $airplaneSaver
     * @param \App\Repository\AirplaneRepository $airplaneRepository
     * @param \App\Doctrine\Airplane\AirplaneRemover $airplaneRemover
     * @param \Symfony\Component\Validator\Validator\ValidatorInterface $validator
     */
    public function __construct(
        AirplaneSaver $airplaneSaver,
        AirplaneRepository $airplaneRepository,
        AirplaneRemover $airplaneRemover,
        ValidatorInterface $validator
    ) {
        $this->saver = $airplaneSaver;
        $this->repository = $airplaneRepository;
        $this->remover = $airplaneRemover;
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
            // do something with the error
        }

        $object = $this->repository->findOneByCode($model->getCode());
        if (isset($object)) {
            // should return that the data is already present...
            return NULL;
        }

        $airplane = $this->saver->create($model);
        $this->saver->save();

        return $airplane;
    }

    /**
     * @param \Overblog\GraphQLBundle\Definition\Argument $args
     * @return \App\Entity\BaseAircraft|mixed|null|void
     */
    public function update(Argument $args)
    {
        try {
            $model = $this->validate($args);
        } catch (\Exception $e) {
            // should do something here
            return NULL;
        }

        $airplane = $this->repository->findOneByCode($model->getCode());
        if (!isset($airplane)) {
            return NULL;
        }

        $updatedAircraft = $this->saver->create($model);
        $this->saver->update($airplane);

        return $updatedAircraft;
    }

    /**
     * @TODO add an extractor method and handle error
     * @param \Overblog\GraphQLBundle\Definition\Argument $args
     * @return mixed|null
     */
    public function delete(Argument $args)
    {
       $data = $args->getRawArguments();
       $input = $data['input'];
       $code = $input['id'];

       if (!isset($code)) {
           var_dump("laaaa");
           return NULL;
       }

       $airplane = $this->repository->findOneByCode($code);
       if (!isset($airplane)) {
           return NULL;
       }

       $this->remover->delete($airplane);

       return $code;
    }

    /**
     * @param \Overblog\GraphQLBundle\Definition\Argument $args
     * @return \App\Validator\Aircraft\AircraftModel|mixed
     * @throws \Exception
     */
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