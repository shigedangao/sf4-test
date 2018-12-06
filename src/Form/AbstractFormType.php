<?php
/**
 * Created by PhpStorm.
 * User: marcintha
 * Date: 06/12/2018
 * Time: 11:17
 */

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class AbstractFormType
 *
 * @package App\Form
 */
abstract class AbstractFormType extends AbstractType
{
    /**
     * @param \Symfony\Component\OptionsResolver\OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'csrf_protection' => false
        ]);
    }
}