<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class OllamaService
{
    private HttpClientInterface $httpClient;
    private string $ollamaUrl;
    private string $model;

    public function __construct(HttpClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
        $this->ollamaUrl = $_ENV['OLLAMA_API_URL'] ?? 'http://ollama:11434/api';
        $this->model = $_ENV['OLLAMA_MODEL'] ?? 'llama3.2';
    }

    public function clasificarIncidencia(string $descripcion): array
    {
        $response = $this->httpClient->request('POST', $this->ollamaUrl . '/generate', [
            'json' => [
                'model' => $this->model,
                'prompt' => "Clasifica esta incidencia como: 'urgente', 'normal' o 'baja'. 
                            Descripción: {$descripcion}
                            Responde solo con la clasificación.",
                'stream' => false
            ]
        ]);

        return $response->toArray();
    }

    public function generarRespuestaAutomatica(string $incidencia): string
    {
        $response = $this->httpClient->request('POST', $this->ollamaUrl . '/generate', [
            'json' => [
                'model' => $this->model,
                'prompt' => "Genera una respuesta profesional para esta incidencia: {$incidencia}",
                'stream' => false
            ]
        ]);

        $data = $response->toArray();
        return $data['response'] ?? '';
    }
}
