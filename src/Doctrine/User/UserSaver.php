<?php
/**
 * Created by PhpStorm.
 * User: marcintha
 * Date: 18/12/2018
 * Time: 14:11
 */

namespace App\Doctrine\User;


use App\Common\Saver\SaverInterface;
use App\Entity\User\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Class UserSaver
 *
 * @package App\Doctrine\User
 */
class UserSaver implements SaverInterface
{
    /**
     * @var \Doctrine\ORM\EntityManagerInterface
     */
    protected $em;

    /**
     * @var \Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface
     */
    protected $encoder;

    /**
     * @var \App\Entity\User\User
     */
    private $user;

    /**
     * UserSaver constructor.
     *
     * @param \Doctrine\ORM\EntityManagerInterface $em
     * @param \Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface $encoder
     */
    public function __construct(
        EntityManagerInterface $em,
        UserPasswordEncoderInterface $encoder
    ) {
        $this->em = $em;
        $this->encoder = $encoder;
    }

    /**
     * @param $model
     * @return mixed|void
     */
    public function create($model) {
        $this->user = new User($model->username);
        $this->user->setPassword($this->encoder->encodePassword($this->user, $model->password));
        $this->user->setRoles($model->roles);
    }

    /**
     * @return mixed|string
     */
    public function save() {
        try {
            $this->em->persist($this->user);
            $this->em->flush();
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function update($model) {

    }
}