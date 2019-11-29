<?php

namespace App\Controller;

use App\Repository\FightRepository;
use App\Repository\WarriorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api/v1")
 */
class ApiController extends AbstractController
{
    /**
     * @Route("/warriors", name="get_Warriors", methods={"GET"})
     * @param WarriorRepository $repository
     * @return JsonResponse
     */
    public function index(WarriorRepository $repository)
    {
        $data = [];
        $warriors = $repository->findAll();

        foreach ($warriors as $warrior){
            $data[]=[
                "id"=>$warrior->getId(),
                "name"=>$warrior->getNom(),
                "alive"=>$warrior->getDeathDate() == null,
            ];
        }


        return new JsonResponse($data);
    }


    /**
     * @Route("/warriors/{id}", name="get_One_Warrior", methods={"GET"})
     * @param WarriorRepository $repository
     * @param Request $request
     * @return JsonResponse
     */
    public function getOneWarrior(WarriorRepository $repository, Request $request)
    {
        $data = [];


        $id = $request->get('id');
        $warrior = $repository->find($id);

        if ($warrior == null){
            throw new BadRequestHttpException('invalid id');
        }


        $data=[
            "id"=>$warrior->getId(),
            "name"=>$warrior->getNom(),
            "dates"=>[
                "created"=>$warrior->getCreatedDate()->format('d-m-Y'),
                'updated'=>$warrior->getUpdatedDate()->format('d-m-Y'),
                'deathDate'=>$warrior->getDeathDate()->format('d-m-Y'),
            ],
            "winner"=>$warrior->getWinner(),
            "fights_id"=>$warrior->getFights(),
        ];



        return new JsonResponse($data);
    }


    /**
     * @Route("/fights", name="get_fights", methods={"GET"})
     * @param FightRepository $repository
     * @return JsonResponse
     */
    public function getFights(FightRepository $repository){
        $data = [];
        $fights = $repository->findAll();

        foreach ($fights as $fight){
            $data[]=[
                "id"=>$fight->getId(),
                "warrior1"=>[
                    "id"=>$fight->getCombattant1()->getId(),
                    "name"=>$fight->getCombattant1()->getNom(),
                ],

                "warrior2"=>[
                    "id"=>$fight->getCombattant2()->getId(),
                    "name"=>$fight->getCombattant2()->getNom(),
                ],

                "winner"=>[
                    "id"=>$fight->getWinner()->getId(),
                    "name"=>$fight->getWinner()->getNom(),
                ]
            ];
        }

        return new JsonResponse($data);
    }

    /**
     * @Route("/fights/{id}", name="get_One_fight", methods={"GET"})
     * @param FightRepository $repository
     * @param Request $request
     * @return JsonResponse
     */
    public function getOneFights(FightRepository $repository, Request $request){
        $fight = $repository->find($request->get('id'));

        if ($fight == null){
            throw new BadRequestHttpException('invalid id');
        }

        $data[]=[
            "id"=>$fight->getId(),
            "warrior1"=>[
                "id"=>$fight->getCombattant1()->getId(),
                "name"=>$fight->getCombattant1()->getNom(),
            ],

            "warrior2"=>[
                "id"=>$fight->getCombattant2()->getId(),
                "name"=>$fight->getCombattant2()->getNom(),
            ],

            "winner"=>[
                "id"=>$fight->getWinner()->getId(),
                "name"=>$fight->getWinner()->getNom(),
            ],

            "rounds"=>$fight->getRounds(),
            "zone"=>$fight->getZone(),
        ];


        return new JsonResponse($data);
    }
}
