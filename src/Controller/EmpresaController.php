<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Empresa;
use App\Entity\Oferta;

class EmpresaController extends AbstractController
{
    /**
     * @Route("/empresas", name="empresas")
     */
    public function index()
    {
        $empresas = $this->getDoctrine()
        ->getRepository(Empresa::class)
        ->findAll();
        return $this->render('empresa/index.html.twig', [
            'empresas' => $empresas,
        ]);
    }

    /**
     * @Route("/empresas/{id}", name="empresa")
     */
    public function detalleEmpresa(int $id)
    {
        $empresa = $this->getDoctrine()
        ->getRepository(Empresa::class)
        ->find($id);

        $ofertasDeLaEmpresa=$this->getDoctrine()
        ->getRepository(Oferta::class)
        ->findByEmpresa($id);

        return $this->render('empresa/detalleEmpresa.html.twig', [
            'empresa' => $empresa,
            'ofertas' => $ofertasDeLaEmpresa
        ]);
    }
}
