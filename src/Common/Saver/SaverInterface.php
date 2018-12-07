<?php
/**
 * Created by PhpStorm.
 * User: marcintha
 * Date: 03/12/2018
 * Time: 14:52
 */

namespace App\Common\Saver;

/**
 * Interface SaverInterface
 * @package App\Common\Saver
 */
interface SaverInterface
{
    /**
     * @return mixed
     */
    public function save();

    /**
     * @param $object
     * @return mixed
     */
    public function create($object);

    /**
     * @param $object
     * @return mixed
     */
    public function update($object);
}