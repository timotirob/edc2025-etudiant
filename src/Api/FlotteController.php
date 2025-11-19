<?php

declare(strict_types=1);

namespace App\Api;

class FlotteController
{
    private SecurityDatabase $db;

    public function __construct()
    {
        $this->db = new SecurityDatabase();
    }

    /**
     * Envoie la réponse JSON et gère le code HTTP proprement
     */
    private function jsonResponse(int $code, mixed $data = null): void
    {
        // CORRECTIF IMPORTANT :
        // On ne tente de changer le code HTTP que si aucun affichage n'a eu lieu avant.
        // Cela empêche le warning "headers already sent" lors de l'exécution du script demo.php
        if (!headers_sent()) {
            http_response_code($code);
        }

        echo json_encode(['code' => $code, 'payload' => $data]);
    }

    /**
     * MISSION 3 : Sécuriser la suppression d'un véhicule.
     * Endpoint: DELETE /vehicule
     */
    public function deleteVehicule(array $requestData): void
    {
        // 1. Validation des entrées
        if (!isset($requestData['userId']) || !isset($requestData['vehiculeId'])) {
            $this->jsonResponse(400, 'Données manquantes');
            return;
        }

        $userId = (int)$requestData['userId'];
        $vehiculeId = (int)$requestData['vehiculeId'];

        // --- ZONE À COMPLÉTER PAR L'ÉTUDIANT (Début) ---


        // --- ZONE À COMPLÉTER PAR L'ÉTUDIANT (Fin) ---

        // 2. Action réelle si autorisé
        $result = $this->db->executerDelete('Vehicule', $vehiculeId);
        $this->jsonResponse(204, $result);
    }
}