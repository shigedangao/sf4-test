<?php
/**
 * Created by PhpStorm.
 * User: marcintha
 * Date: 03/12/2018
 * Time: 14:51
 */

namespace App\Common\Remover;

/**
 * Interface RemoverInterface
 * @package App\Common\Remover
 */
interface RemoverInterface
{
    /**
     * @param $object
     * @return mixed
     */
    public function delete($object);
}