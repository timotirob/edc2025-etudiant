<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use App\Entity\Utilisateur;
use App\Entity\Poste;
use App\Entity\Permission;

class UtilisateurTest extends TestCase
{
    private Utilisateur $agentAccueil;
    private Utilisateur $directeur;

    protected function setUp(): void
    {
        // --- Cas 1 : L'Agent d'accueil (Droits limités) ---
        $permsAgent = [
            new Permission('select', 'Vehicule'), // Peut voir les voitures
            new Permission('select', 'Client')    // Peut voir les clients
        ];
        $posteAgent = new Poste("Agent d'accueil", $permsAgent);
        $this->agentAccueil = new Utilisateur(1, "Thomas", "thomas@locauto.fr", $posteAgent);

        // --- Cas 2 : Le Directeur (Tous droits sur Véhicule) ---
        $permsDir = [
            new Permission('select', 'Vehicule'),
            new Permission('delete', 'Vehicule'),
            new Permission('update', 'Vehicule')
        ];
        $posteDir = new Poste("Directeur Agence", $permsDir);
        $this->directeur = new Utilisateur(99, "Mme. Durand", "dir@locauto.fr", $posteDir);
    }

    public function testAgentPeutVoirVehicule(): void
    {
        // Vérifie que l'agent PEUT voir (select)
        $this->assertTrue(
            $this->agentAccueil->aLeDroit('Vehicule', 'select'),
            "ÉCHEC: Un agent d'accueil devrait pouvoir consulter la liste des véhicules."
        );
    }

    public function testAgentNePeutPasSupprimer(): void
    {
        // Vérifie que l'agent NE PEUT PAS supprimer (delete)
        $this->assertFalse(
            $this->agentAccueil->aLeDroit('Vehicule', 'delete'),
            "FAILLE DE SÉCURITÉ: Un agent ne doit JAMAIS pouvoir supprimer un véhicule."
        );
    }

    public function testDirecteurPeutSupprimer(): void
    {
        $this->assertTrue(
            $this->directeur->aLeDroit('Vehicule', 'delete'),
            "ÉCHEC: Le directeur devrait avoir le droit de suppression."
        );
    }

    public function testRessourceInexistante(): void
    {
        $this->assertFalse(
            $this->directeur->aLeDroit('Fusee', 'decoller'),
            "ÉCHEC: Une ressource inconnue ne doit donner aucun droit."
        );
    }
}