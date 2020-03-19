<?php

namespace App\DataFixtures;

use App\Entity\Empresa;
use App\Entity\Oferta;
use App\Entity\Candidato;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {


        for($i=0;$i<5;$i++){

            $empresa=new Empresa();
            $empresa->setLogo("./url_de_test/test.svg");
            $empresa->setTipo("Informatica");
            $empresa->setCorreo("empresa".$i."@test.com");
            $empresa->setNombre("empresa".$i);

            $manager->persist($empresa);


            $oferta=new Oferta();
            $oferta->setDescripcion("Oferta de prueba");
            $oferta->setDataPub(new \DateTime());
            $oferta->setTitulo("OfertaTest");
            $oferta->setEmpresa($empresa);

            $manager->persist($oferta);


            $candidato=new Candidato();
            $candidato->setNombre("CandidatoNom".$i);
            $candidato->setApellidos("CandidatoApp".$i);
            $candidato->setTelefono("602623070");
            $candidato->setEstudios("TecnicoInformatico");
            $candidato->setOferta($oferta);

            $manager->persist($candidato);
        }


        $manager->flush();
    }
}
