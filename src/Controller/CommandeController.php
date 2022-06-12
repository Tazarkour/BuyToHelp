<?php

namespace App\Controller;

use App\Entity\Commande;
use App\Entity\Product;
use App\Form\CommandeType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommandeController extends AbstractController
{
    /**
     * @Route("/commande", name="commande")
     */
    public function index(): Response
    {
        return $this->render('commande/commande.html.twig', [
            'controller_name' => 'CommandeController',
        ]);
    }
    /**
     * @Route("/", name="home")
     */
    public function home(): Response
    {
        return $this->render('index.html.twig');
    }
     /**
     * @Route("/AddCommande/{id}",name="AddCommande")
     */
   public function AddCommande(Request $request ,$id){
       if (!$this->getUser())
           $this->redirectToRoute("products");
        $Commande= new Commande();
        $form= $this->createForm(CommandeType::class,$Commande);
        $prod=$this->getDoctrine()->getRepository(Product::class)->find($id);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()   ){
            $date = new \DateTime('@'.strtotime('now'));
            $Commande->setProduit($prod);
            $Commande->setTotal($prod->getPrice()*$form->get("Qty")->getData());
            $Commande->setDate($date);
            $Commande->setIsVerif(false);
            $Commande->setUser($this->getUser());
            $this->getUser()->AddPoints($prod->getPoint()*$form->get("Qty")->getData());
            $em = $this->getDoctrine()->getManager();
            $em->persist($Commande);
            $em->flush();
            return $this->redirectToRoute("products");
        }
       $Qt=$_POST["inputQuantity"];
       $form->get('Qty')->setData($Qt);
        return $this->render("commande/commande.html.twig",array("formCommande"=>$form->createView(),"qt"=>$Qt,"prod"=>$prod));
    }

}
