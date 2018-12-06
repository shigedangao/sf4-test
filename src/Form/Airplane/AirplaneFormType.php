<?php
/**
 * Created by PhpStorm.
 * User: marcintha
 * Date: 06/12/2018
 * Time: 11:13
 */

namespace App\Form\Airplane;


use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use App\Form\AbstractFormType;

/**
 * Class AirplaneFormType
 *
 * @package App\Form
 */
class AirplaneFormType extends AbstractFormType
{
    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
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
            ->add('code', TextType::class);
    }
}