<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\DateTimeInterface;
use App\Entity\Oferta;
use App\Entity\Empresa;

class OfertaController extends AbstractController
{
    /**
     * @Route("/", name="ofertas")
     */
    public function index()
    {
        $ofertas = $this->getDoctrine()
        ->getRepository(Oferta::class)
        ->findAll();

        return $this->render('oferta/index.html.twig', [
            'ofertas' => $ofertas,
        ]);
    }

    /**
     * @Route("/{id}", name="oferta")
     */
    public function detalleOferta(int $id)
    {   
        //Oferta
        $oferta = $this->getDoctrine()
        ->getRepository(Oferta::class)
        ->find($id);

        //Empresa
        $empresa = $this->getDoctrine()
        ->getRepository(Empresa::class)
        ->find($oferta->getEmpresa()->getId());

        
        $fecha=date_format($oferta->getDataPub(),'Y-m-d' );
        return $this->render('oferta/detalleOferta.html.twig', [
            'oferta' => $oferta,
            'fecha' => $fecha,
            'empresa' => $empresa
        ]);
    }
}
