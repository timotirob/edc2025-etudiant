<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Utilisateur;
use DateTimeInterface;

class AuditLogger
{
    /**
     * MISSION 2 : Sécuriser la traçabilité en ajoutant l'adresse IP.
     */
    public function logAction(
        Utilisateur $user,
        string $action,
        string $ressource,
        DateTimeInterface $date
    ): void {
        $timestamp = $date->format('Y-m-d H:i:s');

        // Format: [DATE] [IP] USER_ID a fait ACTION sur RESSOURCE
        $logLine = sprintf(
            "[%s] [%s] User:%d -> %s sur %s",
            $timestamp,
            $user->getId(),
            $action,
            $ressource
        );

        // Simulation d'écriture fichier
        // file_put_contents(__DIR__ . '/../../var/security.log', $logLine . PHP_EOL, FILE_APPEND);
        echo "LOG ENREGISTRÉ : " . $logLine . PHP_EOL;
    }
}