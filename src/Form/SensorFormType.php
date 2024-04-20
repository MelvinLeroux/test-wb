<?php 

// src/Form/SensorFormType.php

namespace App\Form;

use App\Entity\Sensor;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SensorFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('type', ChoiceType::class, [
                'label' => 'Sensor Type',
                'choices' => [
                    'Temperature' => 'temperature',
                    'Humidity' => 'humidity',
                    'Pressure' => 'pressure',
                    'none' => ''
                ],
                'required' => false, // Marquer le champ comme non requis

            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Sensor::class,
        ]);
    }
}
