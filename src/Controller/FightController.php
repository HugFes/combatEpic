<?php

namespace App\Controller;

use App\Entity\Warrior;
use App\Entity\Fight;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FightController extends AbstractController
{
    /**
     * @Route("/fight", name="fight")
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $goFight=$this->createFormBuilder()->add('Fight', SubmitType::class, ["label"=>"Lancer le combat"])->getForm();

        $goFight->handleRequest($request);
        $fightList=null;
        if ($goFight->isSubmitted()){
            $fightList = $this->fight();
        }

        $warriors=$this->getDoctrine()->getRepository(Warrior::class)->getWarriorAlive();
        $error = null;
        if (sizeof($warriors)<=1){
            $error = "Pas assez de combattant pour (re)lancer les combats";
        }
        return $this->render('fight/index.html.twig', [
            'name' => 'Lancer les combats',
            'goFight'=>$goFight->createView(),
            'fight'=>$fightList,
            'error'=>$error,
            'nbWarriors'=>sizeof($warriors),

        ]);
    }


    /**
     */
    private function fight(){

        $manager = $this->getDoctrine()->getManager();
        $repo = $manager->getRepository(Warrior::class);

        $warriors = $repo->getWarriorAlive();
        $zones=['foret', 'prairie', 'dezert'];
        $fightList=[];

        $lastFight = false;
        sizeof($warriors) == 2 ? $lastFight = true : $lastFight = false;
        //do all fight
        while (sizeof($warriors) >1){
            //duel
            $zone = $zones[array_rand($zones)];

            $index=array_rand($warriors);
            $warrior1 = $warriors[$index];
            unset($warriors[$index]);

            $index=array_rand($warriors);
            $warrior2 = $warriors[$index];
            unset($warriors[$index]);

            //select who is the first warrior
            // if is equals is already alea because select alea
            if($warrior2->getIntelligence()>$warrior1->getIntelligence()){
                $warriorIntermediate = $warrior1;
                $warrior1 = $warrior2;
                $warrior2 = $warriorIntermediate;
            }

            $warriorsStat=[
                'warrior1'=>[
                    'race'=>$warrior1->getRace(),
                    'pv'=>$warrior1->getPv(),
                    'strength'=>$warrior1->getStrength(),
                ],
                'warrior2'=>[
                    'race'=>$warrior2->getRace(),
                    'pv'=>$warrior2->getPv(),
                    'strength'=>$warrior2->getStrength(),
                ],
            ];

            //switch to init malus and bonus for warriors
            switch ($zone){
                case 'foret':
                    for($i=1; $i<3; $i++){
                        if ($warriorsStat['warrior'.$i]['race'] == 'Elfe'){
//                            var_dump($warriorsStat['warrior'.$i]['strength']);
                            $warriorsStat['warrior'.$i]['strength'] += 3 ;
//                            var_dump($warriorsStat['warrior'.$i]);
                        }else if ($warriorsStat['warrior'.$i]['race'] == 'Nain'){
                            $warriorsStat['warrior'.$i]['strength'] -= 2 ;
                        }
                    }

                    break;

                case 'prairie' :
                    for($i=1; $i<3; $i++){
                        if ($warriorsStat['warrior'.$i]['race'] == 'Nain'){
                            $warriorsStat['warrior'.$i]['strength'] += 4 ;
                        } else if ($warriorsStat['warrior'.$i]['race'] == 'Troll'){
                            $warriorsStat['warrior'.$i]['strength'] += 2 ;
                        }
                    }
                    break;

                case 'dezert':
                    for($i=1; $i<3; $i++){
                        if ($warriorsStat['warrior'.$i]['race'] == 'Troll'){
                            $warriorsStat['strength'] = $warriorsStat['warrior'.$i]['strength'] - ($warriorsStat['warrior'.$i]['strength']*0.2) ;
                        }
                    }
                    break;

                default :
                    throw new \Error('bad zone');
            }

            $duel=[];
            $duel['zone']=$zone;
            $duel['fight']=[];
            $round = 0;

            //Start fight
            $fight = new Fight();
            $fight->setCombattant1($warrior1);
            $fight->setCombattant2($warrior2);
            $fight->setZone($zone);
            $roundDescription = [];
            while ($warriorsStat['warrior1']['pv']>0 && $warriorsStat['warrior2']['pv']>0){
                $round++;
                $roundDescriptionStep="";
                if ($round%2 != 0){
                    $warriorsStat['warrior2']['pv'] -= $warriorsStat['warrior1']['strength'];
                    $roundDescriptionStep = $warrior1->getNom()." attaque ".$warrior2->getNom()." et lui inflige ".$warriorsStat['warrior1']['strength']. " de dégats. Il reste ".($warriorsStat['warrior2']['pv']<0?0:$warriorsStat['warrior2']['pv'])."PV à ".$warrior2->getNom();
                    $duel['fight'][]=$roundDescriptionStep;
                    if($warriorsStat['warrior2']['pv'] <=0){
                        $warrior2->setPv(0);
                        $warrior2->setDeathDate(new \DateTime());
                        $fight->setWinner($warrior1);

                        //winner
                        if ($lastFight){
                            $warrior1->setWinner(true);
                            $warrior1->setPv($warrior1->getPv()+10);
                        }

                    }
                }else{
                    $warriorsStat['warrior1']['pv'] -= $warriorsStat['warrior2']['strength'];
                    $roundDescriptionStep = $warrior2->getNom()." attaque ".$warrior1->getNom()." et lui inflige ".$warriorsStat['warrior2']['strength']. " de dégats. Il reste ".($warriorsStat['warrior1']['pv']<0 ? 0 : $warriorsStat['warrior1']['pv'])."PV à ".$warrior1->getNom();
                    $duel['fight'][]= $roundDescriptionStep;
                    if($warriorsStat['warrior1']['pv'] <=0){
                        $warrior1->setPv(0);
                        $warrior1->setDeathDate(new \DateTime());
                        $fight->setWinner($warrior2);

                        //winner
                        if ($lastFight){
                            $warrior2->setWinner(true);
                            $warrior2->setPv($warrior2->getPv()+10);
                        }

                    }
                }
                $roundDescription[] = $roundDescriptionStep;

            }
            //end fight
            $fight->setRounds($roundDescription);
            $manager->persist($fight);
            $manager->persist($fight);

            $fightList[]=$duel;
            $manager->persist($warrior1);
            $manager->persist($warrior2);
            $manager->flush();

        }
//        dump($warriors);

        return $fightList;
    }
}
