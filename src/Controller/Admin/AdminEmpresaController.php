<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManager;
use App\Entity\Empresa;
use App\Form\EmpresaType;

class AdminEmpresaController extends AbstractController
{
    /**
     * @Route("/admin/empresa", name="admin_empresa")
     */
    public function index()
    {

        $empresas = $this->getDoctrine()
        ->getRepository(Empresa::class)
        ->findAll();
        return $this->render('admin/admin_empresa/index.html.twig', [
            'empresas' => $empresas,
        ]);
    }


    /**
     * @Route("/admin/empresa/aniadirEmpresa", name="admin_empresa_add")
     */

    public function addEmpresa(Request $request){

        $manager = $this->getDoctrine()->getManager();

        $empresa=new Empresa();

        $form=$this->createForm(EmpresaType::class, $empresa);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){

            $manager->persist($empresa);
            $manager->flush();

            

            return $this->redirectToRoute("admin_empresa");
        }


        return $this->render('admin/admin_empresa/aniadirEmpresa.html.twig',
        ["empresa"=>$empresa, "form" => $form-> createView()]);

    }


    /**
     * @Route("/admin/empresa/elim/{id}", name="admin_empresa_elim")
     */
    public function elimEmpresa(Empresa $empresa){

        $manager = $this->getDoctrine()->getManager();
        $manager->remove($empresa);
        $manager->flush();


        return $this->redirectToRoute("admin_empresa");

    }

    /**
     * @Route("/admin/empresa/{id}", name="admin_empresa_modif")
     */
    public function modifEmpresa(Empresa $empresa, Request $request){

        $manager = $this->getDoctrine()->getManager();

        

        $form=$this->createForm(EmpresaType::class, $empresa);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($empresa);
            $manager->flush();
            return $this->redirectToRoute("admin_empresa");
        }

        return $this->render('admin/admin_empresa/modifEmpresa.html.twig',
        ["empresa" => $empresa, "form" => $form-> createView()]);

    }


}
