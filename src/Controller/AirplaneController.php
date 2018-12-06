<?php
/**
 * Created by PhpStorm.
 * User: marcintha
 * Date: 03/12/2018
 * Time: 14:53
 */

namespace App\Controller;

use App\Form\Airplane\AirplaneFormType;
use App\Validator\Aircraft\AircraftModel;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Common\Errors\ErrorInterface;
use App\Doctrine\AirlinerSaver;
use App\Doctrine\AirlinerRemover;
use App\Serializer\AirplaneSerializer;
use App\Repository\AirplaneRepository;

/**
 * Class AirplaneController
 * @package App\Controller
 */
class AirplaneController extends AbstractController
{
    /**
     * @var
     */
    protected $saver;

    /**
     * @var
     */
    protected $remover;

    /**
     * @var
     */
    protected $repo;

    /**
     * @var
     */
    protected $serializer;

    /**
     * AirplaneController constructor.
     *
     * @param AirlinerSaver $saver
     * @param AirlinerRemover $remover
     * @param AirplaneRepository $repo
     * @param AirplaneSerializer $serializer
     */
    public function __construct(
        AirlinerSaver $saver,
        AirlinerRemover $remover,
        AirplaneRepository $repo,
        AirplaneSerializer $serializer
    ){
        $this->saver = $saver;
        $this->remover = $remover;
        $this->repo  = $repo;
        $this->serializer = $serializer;
    }


    /**
     * @Route("/airplane/", name="aircraft", methods={"GET"})
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function indexAction() {
        $planes = $this->repo->findAllOrderByCode();
        $response = $this->serializer->serializeArray($planes);

        return new JsonResponse([
            'data' => $response
        ]);
    }

    /**
     * @Route("/airplane/{code}", name="get_aircraft_by_id", methods={"GET"})
     *
     * @param string $code
     * @return JsonResponse
     */
    public function getAircraftByCode(string $code) {
        if (!isset($code)) {
            return new JsonResponse([
                'error' => ErrorInterface::INVALID_SLUG
            ]);
        }

        $plane = $this->repo->findOneByCode($code);
        $content = $this->serializer->serializeObject($plane);

        return new JsonResponse([
            'data' => $content
        ]);
    }

    /**
     * @Route("/airplane/add", name="add_aircraft", methods={"POST"})
     *
     * @param Request $req
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function addAction(Request $req) {
        // Create an instance of the model
        $aircraftModel = new AircraftModel();

        $form = $this->createForm(AirplaneFormType::class, $aircraftModel);
        $data = json_decode($req->getContent(), true);
        $form->submit($data);

        if ($form->isSubmitted() && $form->isValid()) {
            $object = $this->repo->findOneByCode($aircraftModel->reg);

            if (isset($object)) {
                return new JsonResponse([
                    'error' => ErrorInterface::PRESENT_ERR
                ]);
            }

            $this->saver->create($aircraftModel);
            $err = $this->saver->save();
            if (isset($err)) {
                return new JsonResponse([
                    'error' => $err
                ]);
            }

            return new JsonResponse([
                'success' => 'insert'
            ]);
        }

        return new JsonResponse([
            'error' => ErrorInterface::ASSERT_ERR
        ]);
    }

    /**
     * @Route("/airplane/update/{code}", name="update_aircraft", methods={"PUT"})
     *
     * @param Request $req
     * @param string $code
     * @return JsonResponse
     */
    public function updateAction(Request $req, string $code) {
        if (!isset($code)) {
            return new JsonResponse([
                'error' => ErrorInterface::NOT_FOUND_ERR
            ]);
        }

        $planeInDb = $this->repo->findOneByCode($code);
        if (!isset($planeInDb)) {
            return new JsonResponse([
                'error' => ErrorInterface::ENTITY_NOT_FOUND_ERR
            ]);
        }

        // Create a new model
        $airliners = new AircraftModel();

        // Form handler
        $form = $this->createForm(AirplaneFormType::class, $airliners);
        $data = json_decode($req->getContent(), true);
        $form->submit($data);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->saver->create($airliners);
            $this->saver->update($planeInDb);

            return new JsonResponse([
                'data' => 'success'
            ]);
        }

        return new JsonResponse([
            'error' => ErrorInterface::ASSERT_ERR
        ]);
    }

    /**
     * @Route("/airplane/{code}", name="delete_aircraft", methods={"DELETE"})
     *
     * @param string $code
     * @return JsonResponse
     */
    public function deleteAction(string $code) {
        if (!isset($code)) {
            return new JsonResponse([
                'error' => ErrorInterface::NOT_FOUND_ERR
            ]);
        }

        $plane = $this->repo->findOneByCode($code);
        if (isset($plane)) {
            $this->remover->delete($plane);

            return new JsonResponse([
                'data' => 'success'
            ]);
        }

        return new JsonResponse([
            'error' => ErrorInterface::ENTITY_NOT_FOUND_ERR
        ]);
    }
}