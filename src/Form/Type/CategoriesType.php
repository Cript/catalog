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

class CategoriesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('categories', ChoiceType::class, [
                'choices' => $this->categoryChoices(
                    $options['categories'],
                    $options['aggregates']['categories'] ?? $options['aggregates']['default']
                ),
                'multiple' => true,
                'expanded' => true,
                'attr' => array(
                    'class' => 'filter-categories'
                )
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

    private function categoryChoices(array $categories, array $aggregates): array
    {
        $choices = [];

        foreach ($categories as $category) {
            $name = sprintf(
                '%s',
                $category['name']
            );

            $choices[$name] = $category['id'];
        }

        return $choices;
    }
}
