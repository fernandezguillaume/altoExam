<?php


namespace App\Controller;


use App\Entity\Produits;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class ApiController extends AbstractController
{
  

     /**
     * @Route("/api/produits", name="api_produits_list")
     */
    public function listProduits(SerializerInterface $serializer)
    {
        $produits = $this->getDoctrine()->getRepository(Produits::class)->findAll();
        $serializedProduits = $serializer->serialize($produits, 'json');
        return new JsonResponse($serializedProduits, Response::HTTP_OK, [], true);
    }

}

