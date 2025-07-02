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
        // create 3 modules
        for ($i = 1; $i <= 10; $i++) {
            $module = new Module();
            $module->setName('Module ' . $i);
            if ($i === 1) {
                $module->setStatus(0); // Ce module sera arrêté
                $module->setStoppedAt(new DateTimeImmutable());
            } else {
                $module->setStatus(1); // Les autres sont actifs
                $module->setStartedAt(new DateTimeImmutable());
            }
            $module->setCreatedAt(new DateTimeImmutable());
            $manager->persist($module);
            $this->addReference('module_' . $i, $module);
        }

        // create 3 sensors for each module
        $sensorData = [
            ['type' => 'temperature'],
            ['type' => 'humidity'],
            ['type' => 'pressure'],
            ['type' => 'motion speed']
        ];

        for ($i = 1; $i <= 10; $i++) {
            foreach ($sensorData as $data) {
                $sensor = new Sensor();
                $sensor->setType($data['type']);
                $sensor->setModule($this->getReference('module_' . $i));
                $manager->persist($sensor);
                $this->addReference($data['type'] . '_sensor_' . $i, $sensor);
            }
        }

        // create measurements for each sensor
        for ($i = 1; $i <= 10; $i++) {
            $module = $this->getReference('module_' . $i);
            $sensors = [
                $this->getReference('temperature_sensor_' . $i),
                $this->getReference('humidity_sensor_' . $i),
                $this->getReference('pressure_sensor_' . $i),
                $this->getReference('motion speed_sensor_' . $i)
            ];
            foreach ($sensors as $sensor) {
                $createdAt = new DateTimeImmutable();
                for ($j = 0; $j < 100; $j++) {
                    $measurement = new Measurement();
                    $measurement->setModule($module);
                    $measurement->setSensor($sensor);
                    $measurement->setCreatedAt($createdAt);
            
                    switch ($sensor->getType()) {
                        case 'temperature':
                            // generate random temperature between -20 and 50
                            $temperature = mt_rand(-2000, 5000) / 100;
                            $measurement->setValue($temperature);
                            break;
                        case 'humidity':
                            // generate random humidity between 0 and 100
                            $humidity = mt_rand(0, 100);
                            $measurement->setValue($humidity);
                            break;
                        case 'pressure':
                            // generate random pressure between 950 and 1050
                            $pressure = mt_rand(950, 1050);
                            $measurement->setValue($pressure);
                            break;
                        case 'motion speed':
                            $motionspeed = mt_rand(0,300);
                            $measurement->setValue($motionspeed);
                            break;
                    }
            
                    $manager->persist($measurement);
                    
                    // create a new measurement every 5 minutes
                    $createdAt = $createdAt->add(new DateInterval('PT5M'));
                }
            }
        }
        $manager->flush();
    }
}

