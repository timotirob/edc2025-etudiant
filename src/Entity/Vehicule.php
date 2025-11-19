<?php

declare(strict_types=1);

namespace App\Entity;

use InvalidArgumentException;

class Vehicule
{
    public function __construct(
        private int $id,
        private string $marque,
        private string $modele,
        private int $kilometrage
    ) {
        // Protection intégrité
        if ($kilometrage < 0) {
            throw new InvalidArgumentException("Le kilométrage ne peut pas être négatif.");
        }
    }

    public function getKilometrage(): int
    {
        return $this->kilometrage;
    }
}