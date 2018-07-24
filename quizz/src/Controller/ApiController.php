<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Category;
use App\Entity\Difficulty;
use App\Entity\Question;
use App\Entity\Answer;

class ApiController extends Controller
{
    /**
     * @Route("/api", name="api")
     */
    public function index()
    {
      $students = array(
        array('name' => 'Dominique', 'expertIn' => 'Angular'),
        array('name' => 'Tristan', 'expertIn' => 'Symfony'),
        array('name' => 'Younes', 'expertIn' => 'DragAndDrop')
      );

      // conversion en chaîne de caractères (JSON);
      $students_json = json_encode($students);

      $res = new Response();
      $res->headers->set('Content-Type', 'application/json');

      // ajout de l'entête autorisant les requêtes depuis
      // depuis une origine différente (ex: localhost:4200 vers
      // localhost:8000)
      $res->headers->set('Access-Control-Allow-Origin', '*');
      $res->setContent($students_json);
      return $res;

      //return new Response($students_json);
    }

    /**
     * @Route("/api/category", name="api_category")
     */
    public function category()
    {
      $categoryRepo =
        $this->getDoctrine()->getRepository(Category::class);

      $categories = $categoryRepo->findBy([], ['label' => 'ASC']);

      // transformation des objets en tableaux associatifs
      // de manière à pouvoir les convertir facilement en JSON
      $categories_assoc = [];
      foreach($categories as $category) {
        $category_assoc = array(
          'id' => $category->getId(),
          'label' => $category->getLabel()
        );
        array_push($categories_assoc, $category_assoc);
      }

      return $this->json_response($categories_assoc);
    }

    /**
     * @Route("/api/difficulty", name="api_difficulty")
     */
    public function difficulty()
    {
      $difficultyRepo = $this->getDoctrine()
        ->getRepository(Difficulty::class);

      $difficulties = $difficultyRepo->findAll();

      $difficulties_assoc = [];
      foreach($difficulties as $difficulty) {
        $difficulty_assoc = array(
          'id' => $difficulty->getId(),
          'label' => $difficulty->getLabel()
        );
      array_push($difficulties_assoc, $difficulty_assoc);
      }
      return $this->json_response($difficulties_assoc);
    }

    private function json_response(Array $data)
    {
      $data_json = json_encode($data);
      $res = new Response();
      $res->headers->set('Content-Type', 'application/json');
      $res->headers->set('Access-Control-Allow-Origin', '*');
      $res->setContent($data_json);
      return $res;
    }

}
