<?php

namespace App\Controller;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\WarriorRepository;


class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     * @param WarriorRepository $combattantRepo
     * @return Response
     */
    public function index(WarriorRepository $combattantRepo)
    {

        $warriors = $combattantRepo->findAll();
//        dump($warriors[0]->getFights());

        return $this->render('home/index.html.twig', [
            'name'=>"Accueil",
            'warriors' => $warriors,
        ]);
    }


}
