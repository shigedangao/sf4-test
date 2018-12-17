<?php
/**
 * Created by PhpStorm.
 * User: marcintha
 * Date: 17/12/2018
 * Time: 15:23
 */

namespace App\GraphQL\Mutation\Airliner;

use App\Common\Errors\ErrorInterface;
use App\Doctrine\Airliner\AirlinerRemover;
use App\Doctrine\Airliner\AirlinerSaver;
use App\GraphQL\Mutation\AbstractMutation;
use App\Repository\Airliner\AirlinersRepository;
use App\Repository\AirplaneRepository;
use App\Validator\Airliners\PassengerModel;
use GraphQL\Error\UserError;
use Overblog\GraphQLBundle\Definition\Argument;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\MutationInterface;
use Overblog\GraphQLBundle\Error\UserErrors;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Class AirlinerMutation
 *
 * @package App\GraphQL\Mutation\Airliner
 */
class AirlinerMutation extends AbstractMutation implements MutationInterface, AliasedInterface
{
    /**
     * @var AirlinerSaver
     */
    protected $saver;

    /**
     * @var AirlinersRepository
     */
    protected $repository;

    /**
     * @var AirplaneRepository
     */
    protected $airplaneRepository;

    /**
     * @var AirlinerRemover
     */
    protected $remover;

    /**
     * @var ValidatorInterface
     */
    protected $validator;

    /**
     * AirlinerMutation constructor.
     *
     * @param \App\Doctrine\Airliner\AirlinerSaver $airlinerSaver
     * @param \App\Repository\Airliner\AirlinersRepository $airlinersRepository
     * @param \App\Repository\AirplaneRepository $airplaneRepository
     * @param \App\Doctrine\Airliner\AirlinerRemover $airlinerRemover
     * @param \Symfony\Component\Validator\Validator\ValidatorInterface $validator
     */
    public function __construct(
        AirlinerSaver $airlinerSaver,
        AirlinersRepository $airlinersRepository,
        AirplaneRepository $airplaneRepository,
        AirlinerRemover $airlinerRemover,
        ValidatorInterface $validator
    ) {
        $this->saver = $airlinerSaver;
        $this->repository = $airlinersRepository;
        $this->airplaneRepository = $airplaneRepository;
        $this->remover = $airlinerRemover;
        $this->validator = $validator;
    }

    /**
     * @param \Overblog\GraphQLBundle\Definition\Argument $args
     * @return \App\Entity\Passenger\PassengerAirliners
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

        $object = $this->repository->findByReg($model->getReg());
        if (isset($object)) {
            throw new UserError(ErrorInterface::PRESENT_ERR);
        }

        $airliner = $this->saver->create($model);
        $this->saver->save();

        return $airliner;
    }

    /**
     * @param \Overblog\GraphQLBundle\Definition\Argument $args
     * @return PassengerModel
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

        $airliner = $this->repository->findByReg($model->getReg());
        if (!isset($airliner)) {
            throw new UserError(ErrorInterface::ENTITY_NOT_FOUND_ERR);
        }

        $airliner = $this->saver->create($model);
        $this->saver->update($airliner);

        return $airliner;
    }

    /**
     * @param \Overblog\GraphQLBundle\Definition\Argument $args
     * @return String
     */
    public function delete(Argument $args)
    {
        $input = $this->extract($args, ['id' => null]);
        if (!isset($input)) {
            throw new UserError(ErrorInterface::NOT_FOUND_ERR);
        }

        $airliner = $this->repository->findByReg($input->id);
        if (!isset($airliner)) {
            throw new UserError(ErrorInterface::ENTITY_NOT_FOUND_ERR);
        }

        $this->remover->delete($airliner);

        return $input->id;
    }

    /**
     * @param \Overblog\GraphQLBundle\Definition\Argument $args
     * @return \App\Validator\Airliners\PassengerModel|mixed
     * @throws \ReflectionException
     */
    public function validate(Argument $args)
    {
        $model = new PassengerModel();
        $cls = new \ReflectionClass($model);
        $input = $this->extract($args, $cls->getDefaultProperties());
        if (!isset($input)) {
            throw new UserError(ErrorInterface::EMPTY_INPUT);
        }

        // get the aircraft based on the code
        $aircraft = $this->airplaneRepository->findOneByCode($input->aircraft);
        if (!isset($aircraft)) {
            throw new UserError(sprintf("aircraft with code %s can not be found", $input->aircraft));
        }

        $model->setReg($input->reg);
        $model->setThrust($input->thrust);
        $model->setAisle($input->aisle);
        $model->setCargo($input->cargo);
        $model->setPassenger($input->passenger);
        $model->setOwner($input->owner);
        $model->setAircraft($aircraft);

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
            'mutation'  => 'AirlinerMutation'
        ];
    }
}