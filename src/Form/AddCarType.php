<?php

namespace App\Form;

use App\Entity\Car;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddCarType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', null, [
                'label' => 'Nom de la voiture',
            ])
            ->add('description', null, [
                'label' => 'Description',
            ])
            ->add('daily_price', null, [
                'label' => 'Prix journalier',
            ])
            ->add('monthly_price', null, [
                'label' => 'Prix mensuel',
            ])
            ->add('transmission', ChoiceType::class, [
                'choices' => [
                    'Manuelle' => 0,
                    'Automatique' => 1,
                ],
                'label' => 'Transmission',

            ])
            ->add('capacity',ChoiceType::class, [
                'choices' => [
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '5',
                    '6' => '6',
                    '7' => '7',
                    '8' => '8',
                    '9' => '9',
                ],
                'label' => 'Capacité',
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Ajouter',
                'attr' => ['class' => 'btn-add'],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Car::class,
        ]);
    }
}
