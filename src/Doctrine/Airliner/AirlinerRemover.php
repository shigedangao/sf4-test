<?php
/**
 * Created by PhpStorm.
 * User: marcintha
 * Date: 07/12/2018
 * Time: 12:51
 */

namespace App\Doctrine\Airliner;


use App\Common\Remover\RemoverInterface;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class AirlinerRemover
 *
 * @package App\Doctrine\AirlinerResolver
 */
class AirlinerRemover implements RemoverInterface
{

    /**
     * @var $em \Doctrine\ORM\EntityManagerInterface
     */
    protected $em;

    /**
     * AirlinerRemover constructor.
     *
     * @param \Doctrine\ORM\EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
    }

    /**
     * @param $object
     * @return mixed|void
     */
    public function delete($object)
    {
        if (!isset($object)) {
            return;
        }

        $this->em->remove($object);
        $this->em->flush();
    }

}