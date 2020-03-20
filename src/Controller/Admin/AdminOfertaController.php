<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Oferta;

class AdminOfertaController extends AbstractController
{
    /**
     * @Route("/admin/oferta", name="admin")
     */
    public function index()
    {   
        $ofertas = $this->getDoctrine()
        ->getRepository(Oferta::class)
        ->findAll();
        return $this->render('admin/adminOferta.html.twig', [
            'ofertas' => $ofertas,
        ]);
    }
}
