<?php

namespace Entity;

use App\Entity\Permission;
use App\Entity\Poste;
use PHPUnit\Framework\TestCase;

class PosteTest extends TestCase
{

    public function testAddPermission()
    {
        $poste = new Poste("Formateur");
        $perm = new Permission("select", "Vehicule");
        $poste->addPermission($perm);

        $this->assertCount(1, $poste->getPermissions());
        $this->assertSame($poste->getPermissions()[0], $perm);

        $perm2 = new Permission("update", "Vehicule");
        $poste->addPermission($perm2);
        $this->assertCount(2, $poste->getPermissions());


    }
}
