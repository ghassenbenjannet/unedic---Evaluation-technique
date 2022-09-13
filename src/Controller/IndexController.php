<?php
namespace App\Controller;
use App\Entity\Produit;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class IndexController extends AbstractController
{
 /**
 *@Route("/",name="produit_list")
 */
public function home()

{
    
    $produits= $this->getDoctrine()->getRepository(Produit::class)->findAll();
    return $this->render('produits/index.html.twig',array('produits'=> $produits));
}

/**
 *@Route("/bycategories")
 */
public function bycategories()

{
    
    $produits= $this->getDoctrine()->getRepository(Produit::class)->findAll();
    return $this->render('produits/bycategory.html.twig',array('produits'=> $produits));
}


/**
 *@Route("/smartphone")
 */
public function smartphone()

{
    
    $produits= $this->getDoctrine()->getRepository(Produit::class)->findAll();
    return $this->render('produits/smartphone.html.twig',array('produits'=> $produits));
}

/**
 *@Route("/tablette")
 */
public function tablette()

{

    $produits= $this->getDoctrine()->getRepository(Produit::class)->findAll();
    return $this->render('produits/tablette.html.twig',array('produits'=> $produits));
}


/**
 *@Route("/ordinateur")
 */
public function ordinateur()

{
    
    $produits= $this->getDoctrine()->getRepository(Produit::class)->findAll();
    return $this->render('produits/ordinateur.html.twig',array('produits'=> $produits));
}

 /**
 * @Route("/produit/new", name="new_produit")
 * Method({"GET", "POST"})
 */
public function new(Request $request) {
    $produit = new Produit();
    $form = $this->createFormBuilder($produit)
    ->add('nom', TextType::class)
    ->add('qte', TextType::class, array('label' => 'Quantité'),)
    ->add('cat',  ChoiceType::class, array('choices'  => ['Smartphone' => 'Smartphone', 'Tablette' => 'Tablette','Ordinateur' => 'Ordinateur', ],'label' => 'Catégorie'))
    ->add('prix', TextType::class)
    ->add('save', SubmitType::class, array('label' => 'Créer'))->getForm();
   

    $form->handleRequest($request);
   
    if($form->isSubmitted() && $form->isValid()) {
        $produit = $form->getData();
    
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($produit);
        $entityManager->flush();
    
            return $this->redirectToRoute('produit_list');
    }
        return $this->render('produits/new.html.twig',['form' => $form->createView()]);
    }


    /**
     * @Route("/produit/{id}", name="produit_show")
     */
    public function show($id) {
        $produit = $this->getDoctrine()->getRepository(Produit::class)->find($id);
        return $this->render('produits/show.html.twig',array('produit' => $produit));
    }


    /**
 * @Route("/produit/edit/{id}", name="edit_produit")
 * Method({"GET", "POST"})
 */
 public function edit(Request $request, $id) {
    $produit = new Produit();
    $produit = $this->getDoctrine()->getRepository(Produit::class)->find($id);
   
    $form = $this->createFormBuilder($produit)
    ->add('nom', TextType::class)
    ->add('qte', TextType::class, array('label' => 'Quantité'),)
    ->add('cat',  ChoiceType::class, array('choices'  => ['Smartphone' => 'Smartphone', 'Tablette' => 'Tablette','Ordinateur' => 'Ordinateur', ],'label' => 'Catégorie'))
    ->add('prix', TextType::class)
    ->add('Modifier', SubmitType::class, array('label' => 'Modifier'))->getForm();
   
    $form->handleRequest($request);
    if($form->isSubmitted() && $form->isValid()) {
   
    $entityManager = $this->getDoctrine()->getManager();
    $entityManager->flush();
   
    return $this->redirectToRoute('produit_list');
    }

    return $this->render('produits/edit.html.twig', ['form' => $form->createView()]);

 }

  /**
     * @Route("/produit/delete/{id}",name="delete_produit")
     * @Method({"DELETE"})
    */
public function delete(Request $request, $id) {
    $produit = $this->getDoctrine()->getRepository(Produit::class)->find($id);
   
    $entityManager = $this->getDoctrine()->getManager();
    $entityManager->remove($produit);
    $entityManager->flush();
   
    $response = new Response();
    $response->send();
    return $this->redirectToRoute('produit_list');
    }
     
    //By Ghassen

}