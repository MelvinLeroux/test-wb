<?php

namespace App\Controller\Api;

use App\Entity\Module;
use App\Entity\Sensor;
use App\Repository\MeasurementRepository;
use App\Repository\ModuleRepository;
use App\Repository\SensorRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class ModuleApiController extends AbstractController
{
    #[Route('/api/modules', name: 'api_modules', methods: ['GET'])]
    #[IsGranted('ROLE_USER')]
    public function index(ModuleRepository $moduleRepository, Request $request): JsonResponse
    {
        $page = max(1, (int) $request->query->get('page', 1));
        $limit = max(1, (int) $request->query->get('limit', 6));
        $offset = ($page - 1) * $limit;

        $modules = $moduleRepository->findBy([], null, $limit, $offset);
        $total = $moduleRepository->count([]);

        $data = array_map(function ($module) {
            return [
                'id' => $module->getId(),
                'name' => $module->getName(),
                'status' => $module->isStatus(),
                'sensors' => array_map(fn ($sensor) => $sensor->getType(), $module->getSensors()->toArray()),
            ];
        }, $modules);

        return $this->json([
            'data' => $data,
            'page' => $page,
            'limit' => $limit,
            'total' => $total,
            'pages' => ceil($total / $limit),
        ]);
    }

    #[Route('/api/modules', name: 'api_module_create', methods: ['POST'])]
    #[IsGranted('ROLE_USER')]
    public function create(Request $request, EntityManagerInterface $em): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        if (!isset($data['name'])) {
            return $this->json(['error' => 'Le nom du module est requis'], 400);
        }

        $module = new Module();
        $module->setName($data['name']);

        if (isset($data['sensors']) && is_array($data['sensors'])) {
            foreach ($data['sensors'] as $sensorType) {
                $sensor = new Sensor();
                $sensor->setType($sensorType);
                $module->addSensor($sensor);
            }
        }

        $em->persist($module);
        $em->flush();

        return $this->json([
            'id' => $module->getId(),
            'name' => $module->getName(),
            'status' => $module->isStatus(),
            'sensors' => array_map(fn ($sensor) => $sensor->getType(), $module->getSensors()->toArray()),
        ], 201);
    }

    #[Route('/api/modules/{id}', name: 'api_module_show', methods: ['GET'], requirements: ['id' => '\d+'])]
    public function show(
        Module $module,
        SensorRepository $sensorRepository,
        MeasurementRepository $measurementRepository,
    ): JsonResponse {
        $sensors = $sensorRepository->findAllByModuleId($module->getId());
        $measurements = $measurementRepository->findLast12hByModuleId($module->getId());

        $sensorTypes = array_map(fn ($sensor) => $sensor->getType(), $sensors);

        $measurementData = array_map(fn ($measurement) => [
            'id' => $measurement->getId(),
            'value' => $measurement->getValue(),
            'createdAt' => $measurement->getCreatedAt()->format(\DateTimeInterface::ATOM),
            'sensor' => $measurement->getSensor()->getType(),
        ], $measurements);

        $moduleData = [
            'id' => $module->getId(),
            'name' => $module->getName(),
            'status' => $module->isStatus(),
            'startedAt' => $module->getStartedAt()?->format(\DateTimeInterface::ATOM),
            'stoppedAt' => $module->getStoppedAt()?->format(\DateTimeInterface::ATOM),
            'sensors' => $sensorTypes,
            'measurements' => $measurementData,
        ];

        return $this->json($moduleData);
    }

    #[Route('/api/modules/{id}', name: 'api_module_update', methods: ['PUT'], requirements: ['id' => '\d+'])]
    #[IsGranted('ROLE_USER')]
    public function update(
        int $id,
        Request $request,
        ModuleRepository $moduleRepository,
        EntityManagerInterface $em,
    ): JsonResponse {
        $data = json_decode($request->getContent(), true);
        $module = $moduleRepository->find($id);
        if (!isset($data) || !isset($data['name'])) {
            return $this->json(['error' => 'Erreur dans la request reçue'], 422);
        }
        if (!$module) {
            return $this->json(['error' => 'Le module nexiste pas'], 404);
        }
        $module->setName($data['name']);
        $em->persist($module);
        $em->flush();

        return $this->json(['success' => 'Le module a bien été update'], 200);
    }

    #[Route('api/modules/{id}', name: 'api-module_delete', methods: ['DELETE'], requirements: ['id' => '\d+'])]
    #[IsGranted('ROLE_ADMIN')]
    public function delete(
        int $id,
        ModuleRepository $moduleRepository,
        EntityManagerInterface $em,
    ): JsonResponse {
        $module = $moduleRepository->find($id);
        if (!$module) {
            return $this->json(['error' => 'Le module nexiste pas'], 404);
        }
        $em->remove($module);
        $em->flush();

        return $this->json(['success' => 'Le module a bien été supprimé'], 200);
    }
}
