<?php   

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController{

    /**
     * @Route("/", name="homepage")
     */
    public function home(){
        $prenoms = ["jean" => 31,"lior" => 12,"Anna"=>55];

        return $this->render(
            'home.html.twig',
            [
                'title' =>"Bonjour tout le monde",
                'age' => 31,
                'tab' => $prenoms
            ]
        );
    }

}
?>
