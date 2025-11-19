<?php

declare(strict_types=1);

namespace App\Entity;

class Utilisateur
{
    public function __construct(
        private readonly int $id,
        private string $nom,
        private string $email,
        private Poste $poste
    ) {}

    public function getId(): int
    {
        return $this->id;
    }

    /**
     * MISSION 1 : Vérifie si l'employé a le droit d'effectuer une action sur une ressource.
     * (À faire coder ou corriger par les étudiants)
     */
    public function aLeDroit(string $ressourceVisee, string $actionVisee): bool
    {
        return false;
    }
}