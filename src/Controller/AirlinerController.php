<?php
/**
 * Created by PhpStorm.
 * User: marcintha
 * Date: 06/12/2018
 * Time: 12:20
 */

namespace App\Controller;

use App\Common\Errors\ErrorInterface;
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
     * @var \App\Serializer\GenericNormalizer
     */
    protected $normalizer;

    /**
     * AirlinerController constructor.
     *
     * @param \App\Repository\Airliner\AirlinersRepository $airlinersRepository
     * @param \App\Doctrine\Airliner\AirlinerSaver $saver
     * @param \App\Serializer\GenericNormalizer $normalizer
     */
    public function __construct(
        AirlinersRepository $airlinersRepository,
        AirlinerSaver $saver,
        GenericNormalizer $normalizer
    ){
        $this->repo = $airlinersRepository;
        $this->saver = $saver;
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
        $airlinerModel = new PassengerModel();

        $form = $this->createForm(AirlinersFormType::class, $airlinerModel);
        $data = json_decode($req->getContent(), true);
        $form->submit($data);

        if ($form->isSubmitted() && $form->isValid()) {
            $currentModel = $this->repo->findByReg($airlinerModel->reg);

            if (isset($currentModel)) {
                return new JsonResponse([
                    'error' => ErrorInterface::PRESENT_ERR
                ]);
            }

            $this->saver->create($airlinerModel);
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
}