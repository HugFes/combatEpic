<?php

namespace App\Form;

use App\Entity\Warrior;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class WarriorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)

    {
        $builder
            ->add('nom', TextType::class, [
                "constraints"=>[new NotBlank(["message"=>"Vous devez renseigner un nom"])]
            ])
            ->add('race', ChoiceType::class, [
                'choices'=>[
                    'Troll' =>'T',
                    'Elfe'  =>'E',
                    'Nain'  =>'N',
                ],
                "attr"=>["required"=>"required"],
                'constraints' => [new NotBlank(["message"=>"Race Invalid"])]
            ])
            ->add('save', SubmitType::class, [
                "label"=>"Créer",
                "attr"=>["required"=>"required"]
            ])
        ;
    }



}
