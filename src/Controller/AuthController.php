<?php
/**
 * Created by PhpStorm.
 * User: marcintha
 * Date: 18/12/2018
 * Time: 12:47
 */

namespace App\Controller;


use App\Common\Errors\ErrorInterface;
use App\Doctrine\User\UserSaver;
use App\Form\User\UserFormType;
use App\Repository\User\UserRepository;
use App\Validator\User\UserModel;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AuthController
 *
 * @package App\Controller
 */
class AuthController extends AbstractController
{
    /**
     * @var \App\Repository\User\UserRepository
     */
    protected $repo;

    /**
     * @var \App\Doctrine\User\UserSaver
     */
    protected $saver;

    /**
     * AuthController constructor.
     *
     * @param \App\Repository\User\UserRepository $userRepository
     * @param \App\Doctrine\User\UserSaver $userSaver
     */
    public function __construct(
        UserRepository $userRepository,
        UserSaver $userSaver
    ){
        $this->repo = $userRepository;
        $this->saver = $userSaver;
    }

    /**
     * @Route("/register", name="register", methods={"POST"})
     *
     * @param \Symfony\Component\HttpFoundation\Request $req
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function registerAction(Request $req) {
        $model = new UserModel();

        $form = $this->createForm(UserFormType::class, $model);
        $data = json_decode($req->getContent(), true);
        $form->submit($data);

        if ($form->isSubmitted() && $form->isValid()) {
            $current = $this->repo->findByUsername($model->username);
            if (isset($current)) {
                return new JsonResponse([
                    'error' => ErrorInterface::PRESENT_ERR
                ]);
            }

            $this->saver->create($model);
            $this->saver->save();
        }

        return new JsonResponse([
            'success' => 'insert'
        ]);
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     */
    public function apiAction(Request $request) {

    }
}