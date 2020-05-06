<?php


namespace App\Controller;


use App\Entity\Produits;
use App\Form\ProduitsType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Serializer\SerializerInterface;

class ProduitsController extends AbstractController
{
    /**
     * @Route("/", name="produits_list")
     */
    public function list()
    {
        $produits = $this->getDoctrine()->getRepository(Produits::class)->findAll();

        return $this->render('produit/list.html.twig', [
            'produits' => $produits
        ]);
    }

    /**
     * @Route("/produit/add", name="produit_add")
     */
    public function add(Request $request)
    {
        $produit = new Produits();
        $produitForm = $this->createForm(ProduitsType::class, $produit);

        $produitForm->handleRequest($request);
        if ($produitForm->isSubmitted() && $produitForm->isValid()) {

            $this->getDoctrine()->getManager()->persist($produit);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('produits_list');
        }

        return $this->render('produit/add.html.twig', [
            'produitForm' => $produitForm->createView()
        ]);
    }



}