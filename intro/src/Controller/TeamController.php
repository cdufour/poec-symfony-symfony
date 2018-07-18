<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Team;

class TeamController extends Controller
{
  public function teamForm(Request $request)
  {
    if ($request->isMethod('post')) {
      // traitement du formulaire

      // récupération des valeurs
      $name           = $request->request->get('name');
      $coach          = $request->request->get('coach');
      $yearFoundation = $request->request->get('yearFoundation');

      // enregistrement en DB
      $team = new Team($name, $coach, $yearFoundation);
      $em = $this->getDoctrine()->getManager();
      $em->persist($team);
      $em->flush();

      // redirection
      return $this->redirectToRoute('teams');
    }

    // GET
    return $this->render('team/form.html.twig');
  }

  public function teams()
  {
    // récupération des équipes
    $repo = $this->getDoctrine()->getRepository(Team::class);
    $teams = $repo->findAll();

    return $this->render('team/list.html.twig', array(
      'teams' => $teams
    ));
  }
}
