<?php

namespace App\Form;

use App\Entity\Employee;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class EmployeeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('prenoms')
            ->add('numero_cin')
            ->add('groupes', ChoiceType::class, [
                'placeholder' => 'Groupe',
                'choices' => [
                    'Chef de chantier' => [
                        'Chef de chantier' => 'Chef de chantier',
                    ],
                    'Manoeuvres' => [
                        'Manoeuvre' => 'Manoeuvre',
                    ],
                    'Ouvriers' => [
                        'Ouvrier' => 'Ouvrier'
                    ],
                    'Aides' => [
                        'Aide' => 'Aide'
                    ]
                ],
                
            ])
            ->add('specialites' ,ChoiceType::class, [
                'placeholder' => 'Spécialité',
                'choices' => [
                    'Ouvriers' => [
                        'Charpentier' => 'Charpentier',
                        'Maçon' => 'Maçon',
                        'Ferailleur' => 'Ferailleur',
                    ],
                ],
                'required' => false
                
            ])
            ->add('monday', CheckboxType::class, [
                'label' => 'Lundi',
                'required' => false,
                'attr' => ['class' => 'align-middle'],
                'value' => false,
            ])
            ->add('tuesday', CheckboxType::class, [
                'label' => 'Mardi',
                'required' => false,
                'attr' => ['class' => 'align-middle'],
                'value' => false,
            ])
            ->add('wednesday', CheckboxType::class, [
                'label' => 'Mercredi',
                'required' => false,
                'attr' => ['class' => 'align-middle'],
                'value' => false,
            ])
            ->add('thursday', CheckboxType::class, [
                'label' => 'Jeudi',
                'required' => false,
                'attr' => ['class' => 'align-middle'],
                'value' => false,
            ])
            ->add('friday', CheckboxType::class, [
                'label' => 'Vendredi',
                'required' => false,
                'attr' => ['class' => 'align-middle'],
                'value' => false,
            ])
            ->add('saturday', CheckboxType::class, [
                'label' => 'Samedi',
                'required' => false,
                'attr' => ['class' => 'align-middle'],
                'value' => false,
            ])
            ->add('code_chantier' ,ChoiceType::class, [
                'placeholder' => 'Code chantier',
                'choices' => [
                    'Code' => [
                        'A' => 'A',
                        'B' => 'B',
                        'C' => 'C',
                    ],
                ],
                'required' => true
                
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Employee::class,
        ]);
    }
}
