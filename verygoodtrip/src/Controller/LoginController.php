<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Entity\User;

class LoginController extends Controller
{
    /**
     * @Route("/login", name="login")
     */
    public function index()
    {
        return $this->render('login/index.html.twig', [
            'controller_name' => 'LoginController',
        ]);
    }

    /**
     * @Route("/login-process", name="login-process")
     */
    public function process(Request $request)
    {
      $email    = $request->request->get('email');
      $password = $request->request->get('password');
      $userRepo = $this->getDoctrine()->getRepository(User::class);

      // Nous devons récupérer l'utiliseur dont le mot de passe ET
      // l'email correspondant aux valeurs postées
      // les méthodes génériques ->findAll() et ->findBy...
      // sont inadaptées

      $user = $userRepo
        ->findByEmailAndPassword($email, $password);
      var_dump($user);

      return new Response('Utilisateur inconnu');
    }
}
