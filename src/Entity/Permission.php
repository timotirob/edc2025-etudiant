<?php

declare(strict_types=1);

namespace App\Entity;

class Permission
{
    public function __construct(
        private readonly string $action,   // ex: select, delete, update
        private readonly string $ressource // ex: Vehicule, Client, Facture
    ) {}

    public function getAction(): string
    {
        return $this->action;
    }

    public function getRessource(): string
    {
        return $this->ressource;
    }
}