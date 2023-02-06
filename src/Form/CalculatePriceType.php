<?php

namespace App\Form;

use App\DTO\CalculatePriceDTO;
use App\Entity\Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Regex;

class CalculatePriceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $taxTooltip = 'Tax number must be in format DEXXXXXXXXX for Germans, ITXXXXXXXXXXX for Italians, GRXXXXXXXX for Greeks';
        $builder
            ->add('product', EntityType::class, [
                'class' => Product::class,
                'label' => 'Выберите продукт',
                'choice_label' => 'name',
                'placeholder' => 'Выберите продукт',
                'attr' => [
                    'class' => 'form-select mb-2',
                ],
                'required' => true,
            ])
            ->add('taxNumber', TextType::class, [
                'required' => true,
                'label' => 'введите Tax номер',
                'attr' => [
                    'class' => 'form-control  mb-2',
                    'data-bs-toggle' => 'tooltip',
                    'data-bs-placement' => 'top',
                    'data-bs-title' => $taxTooltip,

                ],
                'constraints' => [
                    new Length(['min' => 11, 'max' => 13]),
                    new Regex([
                        'pattern' => '/((^DE\d{9}$)|(^IT\d{11}$)|(^GR\d{9}$))/',
                        'message' => $taxTooltip
                    ])
                ]
            ]);
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(['data_class' => CalculatePriceDTO::class]);
    }
}
