<?php

namespace App\Entity;

use App\Repository\IncidenciaRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: IncidenciaRepository::class)]
class Incidencia
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $digitalizacion = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDigitalizacion(): ?string
    {
        return $this->digitalizacion;
    }

    public function setDigitalizacion(string $digitalizacion): static
    {
        $this->digitalizacion = $digitalizacion;

        return $this;
    }
}
