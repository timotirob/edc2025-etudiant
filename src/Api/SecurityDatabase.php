<?php

declare(strict_types=1);

namespace App\Api;

class SecurityDatabase
{
    /**
     * Simule une requête SQL de vérification des droits.
     * Dans la réalité, on ferait : SELECT * FROM droits WHERE user_id = ...
     */
    public function verifierAutorisation(int $userId, string $action, string $table): bool
    {
        // RÈGLE MÉTIER SIMULÉE :
        // Seul l'utilisateur ID 99 (Directeur) a le droit de suppression (DELETE).
        // Tout autre utilisateur (ex: Stagiaire ID 42, Agent ID 1) sera rejeté.

        if ($action === 'delete' && $userId !== 99) {
            return false;
        }

        return true;
    }

    public function executerDelete(string $table, int $idObj): array
    {
        return ['status' => 'success', 'deleted_id' => $idObj];
    }
}