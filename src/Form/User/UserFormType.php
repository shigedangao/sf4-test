<?php
/**
 * Created by PhpStorm.
 * User: marcintha
 * Date: 18/12/2018
 * Time: 14:30
 */

namespace App\Form\User;


use App\Form\AbstractFormType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class UserFormType
 *
 * @package App\Form\User
 */
class UserFormType extends AbstractFormType
{
    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class)
            ->add('password', TextType::class)
            ->add('roles', TextType::class, [
                'attr' => [
                    'user' => 'user',
                    'admin' => 'admin'
                ]
            ])
            ->add('save', SubmitType::class);
    }
}