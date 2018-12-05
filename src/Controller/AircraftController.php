<?php
/**
 * Created by PhpStorm.
 * User: marcintha
 * Date: 03/12/2018
 * Time: 14:53
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Common\Errors\ErrorInterface;
use App\Doctrine\AirlinerSaver;
use App\Doctrine\AirlinerRemover;
use App\Repository\AirlinersRepository;
use App\Serializer\AirplaneSerializer;
use App\Validator\Airliners\AirlinersModel;
use App\Form\Airliners\AirlinersFormType;

/**
 * Class AircraftController
 * @package App\Controller
 */
class AircraftController extends AbstractController
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
     * AircraftController constructor.
     *
     * @param AirlinerSaver $saver
     * @param AirlinerRemover $remover
     * @param AirlinersRepository $repo
     * @param AirplaneSerializer $serializer
     */
    public function __construct(
        AirlinerSaver $saver,
        AirlinerRemover $remover,
        AirlinersRepository $repo,
        AirplaneSerializer $serializer
    ){
        $this->saver = $saver;
        $this->remover = $remover;
        $this->repo  = $repo;
        $this->serializer = $serializer;
    }


    /**
     * @Route("/aircraft/", name="aircraft", methods={"GET"})
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function indexAction() {
        $planes = $this->repo->findAllOrderedByName();
        $response = $this->serializer->serializeArray($planes);

        return new JsonResponse([
            'data' => $response
        ]);
    }

    /**
     * @Route("/aircraft/{reg}", name="get_aircraft_by_id", methods={"GET"})
     *
     * @param string $reg
     * @return JsonResponse
     */
    public function getAirplaneByRegAction(string $reg) {
        if (!isset($reg)) {
            return new JsonResponse([
                'error' => ErrorInterface::INVALID_SLUG
            ]);
        }

        $plane = $this->repo->findByReg($reg);
        $content = $this->serializer->serializeObject($plane);

        return new JsonResponse([
            'data' => $content
        ]);
    }

    /**
     * @Route("/aircraft/add", name="add_aircraft", methods={"POST"})
     *
     * @param Request $req
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function addAction(Request $req) {
        // Create an instance of the model
        $airlinersModel = new AirlinersModel();

        $form = $this->createForm(AirlinersFormType::class, $airlinersModel);
        $data = json_decode($req->getContent(), true);
        $form->submit($data);

        if ($form->isSubmitted() && $form->isValid()) {
            $current = $this->repo->findByReg($airlinersModel->reg);
            $size = count($current);

            if ($size) {
                return new JsonResponse([
                    'error' => ErrorInterface::PRESENT_ERR
                ]);
            }

            $this->saver->create($airlinersModel);
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
     * @Route("/aircraft/update/{reg}", name="update_aircraft", methods={"PUT"})
     *
     * @param Request $req
     * @param string $reg
     * @return JsonResponse
     */
    public function updateAction(Request $req, string $reg) {
        if (!isset($reg)) {
            return new JsonResponse([
                'error' => ErrorInterface::NOT_FOUND_ERR
            ]);
        }

        $planeInDb = $this->repo->findByReg($reg);
        if (!isset($planeInDb)) {
            return new JsonResponse([
                'error' => ErrorInterface::ENTITY_NOT_FOUND_ERR
            ]);
        }

        // Create a new model
        $airliners = new AirlinersModel();

        // Form handler
        $form = $this->createForm(AirlinersFormType::class, $airliners);
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
     * @Route("/aircraft/{reg}", name="delete_aircraft", methods={"DELETE"})
     *
     * @param string $reg
     * @return JsonResponse
     */
    public function deleteAction(string $reg) {
        if (!isset($reg)) {
            return new JsonResponse([
                'error' => ErrorInterface::NOT_FOUND_ERR
            ]);
        }

        $plane = $this->repo->findByReg($reg);
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