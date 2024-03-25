<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class RechercheType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('select_prestataire', ChoiceType::class, [
                'label' => 'Prestataire',
                'required' => false,
                'attr' => [
                    'class' => 'form-select select_prestataire',
                ],
            ])
            ->add('select_categorieDeServices', ChoiceType::class, [
                'label' => 'Catégorie de services',
                'required' => false,
                'attr' => [
                    'class' => 'form-select select_categorieDeServices',
                ],
            ])
            ->add('select_ville_CP_region', ChoiceType::class, [
                'label' => 'Ville/CP/Région',
                'required' => false,
                'attr' => [
                    'class' => 'form-select select_ville_CP_region',
                ],
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Recherche',
                'attr' => [
                    'class' => 'button',
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }

}
