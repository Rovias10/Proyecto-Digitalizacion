<?php

namespace App\Controller;

use App\Service\OllamaService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/incidencias')]
class IncidenciaController extends AbstractController
{
    #[Route('/clasificar', methods: ['POST'])]
    public function clasificar(Request $request, OllamaService $ollama): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $descripcion = $data['descripcion'] ?? '';

        if (empty($descripcion)) {
            return $this->json(['error' => 'Descripción requerida'], 400);
        }

        $clasificacion = $ollama->clasificarIncidencia($descripcion);

        return $this->json([
            'descripcion' => $descripcion,
            'clasificacion' => $clasificacion
        ]);
    }
}
