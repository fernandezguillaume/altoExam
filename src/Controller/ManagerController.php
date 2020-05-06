<?php

namespace App\Controller;


use App\Entity\Manager;
use App\Form\ManagerType;
use App\Repository\ManagerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Serializer\SerializerInterface;

class ManagerController extends AbstractController
{


    /**
     * @Route("/register", name="manager_register")
     */
    public function register(Request $request)
    {
        $manager = new Manager();
        $registerForm = $this->createForm(ManagerType::class, $manager);
        $registerForm->handleRequest($request);

        if ($registerForm->isSubmitted() && $registerForm->isValid()) {
            $salt = uniqid();
            $hash = hash('sha256', $manager->getPassword() . $salt);
            $manager->setPassword($hash);
            $manager->setSalt($salt);

            $this->getDoctrine()->getManager()->persist($manager);
            $this->getDoctrine()->getManager()->flush();
        }

        return $this->render('manager/creation.html.twig', [
            'registerForm' => $registerForm->createView()
        ]);
    }



 
}
