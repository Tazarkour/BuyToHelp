<?php

namespace App\Controller;

use App\Entity\Commande;
use App\Entity\Product;
use App\Form\CommandeType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommandeController extends AbstractController
{
    /**
     * @Route("/commande", name="commande")
     */
    public function index(): Response
    {
        return $this->render('commande/index.html.twig', [
            'controller_name' => 'CommandeController',
        ]);
    }
   /* /**
     * @Route("/AddCommande/{id}",name="AddCommande")
     */
   /* public function AddCommande(Request$request ,$id){
        $Commande= new Commande();
        $Qt=$_POST["inputQuantity"];
        $form= $this->createForm(CommandeType::class,$Commande);
        $prod=$this->getDoctrine()->getRepository(Product::class)->find($id);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()   ){
            $Commande->setProduit();
            $Commande->setTotal($prod->getPrix()*$form->get("Qty"));
            $this->getUser()->AddPoints($prod->getPoint()*$form->get("Qty"));
            $em = $this->getDoctrine()->getManager();
            $em->persist($Commande);
            $em->flush();

            $this->addFlash('info','added successfully!');
            return $this->redirectToRoute("reservationlistfront");
        }
        return $this->render("reservation/addfront.html.twig",array("formReservation"=>$form->createView(),"qt"=>$Qt));
    }*/

}
