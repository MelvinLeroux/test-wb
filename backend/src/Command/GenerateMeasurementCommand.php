<?php

namespace App\Command;

use App\Entity\Measurement;
use App\Entity\Module;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:generate-measurement',
    description: 'Generate random measurements for sensors and update them in the database',
)]
class GenerateMeasurementCommand extends Command
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        // function to generate random measurements for every sensors in a module
        $modules = $this->entityManager->getRepository(Module::class)->findAll();
        // Loop through all modules
        foreach ($modules as $module) {
            if (!$module->isStatus()=== true) {
                continue;
            }
            // Get all sensors for the current module
            $sensors = $module->getSensors();
            // Loop through all sensors
            foreach ($sensors as $sensor) {
                $measurement = new Measurement();
                $measurement->setSensor($sensor);
                $measurement->setModule($module);
                
                $createdAt = new DateTimeImmutable();
                $measurement->setCreatedAt($createdAt);
                // Generate random value based on sensor type
                switch ($sensor->getType()) {
                    case 'temperature':
                        $value = rand(-20, 50);
                        break;
                    case 'pressure':
                        $value = rand(950, 1050);
                        break;
                    case 'humidity':
                        $value = rand(0, 100);
                        break;
                    default:
                        $value = 0;
                }
                
                $measurement->setValue($value);
                
                // add measurement
                $this->entityManager->persist($measurement);
            }
        }

        $this->entityManager->flush();
        $output->writeln('Measurements added successfully.');

        return Command::SUCCESS;
    }
}
