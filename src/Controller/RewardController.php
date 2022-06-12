<?php

namespace App\Controller;

use App\Entity\Product;
use App\Entity\Rewards;
use App\Form\ProductType;
use App\Form\RewardType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RewardController extends AbstractController
{
    /**
     * @Route("/rewards", name="rewards")
     */
    public function index(): Response
    {
        $Rewards= $this->getDoctrine()->
        getRepository(Rewards::class)->findAll();
        return $this->render("reward/index.html.twig",
            array('Rewards'=>$Rewards));
    }
    /**
     * @Route("/AddReward",name="AddReward")
     */
    public function AddReward(Request $request ){
        $reward= new Rewards();
        $form= $this->createForm(RewardType::class,$reward);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $image= $form['img']->getData();
            try {
                if(!is_dir("images_rewards")){
                    mkdir("images_rewards");
                }
                $filename=$image->getFileName();
                move_uploaded_file($image,"images_rewards/".$image->getFileName());

                // rename("images_products/".$image->getFileName() , "images_products/".$NGO->getNGO().".".$image->getClientOriginalExtension());
                rename("images_rewards/".$image->getFileName() , "images_rewards/".$reward->getName().".".$image->getClientOriginalExtension());

            }
            catch (IOExceptionInterface $e) {
                echo "Erreur Profil existant ou erreur upload image ".$e->getPath();
            }
            $reward->setImg("images_rewards/".$reward->getName().".".$image->getClientOriginalExtension ());
            $em = $this->getDoctrine()->getManager();
            $em->persist($reward);
            $em->flush();
            $this->addFlash('info','Added Successfully!');
            return $this->redirectToRoute("rewards");
        }
        return $this->render("reward/add.html.twig",array("formReward"=>$form->createView()));
    }
    /**
     * @Route("/reward/{id}",name="Item_Reward")
     */
    public function Item_Reward(Request $request,$id)
    {
        if (!$this->getUser())
            $this->redirectToRoute("rewards");
        $Products = $this->getDoctrine()->
        getRepository(Rewards::class)->find($id);
        return $this->render("reward/Single.html.twig",
            array('item' => $Products));
    }
}
