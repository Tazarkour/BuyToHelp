<?php

namespace App\Controller;

use App\Entity\NGO;
use App\Entity\Product;
use App\Form\NGOType;
use App\Form\ProductType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductsController extends AbstractController
{
    /**
     * @Route("/products", name="products")
     */
    public function index(): Response
    {
        $Products= $this->getDoctrine()->
        getRepository(Product::class)->findAll();
        return $this->render("products/index.html.twig",
            array('products'=>$Products));
    }

    /**
     * @Route("/AddProduct",name="AddProduct")
     */
    public function AddNGO(Request $request ){
        $Product= new Product();
        $form= $this->createForm(ProductType::class,$Product);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $image= $form['img']->getData();
            try {
                if(!is_dir("images_Products")){
                    mkdir("images_Products");
                }
                $filename=$image->getFileName();
                move_uploaded_file($image,"images_Products/".$image->getFileName());

                // rename("images_products/".$image->getFileName() , "images_products/".$NGO->getNGO().".".$image->getClientOriginalExtension());
                rename("images_Products/".$image->getFileName() , "images_Products/".$Product->getName().".".$image->getClientOriginalExtension());

            }
            catch (IOExceptionInterface $e) {
                echo "Erreur Profil existant ou erreur upload image ".$e->getPath();
            }
            $Product->setImg("images_Products/".$Product->getName().".".$image->getClientOriginalExtension ());
            $em = $this->getDoctrine()->getManager();
            $em->persist($Product);
            $em->flush();
            $this->addFlash('info','Added Successfully!');
            return $this->redirectToRoute("products");
        }
        return $this->render("products/add.html.twig",array("formProduct"=>$form->createView()));
    }
    /**
     * @Route("/product/{id}",name="Item_Product")
     */
    public function productsingle(Request $request,$id)
    {
        $Products = $this->getDoctrine()->
        getRepository(Product::class)->find($id);
        return $this->render("products/Single.html.twig",
            array('item' => $Products));
    }
}
