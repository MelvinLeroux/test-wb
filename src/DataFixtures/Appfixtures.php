<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Module;
use App\Entity\Sensor;
use App\Entity\Measurement;
use DateInterval;
use DateTimeImmutable;

class Appfixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i <= 3; $i++) {
            $module = new Module();
            $module->setName('Module ' . $i);
            $module->setStatus(1);
            $module->setCreatedAt(new DateTimeImmutable());
            $manager->persist($module);
            $this->addReference('module_' . $i, $module);
        }

        // Création des capteurs
        $sensorData = [
            ['type' => 'temperature'],
            ['type' => 'humidity'],
            ['type' => 'pressure'],
        ];

        for ($i = 1; $i <= 3; $i++) {
            foreach ($sensorData as $data) {
                $sensor = new Sensor();
                $sensor->setType($data['type']);
                $sensor->setModules($this->getReference('module_' . $i));
                $manager->persist($sensor);
                $this->addReference($data['type'] . '_sensor_' . $i, $sensor);
            }
        }

        // Création des mesures
        for ($i = 1; $i <= 3; $i++) {
            /** @var Module $module */
            $module = $this->getReference('module_' . $i);
            $sensors = [
                $this->getReference('temperature_sensor_' . $i),
                $this->getReference('humidity_sensor_' . $i),
                $this->getReference('pressure_sensor_' . $i),
            ];// $product = new Product();
        // $manager->persist($product);
            // ...
            foreach ($sensors as $sensor) {
                $createdAt = new DateTimeImmutable();
                for ($j = 0; $j < 100; $j++) {
                    $measurement = new Measurement();
                    $measurement->setModule($module);
                    $measurement->setSensor($sensor);
                    $measurement->setCreatedAt($createdAt);
            
                    switch ($sensor->getType()) {
                        case 'temperature':
                            // Générer une température aléatoire entre -20 et 50
                            $temperature = mt_rand(-2000, 5000) / 100;
                            $measurement->setValue($temperature);
                            break;
                        case 'humidity':
                            // Générer une humidité aléatoire entre 0 et 100
                            $humidity = mt_rand(0, 100);
                            $measurement->setValue($humidity);
                            break;
                        case 'pressure':
                            // Générer une pression aléatoire entre 950 et 1050
                            $pressure = mt_rand(950, 1050);
                            $measurement->setValue($pressure);
                            break;
                    }
            
                    $manager->persist($measurement);
                    
                    // Créer un nouvel objet DateTimeImmutable pour ajouter 5 minutes pour la prochaine mesure
                    $createdAt = $createdAt->add(new DateInterval('PT5M'));
                }
            }
        }
        $manager->flush();
        }
}

