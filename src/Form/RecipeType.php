<?php

namespace App\Form;

use App\Entity\Ingredient;
use App\Entity\Recipe;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RecipeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, ['attr' => ['class' => 'form-control']])
            ->add('time', IntegerType::class, ['attr' => ['class' => 'form-control'], 'required' => false])
            ->add('nbPersons', IntegerType::class, ['attr' => ['class' => 'form-control'], 'required' => false])
            ->add('difficulty', RangeType::class, ['attr' => ['class' => 'form-range', 'min' => 1, 'max' => 5], 'required' => false])
            ->add('description', TextareaType::class, ['attr' => ['class' => 'form-control']])
            ->add('price', MoneyType::class, ['attr' => ['class' => 'form-control'], 'required' => false])
            ->add('isFavorite', CheckboxType::class, ['required' => false])
            ->add('ingredients', EntityType::class, [
                'class' => Ingredient::class,
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => true,
                'required' => false
            ])
            ->add('Valider', SubmitType::class, [
                'attr' => ['class' => 'btn btn-primary mt-4']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(['data_class' => Recipe::class]);
    }
}