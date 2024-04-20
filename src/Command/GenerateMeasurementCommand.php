<?php

namespace App\Command;

use App\Entity\Measurement;
use App\Entity\Module;
use DateTime;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

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

    protected function configure(): void
    {
        $this
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $modules = $this->entityManager->getRepository(Module::class)->findAll();

        foreach ($modules as $module) {
            if (!$module->isStatus()=== true) {
                continue;
            }
            $sensors = $module->getSensors();
            foreach ($sensors as $sensor) {
                $measurement = new Measurement();
                $measurement->setSensor($sensor);
                $measurement->setModule($module);
                
                $createdAt = new DateTimeImmutable();
                $measurement->setCreatedAt($createdAt);
                // Générer des valeurs aléatoires basées sur le type de capteur
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
                
                // Enregistrer la mesure
                $this->entityManager->persist($measurement);
            }
        }

        $this->entityManager->flush();
        $output->writeln('Measurements added successfully.');

        return Command::SUCCESS;
    }
}
