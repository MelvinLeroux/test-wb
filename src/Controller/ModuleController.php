<?php

namespace App\Controller;

use App\Entity\Module;
use App\Entity\Sensor;
use App\Form\ModuleFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\MakerBundle\Validator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;


#[Route('/module', name: 'app_module')]
class ModuleController extends AbstractController
{
    #[Route('/list', name: 'app_module_list')]
    public function index(): Response
    {
        return $this->render('module/index.html.twig', [
            'controller_name' => 'ModuleController',
        ]);
    }
    #[Route('/create', name: '_create')]
    public function create(Request $request, EntityManagerInterface $entityManager, ValidatorInterface $validator): Response
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
            return $this->redirectToRoute('app_module_create');
        }


        // Si le formulaire n'est pas valide, récupérer les erreurs et les ajouter aux flashbags
        $errors = $form->getErrors(true);
        foreach ($errors as $error) {
            $this->addFlash('error', $error->getMessage());
        }

    return $this->render('module/index.html.twig', [
        'form' => $form->createView(),
    ]);
    }
}
