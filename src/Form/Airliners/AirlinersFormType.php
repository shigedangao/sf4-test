<?php
/**
 * Created by PhpStorm.
 * User: marcintha
 * Date: 03/12/2018
 * Time: 18:34
 */

namespace App\Form\Airliners;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class AirlinersFormType extends AbstractType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array $opts
     */
    public function buildForm(FormBuilderInterface $builder, array $opts) {
        $builder
            ->add('name', TextType::class)
            ->add('engines', NumberType::class, array(
                'attr' => array(
                    'min' => 2,
                    'max' => 6
                )
            ))
            ->add('distance', NumberType::class)
            ->add('reg', TextType::class)
            ->add('manufacturer', ChoiceType::class, array(
                'choices' => array(
                    'Boeing' => "Boeing",
                    'Airbus' => "Airbus",
                    'Bombardier' => "Bombardier",
                    'Embraer' => "Embraer",
                    "Comac" => "Comac",
                    "Fokker" => "Fokker"
                )
            ))
            ->add('type', ChoiceType::class, array(
                'choices' => array(
                    'Long haul' => "Long",
                    'Medium haul' => "Medium",
                    'Short haul' => "Short"
                )
            ))
            ->add('thrust', NumberType::class)
            ->add('passenger', NumberType::class)
            ->add('cargo', NumberType::class)
            ->add('aisle', NumberType::class, array(
                'attr' => array(
                    'min' => 1,
                    'max' => 2
                )
            ))
            ->add('save', SubmitType::class);

    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'csrf_protection' => false
        ]);
    }


}