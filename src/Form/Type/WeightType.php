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

class WeightType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $aggregates = $options['aggregates']['weight'] ?? $options['aggregates']['default'];

        $builder
            ->add('min', HiddenType::class, [
                'label' => false,
                'data' => $aggregates['min_weight'],
                'attr' => [
                    'min' => $aggregates['min_weight'],
                    'max' => $aggregates['max_weight']
                ]
            ])
            ->add('max', HiddenType::class, [
                'label' => false,
                'data' => $aggregates['max_weight'],
                'attr' => [
                    'min' => $aggregates['min_weight'],
                    'max' => $aggregates['max_weight']
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'aggregates' => []
        ]);

        $resolver->setAllowedTypes('aggregates', 'array');
        $resolver->setRequired(['aggregates']);
    }
}
