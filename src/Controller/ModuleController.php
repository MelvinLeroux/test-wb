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

#[Route('', name: 'app_module')]
class ModuleController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('', name: '_list')]
    public function index(): Response
    {
        $modules = $this->entityManager->getRepository(Module::class)->findAll();
        return $this->render('module/index.html.twig', [
            'modules' => $modules
        ]);
    }

    #[Route('/{id}', name: '_show', methods: ['GET'], requirements: ['id' => '\d+'])]
    public function show(Module $module, SensorRepository $sensorRepository, MeasurementRepository $measurementRepository ): Response
{
    // get all measurements and sensors for the current module
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
        // Create 3 sensors for the module
        $sensor1 = new Sensor();
        $sensor1->setType('temperature');
        $sensor2 = new Sensor();
        $sensor2->setType('humidity');
        $sensor3 = new Sensor();
        $sensor3->setType('pressure');

        // Add sensors to the module
        $module->addSensor($sensor1);
        $module->addSensor($sensor2);
        $module->addSensor($sensor3);

        $form = $this->createForm(ModuleFormType::class, $module);
        $form->handleRequest($request);

        // Traiter le formulaire soumis
        if ($form->isSubmitted() && $form->isValid()) {
            foreach ($module->getSensors() as $key => $sensor) {
                $type = $sensor->getType();
                // delete sensors with type null or empty
                if ($type === 'null' || $type === '') {
                    $module->removeSensor($sensor);
                    $entityManager->remove($sensor);
                } else {
                    $module->addSensor($sensor);
                }
            }
            $entityManager->persist($module);
            $entityManager->flush();
            $this->addFlash('success', 'Module created successfully!');
        
            return $this->redirectToRoute('app_module_list');
        }


        // if form is not valid, display error messages
        $errors = $form->getErrors(true);
        foreach ($errors as $error) {
            $this->addFlash('error', $error->getMessage());
        }

        return $this->render('module/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
