<?php

namespace App\Form;

use App\Entity\Haie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class Haie1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('code', TextType::class, array('label' => 'Code haie : ', 'attr' => array('class'=>'input-group w-25', 'placeholder'=>'Code')))
            ->add('nom', TextType::class, array('label' => 'Nom : ', 'attr' => array('class'=>'input-group w-25', 'placeholder'=>'Nom')))
            ->add('prix', NumberType::class, array('label' => 'Prix : ', 'attr' => array('class'=>'input-group w-25', 'placeholder'=>'Prix')))
            ->add('categorie')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Haie::class,
        ]);
    }
}
