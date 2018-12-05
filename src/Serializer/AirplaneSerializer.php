<?php
/**
 * Created by PhpStorm.
 * User: marcintha
 * Date: 03/12/2018
 * Time: 18:29
 */

namespace App\Serializer;

use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * Class AirplaneSerializer
 * @package App\Serializer
 */
class AirplaneSerializer
{
    /**
     * @var $encoders
     */
    protected $encoders;

    /**
     * @var $normalizers
     */
    protected $normalizers;

    /**
     * @var $serializers
     */
    protected $serializer;

    /**
     * AirplaneSerializer constructor.
     */
    public function __construct()
    {
        $this->encoders    = [new JsonEncoder()];
        $this->normalizers = [new ObjectNormalizer()];
        $this->serializer = new Serializer(
            $this->normalizers,
            $this->encoders
        );
    }


    /**
     * Serialize Object
     *
     * @param $object
     * @return string|NULL
     */
    public function serializeObject($object) {
        if (!isset($object)) {
            return NULL;
        }

        $content = $this->serializer->normalize($object);

        return $content;
    }

    /**
     * Serialize Array
     *
     * @param array $arr
     * @return array
     */
    public function serializeArray($arr = []): array {
        $len = count($arr);
        $jsonArray = array();

        if ($len === 0) {
            return [];
        }

        foreach($arr as $object) {
            $content = $this->serializer->normalize($object);
            array_push($jsonArray, $content);
        }

        return $jsonArray;
    }
}