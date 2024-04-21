<?php
namespace App\Form;

use App\Entity\Module;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Callback;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

class ModuleFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class)
            ->add('sensors', CollectionType::class, [
                'entry_type' => SensorFormType::class,
                'entry_options' => ['label' => 'false'],
                'allow_add' => true,
                'constraints' => [
                    new Callback([$this, 'validateSensors']),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Module::class,
        ]);
    }

    public function validateSensors($sensors, ExecutionContextInterface $context)
    {
        $sensorTypes = [];
        
        foreach ($sensors as $sensor) {
            $type = $sensor->getType();
            
            // check if the sensor type is already present
            if (in_array($type, $sensorTypes)) {
                // add a violation to the form field 'sensors' if the sensor type is already present
                $context->buildViolation('Same sensor type selected multiple times.')
                    ->atPath('sensors')
                    ->addViolation();
            }
            // store the sensor type in the array to check for duplicates
            $sensorTypes[] = $type;
        }
    }
}