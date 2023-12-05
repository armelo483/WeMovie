<?php

namespace App\Form;

use App\Entity\Genre;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GenreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $defaultGenre = reset($options['data']);

        $builder
            ->add('genre', ChoiceType::class, [
                'choices' => $options['data'],
                'choice_value' => 'name',
                'choice_label' => function (?Genre $genre): string {
                    return $genre ? ucfirst($genre->getName()) : '';
                },
                'choice_attr' => function (?Genre $genre, $key): array {
                    $attrs = ['data-id' => $genre ? $genre->getId() : null];

                    if ($key === 0) {
                        $attrs['checked'] = 'checked';
                    }

                    return $attrs;
                    //return ['data-id' => $genre?->getId()];
                },
                'required' => false,
                'expanded' => true,
                'multiple' => true,
            ]);
        //dd(reset($options['data']));
    }

}