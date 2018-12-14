<?php
/**
 * Created by PhpStorm.
 * User: marcintha
 * Date: 03/12/2018
 * Time: 14:51
 */

namespace App\Common\Errors;

/**
 * Interface ErrorInterface
 * @package App\Common\Errors
 */
interface ErrorInterface
{
    public const SAVE_ERR      = "Unable to save data within database";
    public const ASSERT_ERR    = "The payload contains invalid properties";
    public const PRESENT_ERR   = "The data is already present in the database";
    public const INVALID_SLUG  = "The passed slug is empty";
    public const NOT_FOUND_ERR = "The param is not found";
    public const ENTITY_NOT_FOUND_ERR = "The object is not found. Can not update";
    public const EMPTY_INPUT   = "The input data object is empty";
}