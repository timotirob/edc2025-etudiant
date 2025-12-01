<?php

namespace Entity;

use App\Entity\Vehicule;
use PHPUnit\Framework\TestCase;

class VehiculeTest extends TestCase
{

    public function testVehiculeOK()
    {
        $this->assertTrue((new Vehicule("1", "Dacia", "Logan MCV", 60000))->getKilometrage()===60000);

    }
    public function testVehiculeKO()
    {
        $this->expectException(\InvalidArgumentException::class);
        $unVehiculeKO = new Vehicule("1", "Dacia", "Logan MCV", -50);

    }
}
