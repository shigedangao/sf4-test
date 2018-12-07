<?php
/**
 * Created by PhpStorm.
 * User: marcintha
 * Date: 03/12/2018
 * Time: 18:34
 */

namespace App\Form\Airliners;

use App\Form\AbstractFormType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class AirlinersFormType
 *
 * @package App\Form\Airliners
 */
class AirlinersFormType extends AbstractFormType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array $opts
     */
    public function buildForm(FormBuilderInterface $builder, array $opts) {
        $builder
            ->add('thrust', NumberType::class)
            ->add('aisle', NumberType::class, array(
                'attr' => array(
                    'min' => 1,
                    'max' => 2
                )
            ))
            ->add('reg', TextType::class)
            ->add('passenger', NumberType::class)
            ->add('owner', TextType::class)
            ->add('cargo', NumberType::class)
            ->add('aircraft', EntityType::class, [
                'class' => 'App\Entity\BaseAircraft',
                'choice_label' => 'id'
            ])
            ->add('save', SubmitType::class);

    }
}