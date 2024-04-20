<?php

namespace App\Controller;

use App\Entity\Module;
use App\Entity\Sensor;
use App\Form\ModuleFormType;
use App\Repository\MeasurementRepository;
use App\Repository\ModuleRepository;
use App\Repository\SensorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;

#[Route('/module', name: 'app_module')]
class ModuleController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/list', name: '_list')]
    public function index(): Response
    {
        $modules = $this->entityManager->getRepository(Module::class)->findAll();
        return $this->render('module/index.html.twig', [
            'modules' => $modules
        ]);
    }

    #[Route('/{id}', name: '_show', methods: ['GET'], requirements: ['id' => '\d+'])]
    public function show(Module $module, ModuleRepository $moduleRepository, SensorRepository $sensorRepository, MeasurementRepository $measurementRepository ): Response
{
    // Utilisez la méthode findWithDatas pour récupérer les données étendues du module
    $measurements = $measurementRepository->findAllByModuleId($module->getId());
    $sensors = $sensorRepository->findAllByModuleId($module->getId());

    return $this->render('module/show.html.twig', [
        'module' => $module,
        'sensors' => $sensors,
        'measurements' => $measurements
    ]);
}
    #[Route('/create', name: '_create', methods: ['GET','POST'])]
    public function create(Request $request, EntityManagerInterface $entityManager): Response
    { 
        $module = new Module();

        // Créer des capteurs avec des types définis
        $sensor1 = new Sensor();
        $sensor1->setType('temperature');
        $sensor2 = new Sensor();
        $sensor2->setType('humidity');
        $sensor3 = new Sensor();
        $sensor3->setType('pressure');

        // Ajouter les capteurs au module
        $module->addSensor($sensor1);
        $module->addSensor($sensor2);
        $module->addSensor($sensor3);

        // Créer le formulaire pour le module
        $form = $this->createForm(ModuleFormType::class, $module);
        $form->handleRequest($request);

        // Traiter le formulaire soumis
        if ($form->isSubmitted() && $form->isValid()) {
            // Supprimer les capteurs avec un type null ou vide
            foreach ($module->getSensors() as $key => $sensor) {
                $type = $sensor->getType();
                if ($type === 'null' || $type === '') {
                    // Supprimer le capteur de la base de données
                    $module->removeSensor($sensor);
                    $entityManager->remove($sensor);
                } else {
                    // Lier le capteur au module s'il a un type défini
                    $module->addSensor($sensor);
                }
            }
        
            // Persister le module
            $entityManager->persist($module);
            $entityManager->flush();
        
            // Rediriger ou afficher un message de réussite
            $this->addFlash('success', 'Module created successfully!');
            return $this->redirectToRoute('app_module_list');
        }


        // Si le formulaire n'est pas valide, récupérer les erreurs et les ajouter aux flashbags
        $errors = $form->getErrors(true);
        foreach ($errors as $error) {
            $this->addFlash('error', $error->getMessage());
        }

        return $this->render('module/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
