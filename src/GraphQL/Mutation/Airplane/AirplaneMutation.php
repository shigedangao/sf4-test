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
use GraphQL\Error\UserError;
use Overblog\GraphQLBundle\Definition\Argument;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\MutationInterface;
use Overblog\GraphQLBundle\Error\UserErrors;
use Symfony\Component\Validator\Validator\ValidatorInterface;

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
            throw new UserErrors([
                ErrorInterface::ASSERT_ERR,
                sprintf("Error: %s", $e->getTraceAsString())
            ]);
        }

        $object = $this->repository->findOneByCode($model->getCode());
        if (isset($object)) {
            throw new UserError(ErrorInterface::PRESENT_ERR);
        }

        $airplane = $this->saver->create($model);
        $this->saver->save();

        return $airplane;
    }

    /**
     * @param \Overblog\GraphQLBundle\Definition\Argument $args
     * @return \App\Entity\BaseAircraft
     */
    public function update(Argument $args)
    {
        try {
            $model = $this->validate($args);
        } catch (\Exception $e) {
            throw new UserErrors([
                ErrorInterface::ASSERT_ERR,
                sprintf("Error: %s", $e->getTraceAsString())
            ]);
        }

        $airplane = $this->repository->findOneByCode($model->getCode());
        if (!isset($airplane)) {
            throw new UserError(ErrorInterface::ENTITY_NOT_FOUND_ERR);
        }

        $updatedAircraft = $this->saver->create($model);
        $this->saver->update($airplane);

        return $updatedAircraft;
    }

    /**
     * @param \Overblog\GraphQLBundle\Definition\Argument $args
     * @return mixed|null
     */
    public function delete(Argument $args)
    {
        $input = $this->extract($args, ['id' => null]);
        if (!isset($input)) {
            throw new UserError(ErrorInterface::NOT_FOUND_ERR);
        }

        $airplane = $this->repository->findOneByCode($input->id);
        if (!isset($airplane)) {
            throw new UserError(ErrorInterface::ENTITY_NOT_FOUND_ERR);
        }

        $this->remover->delete($airplane);

        return $input->id;
    }

    /**
     * @param \Overblog\GraphQLBundle\Definition\Argument $args
     * @return \App\Validator\Aircraft\AircraftModel|mixed
     * @throws \Exception
     */
    public function validate(Argument $args)
    {
        $model = new AircraftModel();
        $cls = new \ReflectionClass($model);
        $input = $this->extract($args, $cls->getDefaultProperties());
        if (!isset($input)) {
            throw new UserError(ErrorInterface::EMPTY_INPUT);
        }

        $model->setName($input->name);
        $model->setEngines($input->engines);
        $model->setDistance($input->distance);
        $model->setType($input->type);
        $model->setManufacturer($input->manufacturer);
        $model->setCode($input->code);

        $errors = $this->validator->validate($model);

        if (count($errors) > 0) {
            throw new UserError(ErrorInterface::ASSERT_ERR);
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