<?php

namespace App\Form;

use App\Entity\Warrior;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class WarriorEditType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('imageFile', FileType::class, [
                "required"=>false,
            ])
            ->add('pv')
            ->add('strength')
            ->add('intelligence')
            ->add('createdDate')
            ->add('deathDate')
            ->add('save', SubmitType::class, [
                "label" => "Sauvegarder",
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Warrior::class,
        ]);
    }
}
