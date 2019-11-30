<?php

namespace App\Controller;

use App\Entity\Elfe;
use App\Entity\Nain;
use App\Entity\Troll;
use App\Form\WarriorEditType;
use App\Form\WarriorType;
use App\Repository\WarriorRepository;
use App\Repository\FightRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Exception\InvalidArgumentException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WarriorController extends AbstractController
{
    /**
     * @Route("/warrior", name="warrior")
     * @param Request $request
     * @param ObjectManager $manager
     * @return Response
     */
    public function index(Request $request, ObjectManager $manager)
    {
        $form = $this->createForm(WarriorType::class);

        $warrior = null;
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){

            $data = $form->getData();
            if (trim($data["nom"]) === ""){
                throw new InvalidArgumentException("Bad request : invalid Name", 400);
            }

            switch ($data['race']){
                case "T":
                    $warrior = new Troll();
                    break;

                case "E":
                    $warrior= new Elfe();
                    break;

                case "N":
                    $warrior= new Nain();
                    break;

                default:
                    throw new InvalidArgumentException("bad request : invalid race", 400);
                    break;
            }
            $warrior->setNom($data["nom"]);

            //Save Warrior
            $manager->persist($warrior);
            $manager->flush();
            //Is not a good method but is necessary to flush post persist method
            $manager->flush();
        }

        return $this->render('warrior/index.html.twig', [
            'name' => 'Création de combattant',
            'form'=> $form->createView(),
            "warrior"=>$warrior
        ]);
    }


    /**
     * @Route("/warrior/{slug}", name="warrior_fight")
     * @param Request $request
     * @param WarriorRepository $repositoryRepository
     * @param FightRepository $fightRepository
     * @return Response
     */
    public function warriorFights(Request $request, WarriorRepository $repositoryRepository, FightRepository $fightRepository){

        $error = null;
        $warrior = $repositoryRepository->findBySlug($request->get("slug"));
        $fights = [];
        if ($warrior == null){
            $error = "bad ID : pas de combattant pour ce slug";
        }else{
            if (empty($warrior->getFights())){
                $error = "Ce combattant n'est pas encore entré dans l'arène ";
            }else{
                foreach ($warrior->getFights() as $fightId){
                    $fights[] = $fightRepository->find($fightId);
                }
            }
        }

        return $this->render('warrior/fights.html.twig', [
            'name' => 'Liste des combats de ' .$warrior->getNom(),
            "warrior"=>$warrior,
            'fights'=>$fights,
            "error"=>$error,
        ]);


    }


    /**
     * @Route("/warrior/edit/{slug}", name="warrior_edit")
     * @param Request $request
     * @param WarriorRepository $repository
     * @param ObjectManager $manager
     * @return Response
     */
    public function editWarrior(Request $request, WarriorRepository $repository, ObjectManager $manager){
        $message = null;

        $error = null;
        $warrior = null;

        $slug = $request->get("slug");


        if ($slug != null && $slug != ""){
            $warrior = $repository->findBySlug($slug);

            if ($warrior == null){
                $error = "Bad Request : invalid warrior slug";
            }
        }else{
            $error ="BAD REQUEST : you must give a valid warrior slug";
        }

        $form = $this->createForm(WarriorEditType::class, $warrior);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $message = "Combattant mis à jours";
            $manager->persist($warrior);
            $manager->flush();
        }

        return $this->render('warrior/edit.html.twig', [
            'name' => 'edition de '.$warrior->getNom(),

            "warrior"=>$warrior,
            "error"=>$error,
            "form"=>$form->createView(),
            "message"=>$message,
        ]);
    }

    /**
     * @Route("/warrior/remove/{id}", name="warrior_remove")
     * @param Request $request
     * @param WarriorRepository $repository
     * @param ObjectManager $manager
     * @param FightRepository $fightRepository
     * @return RedirectResponse
     */
    public function removeWarrior(Request $request, WarriorRepository $repository, ObjectManager $manager, FightRepository $fightRepository){
        $id = $request->get('id');

        if ($id != null && $id != ""){
            $warrior = $repository->find($id);

            if ($warrior != null){
                foreach($warrior->getFights() as $oneFight){
                    $fight = $fightRepository->find($oneFight);

                    if ($fight != null){
                        $manager->remove($fight);
                    }

                }

                $manager->remove($warrior);
            }



        }

        $manager->flush();

        return $this->redirectToRoute('home');
    }

}
