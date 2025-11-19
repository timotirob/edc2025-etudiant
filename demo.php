<?php

// Masquer les warnings deprecated (Laragon/PHP8)
error_reporting(E_ALL & ~E_DEPRECATED);

require __DIR__ . '/vendor/autoload.php';

use App\Entity\Permission;
use App\Entity\Poste;
use App\Entity\Utilisateur;
use App\Service\AuditLogger;
use App\Api\FlotteController;

echo "\n=== DEMO LOCAUTO SECURE (VERSION CORRIGÉE) ===\n";

// 1. Configuration Stagiaire
$permLecture = new Permission('select', 'Vehicule');
$posteStagiaire = new Poste('Stagiaire', [$permLecture]);
$stagiaire = new Utilisateur(42, 'Kevin', 'kevin@locauto.fr', $posteStagiaire);

echo "[INFO] Utilisateur connecté : Kevin (Stagiaire)\n";

// 2. Test du Logger (Mission 2)
echo "\n--- TEST 1 : Logger avec IP ---\n";
$logger = new AuditLogger();
try {
    $logger->logAction($stagiaire, 'delete', 'Vehicule', new DateTime());
    echo "✅ Log OK (IP présente)\n";
} catch (ArgumentCountError $e) {
    echo "❌ ERREUR : Le logger ne gère pas encore l'IP.\n";
}

// 3. Test API Sécurisée (Mission 3)
echo "\n--- TEST 2 : Tentative de suppression par Stagiaire ---\n";
$api = new FlotteController();
$request = ['userId' => 42, 'vehiculeId' => 999];

// On capture la sortie car le controller fait des 'echo'
ob_start();
$api->deleteVehicule($request);
$jsonOutput = ob_get_clean();
echo "Réponse API : " . $jsonOutput . "\n";

if (str_contains($jsonOutput, '"code":403')) {
    echo "✅ SÉCURITÉ OK : L'accès a été refusé (403).\n";
} else {
    echo "❌ ERREUR : Le véhicule a été supprimé !\n";
}

// 4. Test Service Mot de Passe (Mission 6)
echo "\n--- TEST 3 : Qualité Mot de Passe ---\n";
$mdpFaible = "1234";
$mdpFort = "SuperSecret123";



echo "\n=== FIN DE LA DÉMO ===\n";