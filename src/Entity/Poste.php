<?php

declare(strict_types=1);

namespace App\Entity;

class Poste
{
    /**
     * @param Permission[] $permissions
     */
    public function __construct(
        private readonly string $intitule, // ex: "Agent d'accueil"
        private array $permissions = []
    ) {}

    /**
     * @return Permission[]
     */
    public function getPermissions(): array
    {
        return $this->permissions;
    }

    public function addPermission(Permission $perm): void
    {
        $this->permissions[] = $perm;
    }
}