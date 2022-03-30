<?php

namespace App\Form;

use App\Entity\Client;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class Client1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, array('label' => 'Nom : '))
            ->add('prenom', TextType::class, array('label' => 'Prénom : '))
            ->add('adresse', TextType::class, array('label' => 'Adresse : '))
            ->add('ville', TextType::class, array('label' => 'Ville : '))
            ->add('cp', NumberType::class, array('label' => 'Code postal : '))
            ->add('type_client', TextType::class, array('label' => 'Type client : '))
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Client::class,
        ]);
    }
}
