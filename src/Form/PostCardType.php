<?php

namespace App\Form;

use App\Entity\PostCard;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Category;

class PostCardType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('date')
            ->add('price')
            ->add('description')
            ->add('category', EntityType::class, [
                'label' => 'Catégories',
                'label_attr' => [
                    'class' => 'font-bold'
                ],
                'class' => Category::class,
                'choice_label' => 'city',
                'required' => true,
                'placeholder' => 'Selectionnez une catégorie',
                'attr' => ['data-placeholder' => 'choose a category'],
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PostCard::class,
        ]);
    }
}
