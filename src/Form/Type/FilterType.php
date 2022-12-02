<?php

namespace App\Form\Type;

use App\Context\Shared\Application\Bus\Query\QueryBusInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
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
                    'By weight asc' => 'by_weight_asc',
                    'By weight desc' => 'by_weight_desc'
                ]
            ])
            ->add('name', TextType::class, [
                'required' => false
            ])
            ->add('categories', CategoriesType::class, [
                'categories' => $options['categories'],
                'aggregates' => $options['aggregates']
            ])
            ->add('weight', WeightType::class, [
                'aggregates' => $options['aggregates']
            ])
            ->add('submit', SubmitType::class)
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
