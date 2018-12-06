<?php
/**
 * Created by PhpStorm.
 * User: marcintha
 * Date: 03/12/2018
 * Time: 14:55
 */

namespace App\Doctrine\Airplane;

use App\Common\Remover\RemoverInterface;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class AirplaneRemover
 * @package App\Doctrine
 */
class AirplaneRemover implements RemoverInterface
{

    /**
     * @var EntityManagerInterface
     */
    protected $em;

    /**
     * AirplaneRemover constructor.
     *
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * Delete
     *
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