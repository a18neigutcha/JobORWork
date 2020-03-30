<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManager;
use App\Entity\Oferta;
use App\Entity\Empresa;
use App\Form\OfertaType;

class AdminOfertaController extends AbstractController
{
    /**
     * @Route("/admin/oferta", name="admin")
     */
    public function index()
    {   
        $ofertas = $this->getDoctrine()
        ->getRepository(Oferta::class)
        ->findAllWithEmpresa();

        return $this->render('admin/adminOferta.html.twig', [
            'ofertas' => $ofertas,
        ]);


    }

    /**
     * @Route("/admin/oferta/{id}", name="admin_oferta_modif")
     */
    public function modifOferta(Oferta $oferta, Request $request){

        $manager = $this->getDoctrine()->getManager();

        

        $form=$this->createForm(OfertaType::class, $oferta);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($oferta);
            $manager->flush();
            return $this->redirectToRoute("admin");
        }

        return $this->render('admin/modifOferta.html.twig',
        ["oferta" => $oferta, "form" => $form-> createView()]);

    }
    
    /**
     * @Route("/admin/oferta/elim/{id}", name="admin_oferta_elim")
     */
    public function elimOferta(Oferta $oferta){

        $manager = $this->getDoctrine()->getManager();
        $manager->remove($oferta);
        $manager->flush();


        return $this->redirectToRoute("admin");

    }

    /**
     * @Route("/admin/aniadirOferta", name="admin_oferta_add")
     */

    public function addOferta(Request $request){

        $manager = $this->getDoctrine()->getManager();

        $oferta=new Oferta();

        $form=$this->createForm(OfertaType::class, $oferta);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){

            $manager->persist($oferta->getEmpresa());
            $manager->flush();
            
            $manager->persist($oferta);
            $manager->flush();

            

            return $this->redirectToRoute("admin");
        }


        return $this->render('admin/aniadirOferta.html.twig',
        ["oferta" => $oferta, "form" => $form-> createView()]);

    }

}
