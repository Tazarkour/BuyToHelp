<?php

namespace App\Controller;

use App\Entity\NGO;
use App\Form\NGOType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NGOController extends AbstractController
{
    /**
     * @Route("/ngo", name="ngo")
     */
    public function index(): Response
    {
        return $this->render('ngo/index.html.twig', [
            'controller_name' => 'NGOController',
        ]);
    }
    /**
     * @Route("/AddNGO",name="AddNGO")
     */
    public function AddNGO(Request $request ){
        $NGO= new NGO();
        $form= $this->createForm(NGOType::class,$NGO);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $image= $form['img']->getData();
            try {
                if(!is_dir("images_NGO")){
                    mkdir("images_NGO");
                }
                $filename=$image->getFileName();
                move_uploaded_file($image,"images_NGO/".$image->getFileName());

               // rename("images_products/".$image->getFileName() , "images_products/".$NGO->getNGO().".".$image->getClientOriginalExtension());
                rename("images_NGO/".$image->getFileName() , "images_NGO/".$NGO->getNGO().".".$image->getClientOriginalExtension());

            }
            catch (IOExceptionInterface $e) {
                echo "Erreur Profil existant ou erreur upload image ".$e->getPath();
            }
            $NGO->setImg("images_NGO/".$NGO->getNGO().".".$image->getClientOriginalExtension ());
            $em = $this->getDoctrine()->getManager();
            $em->persist($NGO);
            $em->flush();
            $this->addFlash('info','Added Successfully!');
            return $this->redirectToRoute("products");
        }
        return $this->render("ngo/add.html.twig",array("formNGO"=>$form->createView()));
    }


}
