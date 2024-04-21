<?php

namespace App\Command;

use App\Entity\Module;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:generate-module-status',
    description: 'Generate random status for modules and update them in the database',
)]
class GenerateModuleStatusCommand extends Command
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        parent::__construct();
    }

    protected function configure(): void
    {
        $this->setDescription('Generate random status for modules and update them in the database');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        // function to generate random status for every module
        $modules = $this->entityManager->getRepository(Module::class)->findAll();
        // Loop through all modules
        foreach ($modules as $module) {
            $status = random_int(0, 1);
            $module->setStatus($status);
            // if status is 0, set stoppedAt to current date and time
            if ($status === 0) {
                $stoppedAt = new DateTimeImmutable();
                $module->setStoppedAt($stoppedAt);
            } else {
                // if status is 1, set startedAt to current date and time and stoppedAt to null
                $module->setStoppedAt(null);
                $module->setStartedAt(new DateTimeImmutable());
            }
            // if status is 1 and startedAt is null, set startedAt to current date and time
            if ($module->getStartedAt() === null) {
                $startedAt = new DateTimeImmutable();
                $module->setStartedAt($startedAt);
            }
            // Persistez et appliquez les modifications
            $this->entityManager->persist($module);
        }

        $this->entityManager->flush();
        $output->writeln('Module statuses updated successfully.');

        return Command::SUCCESS;
    }
}
