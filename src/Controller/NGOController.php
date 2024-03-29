<?php

namespace App\Controller;

use App\Entity\Commande;
use App\Entity\NGO;
use App\Entity\Product;
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
        $NGOS= $this->getDoctrine()->
        getRepository(NGO::class)->findAll();
        return $this->render("ngo/index.html.twig",
            array('ngo'=>$NGOS));
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
    /**
     * @Route("/NGO_item/{id}",name="NGO_item")
     */
    public function NGO_singe(Request $request,$id)
    {
        $NGO = $this->getDoctrine()->
        getRepository(NGO::class)->find($id);
        $products = $this->getDoctrine()->getRepository(Product::class)->get_products_by_ngo($NGO);
        $T=0;
        foreach ($products as $j) {
            $commandes = $j->getCommandes();
            foreach ($commandes as $i) {
                $T = $i->getTotal()+$T;
        }
        }
        return $this->render("NGO/Single.html.twig",
            array('item' => $NGO,'total'=>$T));
    }


}
