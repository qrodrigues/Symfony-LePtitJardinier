<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use App\Entity\Client;

class ClientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('code', TextType::class, array('label' => 'Code haie : '))
        ->add('nom', TextType::class, array('label' => 'Nom haie : '))
        ->add('prix', NumberType::class, array('label' => 'Tarif haie : ', 'invalid_message' => 'Saisir un nombre'))
        ->add('categorie', EntityType::class, array('label' => 'Categorie haie', 'class'=>Categorie::class, 'choice_label'=>'libelle'))
        ->add('save', SubmitType::class, array('label' => 'Ajouter'))
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Client::class,
        ]);
    }
}
