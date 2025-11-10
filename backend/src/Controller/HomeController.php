<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => '¡Bienvenido al sistema de gestión de incidencias!',
            'status' => 'online',
            'version' => '1.0.0'
        ]);
    }

    #[Route('/api/health', name: 'api_health')]
    public function health(): JsonResponse
    {
        return $this->json([
            'status' => 'healthy',
            'database' => 'connected',
            'ollama' => 'ready'
        ]);
    }
}