<?php

namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FilterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->setMethod('GET')
            ->add('sort_by', ChoiceType::class, [
                'choices' => [
                    'Default' => 'default',
                    'By weight asc' => 'weight_asc',
                    'By weight desc' => 'weight_desc'
                ]
            ])
            ->add('name', TextType::class, [
                'required' => false
            ])
            ->add('categories', CategoriesType::class, [
                'label' => false,
                'categories' => $options['categories'],
                'aggregates' => $options['aggregates']
            ])
            ->add('weight', WeightType::class, [
                'aggregates' => $options['aggregates']
            ])
            ->add('submit', SubmitType::class, [
                'row_attr' => [
                    'class' => 'filter-submit',
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'categories' => [],
            'aggregates' => []
        ]);

        $resolver->setAllowedTypes('categories', 'array');
        $resolver->setAllowedTypes('aggregates', 'array');
        $resolver->setRequired(['categories', 'aggregates']);
    }
}
