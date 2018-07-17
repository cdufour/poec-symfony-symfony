<?php
namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Response;
//use Symfony\Component\HttpFoundation\Request;
use App\Entity\Player;

class DemoController extends Controller
{
  public $players = [
    array(
      'id' => 1,
      'name' => 'Pogba',
      'num' => 6,
      'substitute' => false,
      'photo' => 'http://cdn.sports.fr//images/media/football/coupe-du-monde-2018/equipe-de-france/articles/pogba-le-patron-a-parle/pogba/25738259-1-fre-FR/Pogba_w484.jpg'
    ),
    array(
      'id' => 2,
      'name' => 'Lloris',
      'num' => 1,
      'substitute' => true,
      'photo' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/c/ca/Lloris_2018_%28cropped%29.jpg/260px-Lloris_2018_%28cropped%29.jpg'
    ),
    array(
      'id' => 3,
      'name' => 'Mbappé',
      'num' => 10,
      'substitute' => false,
      'photo' => 'https://le10static.com/img/a/2/6/5/6/2/4/265624-large.jpg'
    )
  ];

  public function index()
  {
    $colors = ['bleu', 'blanc', 'rouge'];

    // la méthode render() provient de la classe Controller
    return $this->render('demo.html.twig', array(
      'title' => 'Demo TWIG',
      'message' => 'Simple message en provenance du controller',
      'available' => true,
      'colors' => $colors,
      'players' => $this->players
    ));
  }

  public function player($id)
  {
    // $id correspond au paramètre d'url {id} défini
    // dans le fichier de routage

    // à partir de l'identifiant, on va récupérer la
    // totalité des données concernant le joueur identifié

    $player = null;
    foreach($this->players as $p) {
      // joueur trouvé dans la source de données
      if ($p['id'] == $id) {
        $player = $p;
      }
    }

    return $this->render('player.html.twig', array(
      'player' => $player
    ));
  }

  public function players()
  {
    $p1 = new Player('Abdel M', 10, false, '');
    $p2 = new Player('Cristiano Ronaldo', 7, false, '');
    $p3 = new Player('Adil Rami', 17, true, '');

    //$this->addPlayers();

    // récupérer les joueurs en base de données
    

    return $this->render('players.html.twig', array(
      'title' => 'Liste de joueurs',
      'players' => [$p1, $p2, $p3]
    ));

  }

  private function addPlayers()
  {
    $p1 = new Player('Pogba', 6, false, 'https://upload.wikimedia.org/wikipedia/commons/thumb/c/ca/Lloris_2018_%28cropped%29.jpg/260px-Lloris_2018_%28cropped%29.jpg');
    $p2 = new Player('Lloris', 1, true, 'https://upload.wikimedia.org/wikipedia/commons/thumb/c/ca/Lloris_2018_%28cropped%29.jpg/260px-Lloris_2018_%28cropped%29.jpg');

    $em = $this->getDoctrine()->getManager();
    $em->persist($p1); // requête pendante (en attente d'exécution)
    $em->persist($p2); // requête pendante (en attente d'exécution)
    $em->flush(); // exécutions des requêtes pendantes
  }
}
