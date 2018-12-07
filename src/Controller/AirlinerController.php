<?php
/**
 * Created by PhpStorm.
 * User: marcintha
 * Date: 06/12/2018
 * Time: 12:20
 */

namespace App\Controller;

use App\Common\Errors\ErrorInterface;
use App\Doctrine\Airliner\AirlinerRemover;
use App\Doctrine\Airliner\AirlinerSaver;
use App\Form\Airliners\AirlinersFormType;
use App\Repository\Airliner\AirlinersRepository;
use App\Serializer\GenericNormalizer;
use App\Validator\Airliners\PassengerModel;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class AirlinerController
 *
 * @package App\Controller
 */
class AirlinerController extends AbstractController
{

    /**
     * @var $repo AirlinersRepository
     */
    protected $repo;

    /**
     * @var \App\Doctrine\Airliner\AirlinerSaver
     */
    protected $saver;

    /**
     * @var \App\Doctrine\Airliner\AirlinerRemover
     */
    protected $remover;

    /**
     * @var \App\Serializer\GenericNormalizer
     */
    protected $normalizer;

    /**
     * AirlinerController constructor.
     *
     * @param \App\Repository\Airliner\AirlinersRepository $airlinersRepository
     * @param \App\Doctrine\Airliner\AirlinerSaver $saver
     * @param \App\Doctrine\Airliner\AirlinerRemover
     * @param \App\Serializer\GenericNormalizer $normalizer
     */
    public function __construct(
        AirlinersRepository $airlinersRepository,
        AirlinerSaver $saver,
        AirlinerRemover $remover,
        GenericNormalizer $normalizer
    ){
        $this->repo = $airlinersRepository;
        $this->saver = $saver;
        $this->remover = $remover;
        $this->normalizer = $normalizer;
    }

    /**
     * @Route("/airliner/", name="airliner", methods={"GET"})
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function indexAction() {
        $airliners = $this->repo->findAll();
        $response  = $this->normalizer->normalizeArray($airliners);

        return new JsonResponse([
            'data' => $response
        ]);
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $req
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     *
     * @Route("/airliner/add", name="add_airliner", methods={"POST"})
     */
    public function addAction(Request $req) {
        $model = new PassengerModel();

        $form = $this->createForm(AirlinersFormType::class, $model);
        $data = json_decode($req->getContent(), true);
        $form->submit($data);

        if ($form->isSubmitted() && $form->isValid()) {
            $currentModel = $this->repo->findByReg($model->reg);

            if (isset($currentModel)) {
                return new JsonResponse([
                    'error' => ErrorInterface::PRESENT_ERR
                ]);
            }

            $this->saver->create($model);
            $err = $this->saver->save();

            if (isset($err)) {
                return new JsonResponse([
                    'error' => $err
                ]);
            }
        }

        return new JsonResponse([
            'success' => 'insert'
        ]);
    }

    /**
     * @Route("/airliner/update/{reg}", name="update_airliner", methods={"PUT"})
     *
     * @param \Symfony\Component\HttpFoundation\Request $req
     * @param string $reg
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function updateAction(Request $req, string $reg) {
        if (!isset($reg)) {
            return new JsonResponse([
                'error' => ErrorInterface::NOT_FOUND_ERR
            ]);
        }

        $airliner = $this->repo->findByReg($reg);
        if (!isset($airliner)) {
            return new JsonResponse([
                'error' => ErrorInterface::ENTITY_NOT_FOUND_ERR
            ]);
        }

        // create a new model
        $model = new PassengerModel();

        // form
        $form = $this->createForm(AirlinersFormType::class, $model);
        $data = json_decode($req->getContent(), true);
        $form->submit($data);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->saver->create($model);
            $this->saver->update($airliner);

            return new JsonResponse([
                'data' => 'success'
            ]);
        }

        return new JsonResponse([
            'error' => ErrorInterface::ASSERT_ERR
        ]);
    }

    /**
     * @Route("/airliner/delete/{reg}", name="delete_airliner", methods={"DELETE"})
     *
     * @param string $reg
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function deleteAction(string $reg) {
        if (!isset($reg)) {
            return new JsonResponse([
                'error' => ErrorInterface::NOT_FOUND_ERR
            ]);
        }

        $airliner = $this->repo->findByReg($reg);
        if (isset($airliner)) {
            $this->remover->delete($airliner);

            return new JsonResponse([
                'data' => 'success'
            ]);
        }

        return new JsonResponse([
            'error' => ErrorInterface::ENTITY_NOT_FOUND_ERR
        ]);
    }
}